<@?php namespace Modules\Backend\Models;

use ci4mongodblibrary\Libraries\Mongo;
use CodeIgniter\Model;

class {class} extends Model
{
    protected $table;
    protected $m;
    protected $databaseGroup = 'default';

    public function __construct()
    {
        parent::__construct();
        $this->m = new Mongo($this->databaseGroup);
        $this->table='{table}';
    }

    public function (){
        //...
    }
}
