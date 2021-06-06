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

## Installation
You must have Mongo Driver and Composer. Follow these links for installation:
<ul>
<li><a href="https://getcomposer.org/doc/00-intro.md#installation-linux-unix-macos">Composer installation</a></li>
<li><a href="https://www.php.net/manual/en/mongo.installation.php">Mongo driver installation</a></li>
</ul>

**you must do in terminal**

you must change file permissions user and group.

<code>chown user:group codeigniter_project_file</code>

<hr>

if do you want manual install you can follow these steps.
<pre>
mongo

use yourDatabase

db.createUser({
    user: "userName",
    pwd: passwordPrompt(),      // Or  "cleartextPassword"
    roles: [{role: "readWrite", db: "yourDatabase"}]
});
</pre>

<hr>

### Automatic Installation
After made settings. you should go link `http://site/installation` follow form attributes. Finish installation automaticly must detele installation module. If not delete installation module you must follow this steps:
<ul>
<li>you must delete <code>modules/installation</code> module</li>
<li>you should update <code>app/Config/Autoload.php</code>. you will see a note for update.</li>
</ul>

# In preparation
