<?php


namespace App\Classes\Entity;


use Illuminate\Support\Facades\Artisan;

class EntityStoreRequest extends EntityResourceItem
{

    protected function makeNCF()
    {
        $this->className = $this->name."StoreRequest";
        $this->nameSpace = 'App\\Http\\Requests\\'.$this->className;
        $this->file = "app/Http/Requests/".$this->className.".php";
    }

    function make(...$options)
    {
        Artisan::call("make:request ". $this->className);
        $data = $this->getFileContent();
        $data = str_replace("extends FormRequest","extends ApiRequest",$data);
        $data = str_replace("return false","return true",$data);
        $this->putFileContent($data);
    }
}
