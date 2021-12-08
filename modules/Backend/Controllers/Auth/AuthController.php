<?php namespace Modules\Backend\Controllers\Auth;

use CodeIgniter\I18n\Time;
use Gregwar\Captcha\CaptchaBuilder;
use Modules\Backend\Models\UserModel;
use MongoDB\BSON\ObjectId;
use PHPMailer\PHPMailer\PHPMailer;

class AuthController extends BaseController
{
    protected $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    public function login()
    {
        $cap = new CaptchaBuilder();
        $cap->setBackgroundColor(139, 203, 183);
        $cap->setIgnoreAllEffects(false);
        $cap->setMaxFrontLines(0);
        $cap->setMaxBehindLines(0);
        $cap->setMaxAngle(1);
        $cap->setTextColor(18, 58, 73);
        $cap->setLineColor(18, 58, 73);
        $cap->build();
        $this->session->setFlashdata('cap', $cap->getPhrase());
        return view($this->config->views['login'], ['config' => $this->config, 'cap' => $cap]);
    }

    /**
     * Attempts to verify the user's credentials
     * through a POST request.
     */
    public function attemptLogin()
    {
        $rules = [
            'email' => 'required|valid_email',
            'password' => 'required',
            'captcha' =>'required'
        ];

        $captcha = $this->request->getPost('captcha');
        $cap = $this->request->getPost('cap');
        //TODO: production kısmına çekerken silinecek.
        if(ENVIRONMENT === 'development')
        {
            $captcha = "EEEEE";
            $cap = "EEEEE";
            unset($rules['captcha']);
        }

        if (!$this->validate($rules))
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());

        if ($captcha == $cap) {
            $login = $this->request->getPost('email');
            $password = $this->request->getPost('password');
            $remember = (bool)$this->request->getPost('remember');

            // Check is blocked ip
            // if (!$this->authLib->isBloackedIp())
            //     return redirect()->back()->withInput()->with('error', $this->authLib->error() ?? lang('Auth.loginBlock'));

            // Try to log them in...
            if (!$this->authLib->attempt(['email' => $login, 'password' => $password], $remember))
                return redirect()->back()->withInput()->with('error', $this->authLib->error() ?? lang('Auth.badAttempt'));
            $redirectURL = session('redirect_url') ?? redirect()->route('logout');
            unset($_SESSION['redirect_url']);
            return redirect()->route($redirectURL)->withCookies()->with('message', lang('Auth.loginSuccess'));
        }

        return redirect()->route('login')->withInput()->with('error', $this->authLib->error() ?? lang('Auth.badCaptcha'));
    }

    /**
     * Log the user out.
     */
    public function logout()
    {
        if ($this->authLib->check()) {
            $this->authLib->logout();
        }

        return redirect()->route('login');
    }

    /**
     * Displays the forgot password form.
     */
    public function forgotPassword()
    {
        if ($this->config->activeResetter === false)
            return redirect()->route('login')->with('error', lang('Auth.forgotDisabled'));

        return view($this->config->views['forgot'], ['config' => $this->config]);
    }

    /**
     * Attempts to find a user account with that password
     * and send password reset instructions to them.
     */
    public function attemptForgot()
    {
        helper('debug');
        $rules = [
            'email' => 'required|valid_email'
        ];
        if (!$this->validate($rules))
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());

        if ($this->config->activeResetter === false)
            return redirect()->route('login')->with('error', lang('Auth.forgotDisabled'));

        $user = $this->userModel->findOne(['email' => $this->request->getPost('email')]);

        if (is_null($user))
            return redirect()->back()->with('error', lang('Auth.forgotNoUser'));

        // Save the reset hash /
        $this->commonModel->updateOne('users', ['_id' => new ObjectId($user->_id)], ['reset_hash' => $this->authLib->generateActivateHash(), 'reset_expires' => date('Y-m-d H:i:s', time() + $this->config->resetTime)]);
        $user = $this->userModel->findOne(['_id' => new ObjectId($user->_id)]);
        $mail = new PHPMailer(true);

        try {
            //Server settings
            $mail->Host = $this->config->mailConfig['SMTPHost'];        // Set the SMTP server to send through
            $mail->Username = $this->config->mailConfig['SMTPUser'];    // SMTP username
            $mail->Password = $this->config->mailConfig['SMTPPass'];    // SMTP password
            $mail->CharSet = "UTF-8";

            if ($this->config->mailConfig['protocol'] === 'smtp') {
                $mail->Port = $this->config->mailConfig['SMTPPort'];                                          // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above
                $mail->isSMTP();                                            // Send using SMTP
                $mail->SMTPAuth = true;                                     // Enable SMTP authentication
            }
            if ($this->config->mailConfig['TLS'] === true)
                $mail->SMTPSecure = $this->config->mailConfig['SMTPCrypto'];         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged

            //Recipients
            $mail->setFrom('noreply@shl.com.tr', 'noreply@shl.com.tr');
            $mail->addAddress($user->email);  // Name is optional
            $mail->addReplyTo('noreply@shl.com.tr', 'Information');

            // Content
            $mail->isHTML(true);                                  // Set email format to HTML
            $mail->Subject = 'Üyelik Şifre Sıfırlama';
            $mail->Body = 'Üyeliğiniz şifre sıfırlaması gerçekleştirildi. Şifre yenileme isteğiniz ' . date('d-m-Y H:i:s', strtotime($user->reset_expires)) . ' tarihine kadar geçerlidir. Lütfen yeni şifrenizi belirlemek için <a href="' . base_url('backend/reset-password/' . $user->reset_hash) . '"><b>buraya</b></a> tıklayınız.';

            $mail->send();

            return redirect()->route('login')->with('message', lang('Auth.forgotEmailSent'));
        } catch (Exception $e) {
            return redirect()->back()->withInput()->with('error', $mail->ErrorInfo ?? lang('Auth.unknownError'));
        }
    }

    /**
     * Displays the Reset Password form.
     */
    public function resetPassword($token)
    {
        if ($this->config->activeResetter === false) {
            return redirect()->route('login')->with('error', lang('Auth.forgotDisabled'));
        }

        return view($this->config->views['reset'], ['config' => $this->config, 'token' => $token]);
    }

    /**
     * Verifies the code with the email and saves the new password,
     * if they all pass validation.
     *
     * @return mixed
     */
    public function attemptReset($token)
    {
        if ($this->config->activeResetter === false) {
            return redirect()->route('login')->with('error', lang('Auth.forgotDisabled'));
        }

        // First things first - log the reset attempt.
        $this->userModel->logResetAttempt(
            $this->request->getPost('email'),
            $token,
            $this->request->getIPAddress(),
            (string)$this->request->getUserAgent()
        );

        $rules = [
            'email' => 'required|valid_email',
            'password' => 'required|min_length[8]',
            'pass_confirm' => 'required|matches[password]',
        ];

        if (!$this->validate($rules))
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());

        $user = $this->userModel->findOne(['email' => $this->request->getPost('email'), 'reset_hash' => $token]);

        if (is_null($user)) {
            return redirect()->back()->with('error', lang('Auth.forgotNoUser'));
        }

        // Reset token still valid?
        $time = Time::parse($user->reset_expires);
        if (!empty($user->reset_expires) && time() > $time->getTimestamp())
            return redirect()->back()->withInput()->with('error', lang('Auth.resetTokenExpired'));

        // Success! Save the new password, and cleanup the reset hash.
        $this->commonModel->updateOne('users', ['_id' => new ObjectId($user->_id)], ['password_hash' => $this->authLib->setPassword($this->request->getPost('password')),
            'reset_hash' => null,
            'reset_expires' => null,
            'force_pass_reset' => false,
            'reset_at' => new Time('now'),
        ]);

        return redirect()->route('login')->with('message', lang('Auth.resetSuccess'));
    }

    /**
     * Activate account.
     *
     * @return mixed
     */
    public function activateAccount($token)
    {
        // First things first - log the activation attempt.
        $this->userModel->logActivationAttempt(
            $token,
            $this->request->getIPAddress(),
            (string)$this->request->getUserAgent()
        );

        $throttler = service('throttler');

        if ($throttler->check($this->request->getIPAddress(), 2, MINUTE) === false)
            return $this->response->setStatusCode(429)->setBody(lang('Auth.tooManyRequests', [$throttler->getTokentime()]));

        $user = $this->userModel->findOne(['activate_hash' => $token, 'status' => 'deactive']);

        if (is_null($user))
            return redirect()->route('login')->with('error', lang('Auth.activationNoUser'));

        $this->commonModel->updateOne('users', ['_id' => $user->_id], ['status' => 'active', 'activate_hash' => null]);

        return redirect()->route('login')->with('message', lang('Auth.registerSuccess'));
    }

    public function activateEmail($token)
    {
        // First things first - log the activation attempt.
        $this->userModel->logEmailActivationAttempt(
            $token,
            $this->request->getIPAddress(),
            (string)$this->request->getUserAgent()
        );

        $throttler = service('throttler');

        if ($throttler->check($this->request->getIPAddress(), 2, MINUTE) === false)
            return $this->response->setStatusCode(429)->setBody(lang('Auth.tooManyRequests', [$throttler->getTokentime()]));

        $user = $this->userModel->findOne(['activate_hash' => $token, 'status' => 'deactive']);

        if (is_null($user))
            return redirect()->route('login')->with('error', lang('Auth.activationNoUser'));

        $this->commonModel->updateOne('users', ['_id' => $user->_id], ['status' => 'active', 'activate_hash' => null]);

        return redirect()->route('login')->with('message', lang('Auth.emailActivationuccess'));
    }
}
