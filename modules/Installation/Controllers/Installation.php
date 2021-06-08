<?php namespace Modules\Installation\Controllers;

use ci4mongodblibrary\Models\CommonModel;
use MongoDB\BSON\ObjectId;
use MongoDB\Client as client;

class Installation extends BaseController
{
    public function index()
    {
        return view('Modules\Installation\Views\welcome_message', $this->defData);
    }

    public function installation_post()
    {
        $valData = ([
            'email' => ['label' => 'Your E-mail', 'rules' => 'required|valid_email'],
            'dbname' => ['label' => 'Database Name', 'rules' => 'required|alpha_dash'],
            'un' => ['label' => 'Username', 'rules' => 'required|alpha_dash'],
            'pwd' => ['label' => 'Password', 'rules' => 'required'],
            'rootPwd' => ['label' => 'Root Password', 'rules' => 'required'],
            'rootUN' => ['label' => 'Root Username', 'rules' => 'required'],
            'host' => ['label' => 'Database Host', 'rules' => 'required'],
            'port' => ['label' => 'Database Port', 'rules' => 'required'],
            'pre' => ['label' => 'Table Prefix', 'rules' => 'required|alpha_dash'],
            'title' => ['label' => 'Site Title', 'rules' => 'required'],
            'username' => ['label' => 'Username', 'rules' => 'required|alpha_numeric'],
            'pass' => ['label' => 'Password', 'rules' => 'required']
        ]);

        if (!empty($this->request->getPost('sev')))
            $valData['sev'] = ['label' => 'Search Engine Visibility', 'rules' => 'required'];

        if ($this->validate($valData) == false)
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());

        $db_root = 'root';
        $db_name = $this->request->getPost('dbname');
        $db_user = $this->request->getPost('un');
        $db_pass = $this->request->getPost('pwd');

        if ($this->request->getPost('rootUN'))
            $db_root = $this->request->getPost('rootUN');

        //autenticate with a user who can create other users
        $mongo = new client("mongodb://" . $db_root . ":" . $this->request->getPost('rootPwd') . "@" . $this->request->getPost('host') . "/admin");
        $db = $mongo->selectDatabase($db_name);

        //command to create a new user
        $command = array
        (
            "createUser" => $db_user,
            "pwd" => $db_pass,
            "roles" => array
            (
                array("role" => "readWrite", "db" => $db_name)
            )
        );

        $commondResult = $db->command($command)->toArray();
        $commandResult = (bool)$commondResult[0]->ok;
        if ($commandResult == true) {
            //creating main files
            helper('filesystem');
            $autoload = "<?php namespace Config;
use CodeIgniter\Config\AutoloadConfig;

class Autoload extends AutoloadConfig
{
    public \$psr4 = [
        APP_NAMESPACE => APPPATH,
        'Config' => APPPATH . 'Config',
        'Modules' => ROOTPATH . 'modules',
        'Modules\Auth' => ROOTPATH . 'modules/Auth',
        'Modules\Backend' => ROOTPATH . 'modules/Backend'
    ];
    public \$classmap = [];
}
";
            $flag = false;
            if (!is_writable(ROOTPATH . 'app/Config/Autoload.php')) {
                chmod(ROOTPATH . 'app/Config/Autoload.php', 0777);
                $flag = write_file(ROOTPATH . 'app/Config/Autoload.php', $autoload, 'r+');
                chmod(ROOTPATH . 'app/Config/Autoload.php', 0664);
            } else {
                $flag = write_file(ROOTPATH . 'app/Config/Autoload.php', $autoload, 'w');
                chmod(ROOTPATH . 'app/Config/Autoload.php', 0664);
            }
            if ($flag == true) {
                $flag = false;
                $mongoConfig = "<?php namespace App\Config;
use CodeIgniter\Config\BaseConfig;

class MongoConfig extends BaseConfig
{
    public $db = " . $this->request->getPost('dbname') . "; //your database
    public $hostname = " . $this->request->getPost('host') . "; //if you use remote server you should change host address
    public $userName = " . $this->request->getPost('un') . ";
    public $password = " . $this->request->getPost('pwd') . ";
    public $prefix = " . $this->request->getPost('pre') . ";
    public $port = " . $this->request->getPost('port') . "; //if you use different port you should change port address
}";
                if (!is_writable(ROOTPATH . 'app/Config/MongoConfig.php')) {
                    chmod(ROOTPATH . 'app/Config/MongoConfig.php', 0777);
                    $flag = write_file(ROOTPATH . 'app/Config/MongoConfig.php', $mongoConfig, 'r+');
                    chmod(ROOTPATH . 'app/Config/MongoConfig.php', 0664);
                } else {
                    $flag = write_file(ROOTPATH . 'app/Config/MongoConfig.php', $mongoConfig, 'w');
                    chmod(ROOTPATH . 'app/Config/MongoConfig.php', 0664);
                }
                if ($flag == false)
                    return redirect()->back()->withInput()->with('error', 'Can not update MongoConfig.php file. Please install manually. You can follow this <a href="https=>//github.com/bertugfahriozer/auth-ci4-mongodb">link</a>');
            } else
                return redirect()->back()->withInput()->with('error', 'Can not update Autoload.php file. Please install manually. You can follow this <a href="https=>//github.com/bertugfahriozer/auth-ci4-mongodb">link</a>');

            //insert tables
            $pre = "";
            if (!empty($this->request->getPost('pre')))
                $pre = $this->request->getPost('pre');
            $commonModel = new CommonModel();
            $authLib = new AuthLibrary();
            $tablenames = [$pre . 'auth_permissions_pages' =>
                [
                    [
                        "_id" => new ObjectId("60674971b3659f7bd99f9788"),
                        "className" => "-Modules-Backend-Controllers-Backend",
                        "description" => "Yönetim Paneli Anasayfası",
                        "hasChild" => false,
                        "inNavigation" => true,
                        "isAccount" => false,
                        "isBackoffice" => true,
                        "methodName" => "index",
                        "pageSort" => 1,
                        "pagename" => "homepage",
                        "parent_pk" => null,
                        "sefLink" => "backend",
                        "symbol" => "fas fa-home",
                        "typeOfPermissions" => [
                            "read_r" => true
                        ]
                    ],
                    [
                        "_id" => new ObjectId("60674971b3659f7bd99f9789"),
                        "className" => "",
                        "description" => "Kullanıcı İşlemleri",
                        "hasChild" => true,
                        "inNavigation" => true,
                        "isAccount" => false,
                        "isBackoffice" => true,
                        "methodName" => "",
                        "pageSort" => 2,
                        "pagename" => "usersCrud",
                        "parent_pk" => null,
                        "sefLink" => "#",
                        "symbol" => "fas fa-users",
                        "typeOfPermissions" => [
                            "read_r" => true
                        ]
                    ],
                    [
                        "_id" => new ObjectId("60674c0ab3659f7bd99f978c"),
                        "className" => "-Modules-Backend-Controllers-UsersCrud-UserController",
                        "description" => "",
                        "hasChild" => false,
                        "inNavigation" => true,
                        "isAccount" => false,
                        "isBackoffice" => true,
                        "methodName" => "officeWorker",
                        "pageSort" => 1,
                        "pagename" => "officeWorkers",
                        "parent_pk" => new ObjectId("60674971b3659f7bd99f9789"),
                        "sefLink" => "officeWorker/1",
                        "symbol" => "fas fa-user-friends",
                        "typeOfPermissions" => [
                            "create_r" => true,
                            "read_r" => true,
                            "update_r" => true,
                            "delete_r" => true
                        ]
                    ],
                    [
                        "_id" => new ObjectId("60674c0ab3659f7bd99f978d"),
                        "className" => "-Modules-Backend-Controllers-UsersCrud-UserController",
                        "description" => "",
                        "hasChild" => false,
                        "inNavigation" => false,
                        "isAccount" => false,
                        "isBackoffice" => true,
                        "methodName" => "create_user",
                        "pageSort" => null,
                        "pagename" => "addOfficeWorkers",
                        "parent_pk" => null,
                        "sefLink" => "create_user",
                        "symbol" => "",
                        "typeOfPermissions" => [
                            "create_r" => true
                        ]
                    ],
                    [
                        "_id" => new ObjectId("60674c0ab3659f7bd99f978e"),
                        "className" => "-Modules-Backend-Controllers-UsersCrud-UserController",
                        "description" => "",
                        "hasChild" => false,
                        "inNavigation" => false,
                        "isAccount" => false,
                        "isBackoffice" => true,
                        "methodName" => "create_user_post",
                        "pageSort" => null,
                        "pagename" => "Ofis Çalışanı Ekleme POST",
                        "parent_pk" => null,
                        "sefLink" => "create_user",
                        "symbol" => "",
                        "typeOfPermissions" => [
                            "create_r" => true
                        ]
                    ],
                    [
                        "_id" => new ObjectId("60674c0ab3659f7bd99f978f"),
                        "className" => "-Modules-Backend-Controllers-PermGroup-PermgroupController",
                        "description" => "",
                        "hasChild" => false,
                        "inNavigation" => true,
                        "isAccount" => false,
                        "isBackoffice" => true,
                        "methodName" => "groupList",
                        "pageSort" => 3,
                        "pagename" => "permGroupList",
                        "parent_pk" => new ObjectId("60674971b3659f7bd99f9789"),
                        "sefLink" => "groupList/1",
                        "symbol" => "fas fa-sitemap",
                        "typeOfPermissions" => [
                            "create_r" => true,
                            "read_r" => true,
                            "update_r" => true,
                            "delete_r" => true
                        ]
                    ],
                    [
                        "_id" => new ObjectId("60674c0ab3659f7bd99f9790"),
                        "className" => "-Modules-Backend-Controllers-PermGroup-PermgroupController",
                        "description" => "",
                        "hasChild" => false,
                        "inNavigation" => false,
                        "isAccount" => false,
                        "isBackoffice" => true,
                        "methodName" => "group_create",
                        "pageSort" => null,
                        "pagename" => "addGroupPerms",
                        "parent_pk" => null,
                        "sefLink" => "group_create",
                        "symbol" => "",
                        "typeOfPermissions" => [
                            "create_r" => true
                        ]
                    ],
                    [
                        "_id" => new ObjectId("60674c0ab3659f7bd99f9791"),
                        "className" => "-Modules-Backend-Controllers-permGroup-PermgroupController",
                        "description" => "",
                        "hasChild" => false,
                        "inNavigation" => false,
                        "isAccount" => false,
                        "isBackoffice" => true,
                        "methodName" => "group_create_post",
                        "pageSort" => null,
                        "pagename" => "Grup Yetkisi Ekleme POST",
                        "parent_pk" => null,
                        "sefLink" => "group_create",
                        "symbol" => "",
                        "typeOfPermissions" => [
                            "create_r" => true
                        ]
                    ],
                    [
                        "_id" => new ObjectId("606f224fcfae8326f5c0b358"),
                        "className" => "-Modules-Backend-Controllers-UsersCrud-UserController",
                        "description" => "kullanıcnın kendi profili",
                        "hasChild" => false,
                        "inNavigation" => false,
                        "isAccount" => false,
                        "isBackoffice" => true,
                        "methodName" => "profile",
                        "pageSort" => null,
                        "pagename" => "profile",
                        "parent_pk" => null,
                        "sefLink" => "profile",
                        "symbol" => null,
                        "typeOfPermissions" => [
                            "create_r" => true,
                            "read_r" => true
                        ]
                    ],
                    [
                        "_id" => new ObjectId("606f224fcfae8326f5c0b359"),
                        "className" => "-Modules-Backend-Controllers-UsersCrud-UserController",
                        "description" => "kullanıcnın kendi profilinin güncellendiği adım",
                        "hasChild" => false,
                        "inNavigation" => false,
                        "isAccount" => false,
                        "isBackoffice" => true,
                        "methodName" => "profile_post",
                        "pageSort" => null,
                        "pagename" => "Profil POST",
                        "parent_pk" => null,
                        "sefLink" => "profile",
                        "symbol" => null,
                        "typeOfPermissions" => [
                            "create_r" => true
                        ]
                    ],
                    [
                        "_id" => new ObjectId("6072318e5f07b57b6f66fb7d"),
                        "className" => "-Modules-Backend-Controllers-PermGroup-PermgroupController",
                        "description" => "Kullanıcı Grup Yetkisi Güncelleme",
                        "hasChild" => false,
                        "inNavigation" => false,
                        "isAccount" => false,
                        "isBackoffice" => true,
                        "methodName" => "group_update",
                        "pageSort" => null,
                        "pagename" => "updateGroupPerms",
                        "parent_pk" => null,
                        "sefLink" => "group_update",
                        "symbol" => null,
                        "typeOfPermissions" => [
                            "update_r" => true
                        ]
                    ],
                    [
                        "_id" => new ObjectId("6072318e5f07b57b6f66fb7e"),
                        "className" => "-Modules-Backend-Controllers-PermGroup-PermgroupController",
                        "description" => "Kullanıcı Grup Yetkisi Güncelleme POST",
                        "hasChild" => false,
                        "inNavigation" => false,
                        "isAccount" => false,
                        "isBackoffice" => true,
                        "methodName" => "group_update_post",
                        "pageSort" => null,
                        "pagename" => "Grup Yetkisi Güncelleme POST",
                        "parent_pk" => null,
                        "sefLink" => "group_update",
                        "symbol" => null,
                        "typeOfPermissions" => [
                            "update_r" => true
                        ]
                    ],
                    [
                        "_id" => new ObjectId("6072318e5f07b57b6f66fb7f"),
                        "className" => "-Modules-Backend-Controllers-PermGroup-PermgroupController",
                        "description" => "Kullanıcıya özel yetki verme",
                        "hasChild" => false,
                        "inNavigation" => false,
                        "isAccount" => false,
                        "isBackoffice" => true,
                        "methodName" => "user_perms",
                        "pageSort" => null,
                        "pagename" => "specialAuthUser",
                        "parent_pk" => null,
                        "sefLink" => "user_perms",
                        "symbol" => null,
                        "typeOfPermissions" => [
                            "update_r" => true
                        ]
                    ],
                    [
                        "_id" => new ObjectId("6072318e5f07b57b6f66fb80"),
                        "className" => "-Modules-Backend-Controllers-PermGroup-PermgroupController",
                        "description" => "Kullanıcıya özel yetki verme POST",
                        "hasChild" => false,
                        "inNavigation" => false,
                        "isAccount" => false,
                        "isBackoffice" => true,
                        "methodName" => "user_perms_post",
                        "pageSort" => null,
                        "pagename" => "Kullanıcıya özel yetki verme POST",
                        "parent_pk" => null,
                        "sefLink" => "user_perms",
                        "symbol" => null,
                        "typeOfPermissions" => [
                            "update_r" => true
                        ]
                    ],
                    [
                        "_id" => new ObjectId("6072318e5f07b57b6f66fb81"),
                        "className" => "-Modules-Backend-Controllers-UsersCrud-UserController",
                        "description" => "Kullanıcının güncellendiği form sayfası",
                        "hasChild" => false,
                        "inNavigation" => false,
                        "isAccount" => false,
                        "isBackoffice" => true,
                        "methodName" => "update_user",
                        "pageSort" => null,
                        "pagename" => "updateUser",
                        "parent_pk" => null,
                        "sefLink" => "update_user",
                        "symbol" => null,
                        "typeOfPermissions" => [
                            "update_r" => true
                        ]
                    ],
                    [
                        "_id" => new ObjectId("6072318e5f07b57b6f66fb82"),
                        "className" => "-Modules-Backend-Controllers-UsersCrud-UserController",
                        "description" => "Kullanıcının güncellendiği form sayfası POST",
                        "hasChild" => false,
                        "inNavigation" => false,
                        "isAccount" => false,
                        "isBackoffice" => true,
                        "methodName" => "update_user_post",
                        "pageSort" => null,
                        "pagename" => "Kullanıcı Gündelleme POST",
                        "parent_pk" => null,
                        "sefLink" => "update_user",
                        "symbol" => null,
                        "typeOfPermissions" => [
                            "update_r" => true
                        ]
                    ],
                    [
                        "_id" => new ObjectId("6075adbef2b5ac6db8e04ebe"),
                        "className" => "-Modules-Backend-Controllers-UsersCrud-UserController",
                        "hasChild" => false,
                        "inNavigation" => false,
                        "isAccount" => false,
                        "isBackoffice" => true,
                        "methodName" => "ajax_blackList_post",
                        "pagename" => "Karalisteye Alma AJAX",
                        "sefLink" => "blackList",
                        "typeOfPermissions" => [
                            "update_r" => true
                        ]
                    ],
                    [
                        "_id" => new ObjectId("60771f0af454173c79bdc3cb"),
                        "className" => "-Modules-Backend-Controllers-UsersCrud-UserController",
                        "hasChild" => false,
                        "inNavigation" => false,
                        "isAccount" => false,
                        "isBackoffice" => true,
                        "methodName" => "ajax_remove_from_blackList_post",
                        "pagename" => "Karalisteden Çıkarma AJAX",
                        "sefLink" => "removeFromBlacklist",
                        "typeOfPermissions" => [
                            "update_r" => true
                        ]
                    ],
                    [
                        "_id" => new ObjectId("607c2438608e0b283a252925"),
                        "className" => "-Modules-Backend-Controllers-UsersCrud-UserController",
                        "description" => "Yetkili tarafından kullanıcının şifresini sıfırlama yapıldı",
                        "hasChild" => false,
                        "inNavigation" => false,
                        "isAccount" => false,
                        "isBackoffice" => true,
                        "methodName" => "ajax_force_reset_password",
                        "pagename" => "Yetkili tarafından kullanıcın şifresi sıfırlanma AJAX",
                        "sefLink" => "forceResetPassword",
                        "typeOfPermissions" => [
                            "update_r" => true
                        ]
                    ]
                ],
                $pre . 'auth_groups' =>
                    [
                        [
                            "_id" => new ObjectId("605f4fa8916eb59b540e95fa"),
                            "auth_groups_permissions" => [
                                [
                                    "page_id" => new ObjectId("60674971b3659f7bd99f9788"),
                                    "create_r" => true,
                                    "update_r" => true,
                                    "read_r" => true,
                                    "delete_r" => true,
                                    "who_perm" => new ObjectId("605a36ec9d1b4b583c6f671b"),
                                    "created_at" => date('Y-m-d H:i:s')
                                ],
                                [
                                    "page_id" => new ObjectId("60674971b3659f7bd99f9789"),
                                    "create_r" => true,
                                    "update_r" => true,
                                    "read_r" => true,
                                    "delete_r" => true,
                                    "who_perm" => new ObjectId("605a36ec9d1b4b583c6f671b"),
                                    "created_at" => date('Y-m-d H:i:s')
                                ],
                                [
                                    "page_id" => new ObjectId("60674c0ab3659f7bd99f978c"),
                                    "create_r" => true,
                                    "update_r" => true,
                                    "read_r" => true,
                                    "delete_r" => true,
                                    "who_perm" => new ObjectId("605a36ec9d1b4b583c6f671b"),
                                    "created_at" => date('Y-m-d H:i:s')
                                ],
                                [
                                    "page_id" => new ObjectId("60674c0ab3659f7bd99f978d"),
                                    "create_r" => true,
                                    "update_r" => true,
                                    "read_r" => true,
                                    "delete_r" => true,
                                    "who_perm" => new ObjectId("605a36ec9d1b4b583c6f671b"),
                                    "created_at" => date('Y-m-d H:i:s')
                                ],
                                [
                                    "page_id" => new ObjectId("60674c0ab3659f7bd99f978e"),
                                    "create_r" => true,
                                    "update_r" => true,
                                    "read_r" => true,
                                    "delete_r" => true,
                                    "who_perm" => new ObjectId("605a36ec9d1b4b583c6f671b"),
                                    "created_at" => date('Y-m-d H:i:s')
                                ],
                                [
                                    "page_id" => new ObjectId("60674c0ab3659f7bd99f978f"),
                                    "create_r" => true,
                                    "update_r" => true,
                                    "read_r" => true,
                                    "delete_r" => true,
                                    "who_perm" => new ObjectId("605a36ec9d1b4b583c6f671b"),
                                    "created_at" => date('Y-m-d H:i:s')
                                ],
                                [
                                    "page_id" => new ObjectId("60674c0ab3659f7bd99f9790"),
                                    "create_r" => true,
                                    "update_r" => true,
                                    "read_r" => true,
                                    "delete_r" => true,
                                    "who_perm" => new ObjectId("605a36ec9d1b4b583c6f671b"),
                                    "created_at" => date('Y-m-d H:i:s')
                                ],
                                [
                                    "page_id" => new ObjectId("60674c0ab3659f7bd99f9791"),
                                    "create_r" => true,
                                    "update_r" => true,
                                    "read_r" => true,
                                    "delete_r" => true,
                                    "who_perm" => new ObjectId("605a36ec9d1b4b583c6f671b"),
                                    "created_at" => date('Y-m-d H:i:s')
                                ],
                                [
                                    "page_id" => new ObjectId("606f224fcfae8326f5c0b358"),
                                    "create_r" => true,
                                    "update_r" => true,
                                    "read_r" => true,
                                    "delete_r" => true,
                                    "who_perm" => new ObjectId("605a36ec9d1b4b583c6f671b"),
                                    "created_at" => date('Y-m-d H:i:s')
                                ],
                                [
                                    "page_id" => new ObjectId("606f224fcfae8326f5c0b359"),
                                    "create_r" => true,
                                    "update_r" => true,
                                    "read_r" => true,
                                    "delete_r" => true,
                                    "who_perm" => new ObjectId("605a36ec9d1b4b583c6f671b"),
                                    "created_at" => date('Y-m-d H:i:s')
                                ],
                                [
                                    "page_id" => new ObjectId("6072318e5f07b57b6f66fb7d"),
                                    "create_r" => true,
                                    "update_r" => true,
                                    "read_r" => true,
                                    "delete_r" => true,
                                    "who_perm" => new ObjectId("605a36ec9d1b4b583c6f671b"),
                                    "created_at" => date('Y-m-d H:i:s')
                                ],
                                [
                                    "page_id" => new ObjectId("6072318e5f07b57b6f66fb7e"),
                                    "create_r" => true,
                                    "update_r" => true,
                                    "read_r" => true,
                                    "delete_r" => true,
                                    "who_perm" => new ObjectId("605a36ec9d1b4b583c6f671b"),
                                    "created_at" => date('Y-m-d H:i:s')
                                ],
                                [
                                    "page_id" => new ObjectId("6072318e5f07b57b6f66fb7f"),
                                    "create_r" => true,
                                    "update_r" => true,
                                    "read_r" => true,
                                    "delete_r" => true,
                                    "who_perm" => new ObjectId("605a36ec9d1b4b583c6f671b"),
                                    "created_at" => date('Y-m-d H:i:s')
                                ],
                                [
                                    "page_id" => new ObjectId("6072318e5f07b57b6f66fb80"),
                                    "create_r" => true,
                                    "update_r" => true,
                                    "read_r" => true,
                                    "delete_r" => true,
                                    "who_perm" => new ObjectId("605a36ec9d1b4b583c6f671b"),
                                    "created_at" => date('Y-m-d H:i:s')
                                ],
                                [
                                    "page_id" => new ObjectId("6072318e5f07b57b6f66fb81"),
                                    "create_r" => true,
                                    "update_r" => true,
                                    "read_r" => true,
                                    "delete_r" => true,
                                    "who_perm" => new ObjectId("605a36ec9d1b4b583c6f671b"),
                                    "created_at" => date('Y-m-d H:i:s')
                                ],
                                [
                                    "page_id" => new ObjectId("6072318e5f07b57b6f66fb82"),
                                    "create_r" => true,
                                    "update_r" => true,
                                    "read_r" => true,
                                    "delete_r" => true,
                                    "who_perm" => new ObjectId("605a36ec9d1b4b583c6f671b"),
                                    "created_at" => date('Y-m-d H:i:s')
                                ],
                                [
                                    "page_id" => new ObjectId("6075adbef2b5ac6db8e04ebe"),
                                    "create_r" => true,
                                    "update_r" => true,
                                    "read_r" => true,
                                    "delete_r" => true,
                                    "who_perm" => new ObjectId("605a36ec9d1b4b583c6f671b"),
                                    "created_at" => date('Y-m-d H:i:s')
                                ],
                                [
                                    "page_id" => new ObjectId("60771f0af454173c79bdc3cb"),
                                    "create_r" => true,
                                    "update_r" => true,
                                    "read_r" => true,
                                    "delete_r" => true,
                                    "who_perm" => new ObjectId("605a36ec9d1b4b583c6f671b"),
                                    "created_at" => date('Y-m-d H:i:s')
                                ],
                                [
                                    "page_id" => new ObjectId("607c2438608e0b283a252925"),
                                    "create_r" => true,
                                    "update_r" => true,
                                    "read_r" => true,
                                    "delete_r" => true,
                                    "who_perm" => new ObjectId("605a36ec9d1b4b583c6f671b"),
                                    "created_at" => date('Y-m-d H:i:s')
                                ]
                            ],
                            "description" => "Sistemi Yazan Teknik Personel",
                            "name" => "super user",
                            "seflink" => "/backend"
                        ],
                        [
                            "_id" => new ObjectId("60633026f433900c721581c5"),
                            "auth_groups_permissions" => null,
                            "description" => "Yönetici yetkileri",
                            "name" => "Administrator",
                            "seflink" => "/backend"
                        ],
                        [
                            "_id" => new ObjectId("60633026f433900c721581c6"),
                            "auth_groups_permissions" => null,
                            "description" => "Veri işleyebilir ve yetkinlilk düzenleyebilir",
                            "name" => "Editor",
                            "seflink" => "/backend"
                        ]
                    ],
                $pre . 'users' =>
                    [
                        [
                            "auth_users_permissions" => [
                                [
                                    "page_id" => new ObjectId("606f224fcfae8326f5c0b358"),
                                    "create_r" => true,
                                    "update_r" => true,
                                    "read_r" => true,
                                    "delete_r" => true,
                                    "created_at" => date('Y-m-d H:i:s')
                                ]
                            ],
                            "email" => $this->request->getPost('email'),
                            "firstname" => "Super",
                            "group_id" => new ObjectId("605f4fa8916eb59b540e95fa"),
                            "password_hash" => $authLib->setPassword($this->request->getPost('pass')),
                            "sirname" => "USER",
                            "status" => "active",
                            "username" => $this->request->getPost('username')
                        ]
                    ],
                $pre . 'settings' =>
                    [
                        [
                            'siteName' => $this->request->getPost('title'),
                            'slogan' => 'My website'
                        ]
                    ]
            ];

            $flag = [];
            foreach ($tablenames as $tablename => $att) {
                $checkCollectionIndexes = $commonModel->getIndexes($tablename);
                $cci = true;
                foreach ($checkCollectionIndexes as $checkCollectionIndex) {
                    if (empty($checkCollectionIndex))
                        $cci = true;
                    else
                        $cci = false;
                }
                if ($cci == true) {
                    if ($commonModel->create($tablename, $att)) {
                        $flag[] = ['tableName' => $tablename, 'isCreated' => true];
                    } else
                        $flag[] = ['tableName' => $tablename, 'isCreated' => false];
                }
            }

            $c = 0;
            $flagResult = true;
            foreach ($flag as $item) {
                if ($item['isCreated'] == false) {
                    $flagResult = $item['isCreated'];
                    break;
                }
                $c++;
            }

            if ($flagResult == true) {
                return redirect()->to('/backend');
            } else {
                $flag['message'] = 'We can not migrate database please install manually. You can follow this <a href="https=>//github.com/bertugfahriozer/auth-ci4-mongodb">link</a>';
                return redirect()->back()->withInput()->with('errors', $flag);
            }
        } else
            return redirect()->back()->withInput()->with('error', 'Please install manually. You can follow this <a href="https=>//github.com/bertugfahriozer/auth-ci4-mongodb">link</a>');
    }
}
