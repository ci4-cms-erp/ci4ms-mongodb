<?php namespace Modules\Backend\Libraries;

use CodeIgniter\Events\Events;
use Config\App;
//use Config\MongoConfig;
use ci4mongodblibrary\Models\CommonModel;
use Config\Services;
use Modules\Backend\Config\Auth;
use Modules\Backend\Exceptions\AuthException;
use Modules\Backend\Models\UserModel;
use MongoDB\BSON\ObjectId;

class AuthLibrary
{
    protected $userModel;
    protected $config;
    public $error;
    protected $user;
    protected $commonModel;
    protected $prefix;

    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->config = new Auth();
        $this->commonModel = new CommonModel();
        $this->user = null;
        //$this->prefix=new MongoConfig();
        //$this->config->userTable=$this->prefix->prefix.'users';
    }

    public function login(object $user = null, bool $remember = false): bool
    {
        if (empty($user)) {
            $this->user = null;
            return false;
        }
        $this->user = $user;
        $groupSefLink = $this->commonModel->getOne($this->prefix->prefix.'auth_groups', ['_id' => new ObjectId($this->user->group_id)], ['seflink' => true]);

        session()->set('redirect_url', $groupSefLink->seflink);

        $this->userModel->recordLoginAttempt($this->user->email, true);
        // Regenerate the session ID to help protect against session fixation
        if (ENVIRONMENT !== 'testing') {
            session()->regenerate();
        }

        session()->set($this->config->logged_in, (string)$this->user->_id);

        Services::response()->noCache();

        if ($remember && $this->config->allowRemembering) {
            $this->rememberUser($this->user->_id);
        }

        if (mt_rand(1, 100) < 20) {
            $this->userModel->purgeOldRememberTokens();
        }

        // trigger login event, in case anyone cares
        Events::trigger('login', $user);

        return true;
    }

    public function rememberUser(string $userID)
    {
        $selector = bin2hex(random_bytes(12));
        $validator = bin2hex(random_bytes(20));
        $expires = date('Y-m-d H:i:s', time() + $this->config->rememberLength);

        $token = $selector . ':' . $validator;

        // Store it in the database
        $this->userModel->rememberUser($userID, $selector, hash('sha256', $validator), $expires);

        // Save it to the user's browser in a cookie.
        $appConfig = new App();
        $response = Services::response();

        // Create the cookie
        $response->setCookie(
            'remember',                     // Cookie Name
            $token,                         // Value
            $this->config->rememberLength,  // # Seconds until it expires
            $appConfig->cookieDomain,
            $appConfig->cookiePath,
            $appConfig->cookiePrefix,
            true,                          // Only send over HTTPS?
            true                            // Hide from Javascript?
        );
    }

    public function isLoggedIn(): bool
    {
        if ($userID = session($this->config->logged_in)) {
            // Store our current user object
            $this->user = $this->userModel->findOne(['_id' => new ObjectId($userID)]);
            $groupSefLink = $this->userModel->getGroupInfos(['_id' => new ObjectId($this->user->group_id)], ['seflink']);
            session()->set('redirect_url', $groupSefLink->seflink);
            return true;
        }

        return false;
    }

    public function logout()
    {
        helper('cookie');
        $oid = new ObjectId(session($this->config->logged_in));
        if ($userID = $oid) {
            $this->user = $this->userModel->findOne(['_id' => (object)$userID]);
        }

        $user = $this->user;

        // Destroy the session data - but ensure a session is still
        // available for flash messages, etc.
        if (isset($_SESSION)) {
            foreach ($_SESSION as $key => $value) {
                $_SESSION[$key] = NULL;
                unset($_SESSION[$key]);
            }
        }

        // Regenerate the session ID for a touch of added safety.
        session()->regenerate(true);

        // Take care of any remember me functionality
        $this->userModel->purgeRememberTokens($user->_id);

        // trigger logout event
        Events::trigger('logout', $user);
    }

    public function has_perm(string $module, string $method): bool
    {
        if($method=='error_403')
            return true;

        $userInfo = $this->commonModel->getOne($this->config->userTable, ['_id' => new ObjectId(session()->get($this->config->logged_in))], ['projection' => ['group_id' => true, 'auth_users_permissions' => true]]);

        $module = str_replace('\\', '-', $module);
        $perms = $this->commonModel->getOne($this->prefix->prefix.'auth_groups', ['_id' => $userInfo->group_id], ['projection' => ['auth_groups_permissions' => true]]);
        $classID = $this->commonModel->getOne($this->prefix->prefix.'auth_permissions_pages', ['className' => $module, 'methodName' => $method], ['projection' => ['typeOfPermissions' => true]]);
        $allPerms = [];

        $permissions = (array)$perms->auth_groups_permissions;
        if (!empty($userInfo->auth_users_permissions)) {
            $userPerms = (array)$userInfo->auth_users_permissions;
            $allPerms = array_merge($permissions, $userPerms);
        } else
            $allPerms = $permissions;
        if (!empty($classID)) {
            $perms = [];
            foreach ($allPerms as $allPerm) {
                if ((string)$allPerm->page_id == (string)$classID->_id) {
                    $perms[] = $allPerm;
                }
            }
            $allPerms = [];
            $c = 0;
            foreach ($perms as $key => $perm) {
                if ($key > 0)
                    $c = $key - 1;

                if ($perm->create_r == true && $perms[$c]->create_r == $perm->create_r)
                    $allPerms[0]['create_r'] = true;
                if ($perm->read_r == true && $perms[$c]->read_r == $perm->read_r)
                    $allPerms[0]['read_r'] = true;
                if ($perm->update_r == true && $perms[$c]->update_r == $perm->update_r)
                    $allPerms[0]['update_r'] = true;
                if ($perm->delete_r == true && $perms[$c]->delete_r == $perm->delete_r)
                    $allPerms[0]['delete_r'] = true;
            }

            if(empty($allPerms))
                return false;

            $typeOfPerms = (array)$classID->typeOfPermissions;
            $intersect = array_intersect($typeOfPerms, $allPerms[0]);

            if (!empty($intersect))
                return true;
            else
                return false;
        } else
            return false;
    }

    public function attempt(array $credentials, bool $remember = null): bool
    {
        $this->user = $this->validate($credentials, true);

        if (empty($this->user)) {
            // Always record a login attempt, whether success or not.
            $this->userModel->recordLoginAttempt($credentials['email'], false);

            $this->user = null;
            return false;
        }

        if ($this->isBanned($this->user->_id)) {
            // Always record a login attempt, whether success or not.
            $this->userModel->recordLoginAttempt($credentials['email'], false);

            $this->error = lang('Auth.userIsBanned');

            $this->user = null;
            return false;
        }

        if (!$this->isActivated($this->user->_id)) {
            // Always record a login attempt, whether success or not.
            $this->userModel->recordLoginAttempt($credentials['email'], false);

            $param = http_build_query([
                'login' => urlencode($credentials['email'] ?? $credentials['username'])
            ]);

            $this->error = lang('Auth.notActivated') . ' ' . anchor(route_to('backend/resend-activate-account') . '?' . $param, lang('Auth.activationResend'));

            $this->user = null;
            return false;
        }

        return $this->login($this->user, $remember);
    }

    public function validate(array $credentials, bool $returnUser = false)
    {
        // Can't validate without a password.
        if (empty($credentials['password']) || count($credentials) < 2) {
            return false;
        }

        // Only allowed 1 additional credential other than password
        $password = $credentials['password'];
        unset($credentials['password']);

        if (count($credentials) > 1) {
            throw AuthException::forTooManyCredentials();
        }

        // Ensure that the fields are allowed validation fields
        if (!in_array(key($credentials), $this->config->validFields)) {
            throw AuthException::forInvalidFields(key($credentials));
        }

        // Can we find a user with those credentials?
        $user = $this->userModel->findOne($credentials);

        if (!$user) {
            $this->error = lang('Auth.badAttempt');
            return false;
        }

        // Now, try matching the passwords.
        $result = password_verify(base64_encode(
            hash('sha384', $password, true)
        ), $user->password_hash);

        if (!$result) {
            $this->error = lang('Auth.invalidPassword');
            return false;
        }

        // Check to see if the password needs to be rehashed.
        // This would be due to the hash algorithm or hash
        // cost changing since the last time that a user
        // logged in.
        if (password_needs_rehash($user->password_hash, $this->config->hashAlgorithm)) {
            $user->password_hash = $password;
            $this->userModel->passwordRehash(['_id' => $user->_id], $user);
        }

        return $returnUser ? $user : true;
    }

    public function isBanned($pk): bool
    {
        $userStatus = $this->userModel->findOne(['_id' => $pk], ['status']);
        return isset($userStatus->status) && $userStatus->status === 'banned';
    }

    public function isActivated($pk): bool
    {
        $userStatus = $this->userModel->findOne(['_id' => $pk], ['status']);
        return isset($userStatus->status) && $userStatus->status == 'active';
    }

    public function error()
    {
        return $this->error;
    }

    public function check(): bool
    {
        if ($this->isLoggedIn()) {
            return true;
        }

        // Check the remember me functionality.
        helper('cookie');
        $remember = get_cookie('remember');

        if (empty($remember)) {
            return false;
        }

        [$selector, $validator] = explode(':', $remember);
        $validator = hash('sha256', $validator);

        $token = $this->userModel->getRememberToken($selector);

        if (empty($token)) {
            return false;
        }

        if (!hash_equals($token->hashedValidator, $validator)) {
            return false;
        }

        // Yay! We were remembered!
        $user = $this->commonModel->getOne($this->config->userTable, ['_id' => new ObjectId($token->user_id)]);

        if (empty($user)) {
            return false;
        }

        $this->login($user);

        // We only want our remember me tokens to be valid
        // for a single use.
        $this->refreshRemember($user->_id, $selector);

        return true;
    }

    public function refreshRemember(string $userID, string $selector)
    {
        $existing = $this->userModel->getRememberToken($selector);

        // No matching record? Shouldn't happen, but remember the user now.
        if (empty($existing)) {
            return $this->rememberUser($userID);
        }

        // Update the validator in the database and the session
        $validator = bin2hex(random_bytes(20));

        $this->userModel->updateRememberValidator($selector, $validator);

        // Save it to the user's browser in a cookie.
        helper('cookie');

        $appConfig = new App();

        // Create the cookie
        set_cookie(
            $this->config->rememberCookie,               // Cookie Name
            $selector . ':' . $validator, // Value
            $this->config->rememberLength,  // # Seconds until it expires
            $appConfig->cookieDomain,
            $appConfig->cookiePath,
            $appConfig->cookiePrefix,
            false,                  // Only send over HTTPS?
            true                  // Hide from Javascript?
        );
    }

    public function setPassword(string $password)
    {
        if ((defined('PASSWORD_ARGON2I') && $this->config->hashAlgorithm == PASSWORD_ARGON2I) || (defined('PASSWORD_ARGON2ID') && $this->config->hashAlgorithm == PASSWORD_ARGON2ID)) {
            $hashOptions = [
                'memory_cost' => $this->config->hashMemoryCost,
                'time_cost' => $this->config->hashTimeCost,
                'threads' => $this->config->hashThreads
            ];
        } else {
            $hashOptions = [
                'cost' => $this->config->hashCost
            ];
        }

        $passwordHash = password_hash(
            base64_encode(
                hash('sha384', $password, true)
            ),
            $this->config->hashAlgorithm,
            $hashOptions
        );

        return $passwordHash;
    }

    function randomPassword()
    {
        $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
        $pass = array(); //remember to declare $pass as an array
        $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
        for ($i = 0; $i < 8; $i++) {
            $n = rand(0, $alphaLength);
            $pass[] = $alphabet[$n];
        }
        return implode($pass); //turn the array into a string
    }

    public function generateActivateHash()
    {
        return bin2hex(random_bytes(16));
    }
}
