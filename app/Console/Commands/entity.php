<?php

namespace App\Console\Commands;

use App\Classes\Entity\EntityModel;
use App\Classes\Entity\EntityRepository;
use App\Classes\Entity\EntityResource;
use App\Classes\Entity\EntityResourceItem;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Symfony\Component\Console\Output\StreamOutput;

class entity extends Command
{
    protected $signature = 'make:entity {name} {--admin}';

    protected $description = 'Command description';

    private $entityName = null,
            $model = null,
            $storeRequest = null,
            $updateRequest = null,
            $repository = null,
            $resource = null,
            $isAdmin = false,
            $files = [];

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $name = ucfirst($this->argument('name'));
        $isAdmin = $this->option('admin');
        //$model = new EntityModel($name);
        //$model->make();
        $resource = new EntityResource($name,$isAdmin);
        $resource->make();
        $repository = new EntityRepository($name,$isAdmin);
        $repository->make($resource);

        exit;
        //$this->model = new EntityResourceItem($this->entityName,'App\\Models\\'.$this->entityName,"app/Models/".$this->entityName.".php");
        //$this->resource = new EntityResourceItem($this->entityName."Resource",'App\\Http\\Resources\\'.$this->entityName."Resource","app/Http/Resources/".$this->entityName."Resource".".php");

        return 0;
    }

    function checkFiles(){
        $this->files['model'] = "app/Models/".$this->entityName.".php";
        $this->files['resource'] = "app/Http/Resources/".$this->entityName."Resource".".php";
        $this->files['repository'] = "app/Repositories/" . ( $this->isAdmin ? "Admin/Admin" : "") . $this->entityName."Repository".".php";
        $this->files['requestStore'] = "app/Http/Requests/" . ( $this->isAdmin ? "Admin" : "") . $this->entityName."StoreRequest".".php";
        $this->files['requestUpdate'] = "app/Http/Requests/" . ( $this->isAdmin ? "Admin" : "") . $this->entityName."UpdateRequest".".php";
        $this->files['controller'] = "app/Http/Controllers/" . ( $this->isAdmin ? "Admin/Admin" : "") . $this->entityName."Controller".".php";
        $error = false;
        foreach ($this->files as $k => $file){
            if(file_exists($file)){
                $this->error($k . " " . $file . " already exists !!");
                $error = true;
            }
        }
        if($error){
            exit;
        }
    }

    private function makeModel(){
        Artisan::call("make:model ".$this->entityName." -m");
    }

    private function makeResource(){
        $resource = $this->entityName."Resource";
        Artisan::call("make:resource ".$resource);
        $this->resource = [
            'nameSpace' => 'App\\Http\\Resources\\'.$resource,
            'className' => $resource
        ];
        return true;
    }

    private function makeRepository(){

    }

    private function makeStoreRequest(){
        $store = ( $this->isAdmin ? "Admin" : "") . $this->entityName . "StoreRequest";
        Artisan::call("make:request ".$store);
        $this->storeRequest = [
            'nameSpace' => 'App\\Http\Requests\\'.$store,
            'className' => $store
        ];
        $file = file_get_contents($this->files['requestStore']);
        $file = str_replace("extends FormRequest","extends ApiRequest",$file);
        file_put_contents($this->files['requestStore'],$file);
        return true;
    }

    private function makeUpdateRequest(){
        $update = ( $this->isAdmin ? "Admin" : "") . $this->entityName . "UpdateRequest";
        Artisan::call("make:request ".$update);
        $this->updateRequest = [
            'nameSpace' => 'App\\Http\Requests\\'.$update,
            'className' => $update
        ];
        $file = file_get_contents($this->files['requestUpdate']);
        $file = str_replace("extends FormRequest","extends ApiRequest",$file);
        file_put_contents($this->files['requestUpdate'],$file);
        return true;
    }

    private function makeController(){
        $controller = ( $this->isAdmin ? "Admin" : "") . $this->entityName . "Controller";
        $controllers_dir = "app/http/Controllers/" . ( $this->isAdmin ? "Admin/" : "");
        $controller_file = $controllers_dir.$controller.".php";
        if(!is_dir($controllers_dir)){
            echo mkdir($controllers_dir);
        }

        $data = "<?php\n";
        $data.= "\n";
        $data.= "namespace App\Http\Controllers\Admin;\n";
        $data.= "\n";
        $data.= "use ".$this->model['nameSpace'].";\n";
        $data.= "use ".$this->repository['nameSpace'].";\n";
        $data.= "use ".$this->storeRequest['nameSpace'].";\n";
        $data.= "use ".$this->updateRequest['nameSpace'].";\n";
        $data.= "\n";
        $data.= "class ".$controller." extends AdminBaseController\n";
        $data.= "{\n";
        $data.= "\t".'protected $requests = ['."\n";
        $data.= "\t"."\t"."'store' => ".$this->storeRequest['className']."::class,\n";
        $data.= "\t"."\t"."'update' => ".$this->updateRequest['className']."::class,\n";
        $data.= "\t"."];\n";
        $data.= "\n";
        $data.= "\t".'protected $model = '.$this->model['className'].'::class;'."\n";
        $data.= "\n";
        $data.= "\t"."function __construct()\n";
        $data.= "\t"."{\n";
        $data.= "\t"."\t".'$this->repository = new '.$this->repository['className'].'($this->model);'."\n";
        $data.= "\t"."}\n";
        $data.= "}\n";
        file_put_contents($controller_file,$data);
        return true;
    }

}
