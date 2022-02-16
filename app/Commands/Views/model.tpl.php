<@?php namespace Modules\Backend\Models;

use ci4mongodblibrary\Libraries\Mongo;
<<<<<<< HEAD
use CodeIgniter\Model;

class {class} extends Model
=======

class {class}
>>>>>>> dev
{
    protected $table;
    protected $m;
    protected $databaseGroup = 'default';

    public function __construct()
    {
<<<<<<< HEAD
        parent::__construct();
=======
>>>>>>> dev
        $this->m = new Mongo($this->databaseGroup);
        $this->table='{table}';
    }

    public function (){
        //...
    }
}
