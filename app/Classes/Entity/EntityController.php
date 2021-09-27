<?php


namespace App\Classes\Entity;


class EntityController extends EntityResourceItem
{

    protected function makeNCF()
    {
        $this->className = ($this->isAdmin ? "Admin" : "" ).$this->name."Controller";
        $this->nameSpace = 'App\\Http\\Controllers\\'.($this->isAdmin ? "Admin\\" : "").$this->className;
        $this->file = "app/Http/Controllers/".($this->isAdmin ? "admin/" : "").$this->className.".php";
    }

    public function make(EntityResourceItem ...$options)
    {
        $model          = $options[0];
        $repository     = $options[1];
        $storeRequest   = $options[2];
        $updateRequest  = $options[3];

        $data = "<?php\n";
        $data.= "\n";
        $data.= "namespace App\Http\Controllers\Admin;\n";
        $data.= "\n";
        $data.= "use ".$model->getNameSpace().";\n";
        $data.= "use ".$repository->getNameSpace().";\n";
        $data.= "use ".$storeRequest->getNameSpace().";\n";
        $data.= "use ".$updateRequest->getNameSpace().";\n";
        $data.= "\n";
        $data.= "class ".$this->className." extends AdminBaseController\n";
        $data.= "{\n";
        $data.= "\t".'protected $requests = ['."\n";
        $data.= "\t"."\t"."'store' => ".$storeRequest->getClassName()."::class,\n";
        $data.= "\t"."\t"."'update' => ".$updateRequest->getClassName()."::class,\n";
        $data.= "\t"."];\n";
        $data.= "\n";
        $data.= "\t".'protected $model = '.$model->getClassName().'::class;'."\n";
        $data.= "\n";
        $data.= "\t"."function __construct()\n";
        $data.= "\t"."{\n";
        $data.= "\t"."\t".'$this->repository = new '.$repository->getClassName().'($this->model);'."\n";
        $data.= "\t"."}\n";
        $data.= "}\n";
        $this->putFileContent($data);
    }
}
