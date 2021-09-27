<?php


namespace App\Classes\Entity;


class EntityRepository extends EntityResourceItem
{

    protected function makeNCF()
    {
        $this->className = $this->name."Repository";
        $this->nameSpace = 'App\\Repositories\\'.$this->className;
        $this->file = "app/Repositories/".$this->className.".php";
    }

    public function make(...$options)
    {
        $resource = $options[0];
        $dir = "app/Repositories/";
        if(!is_dir($dir)){
            mkdir($dir);
        }
        $data = "<?php\n";
        $data.= "\n";
        $data.= "namespace App\Repositories;\n";
        $data.= "\n";
        $data.= "use ".$resource->getNameSpace().";\n";
        $data.= "use App\Repositories\BaseRepository;\n";
        $data.= "\n";
        $data.= "class ".$this->className." extends BaseRepository\n";
        $data.= "{\n";
        $data.= "\t".'protected $resource = '.$resource->getClassName().'::class;'."\n";
        $data.= "}\n";
        $this->putFileContent($data);
    }
}
