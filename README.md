# Login steps with mongodb in Codeigniter 4

## Features

This is meant to be a one-stop shop for 99% of your web-based authentication needs with CI4. It includes the following primary features:

<ul>
<li>Password-based authentication with remember-me functionality for web apps
Flat RBAC per NIST standards, described <a href="https://csrc.nist.gov/Projects/Role-Based-Access-Control">here</a> and <a href="https://www.semanticscholar.org/paper/A-formal-model-for-flat-role-based-access-control-Khayat-Abdallah/aeb1e9676e2d7694f268377fc22bdb510a13fab7?p2df">here</a>.</li>
<li>All views necessary for login, registration and forgotten password flows.</li>
<li>Publish files to the main application via a CLI command for easy customization</li>
<li>Email-based account verification</li>
</ul>

## First installation

**you must do in terminal**

<pre>
mongo

use yourDatabase

db.createUser({
    user: "userName",
    pwd: passwordPrompt(),      // Or  "<cleartext password>"
    roles: [{role: "readWrite", db: "yourDatabase"}],
    authenticationRestrictions: [{
        clientSource: [""],
        serverAddress: [""]
    }]
});
</pre>

**You must update app/Libraries/Mongo.php class.**

<pre>
private $db = "";//your database
private $hostname = '127.0.0.1';//if you use remote server you should change host address
private $userName = "root";
private $password = "";
private $port = 27017;//if you use different port you should change port address
</pre>

//TODO: yükleme adımı yazılacak. file:///home/bertug/Downloads/AdminLTE-3.1.0-rc/pages/forms/advanced.html içindeki bs-steper yükleme adımlarımları bittikten sonra totomatik olarak backend e yönlendirsin backend de installation modülü var mı diye kontrol edilerek silme işlemi ve Autoload.php deki kodu güncellesin.
//coding installation module.
After made settings. you should go link `http://site/installation` follow form attributes. Finish installation automaticly must detele installation module. If not delete installation module you must follow this steps:
<ul>
<li>you must delete <code>modules/installation</code> module</li>
<li>you should update <code>app/Config/Autoload.php</code>. you will see a note for update.</li>
</ul>

# In preparation
