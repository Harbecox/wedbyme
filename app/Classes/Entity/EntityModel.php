<?php


namespace App\Classes\Entity;
use Illuminate\Support\Facades\Artisan;

class EntityModel extends EntityResourceItem
{

    protected function makeNCF()
    {
        $this->className = $this->name;
        $this->nameSpace = 'App\\Models\\'.$this->name;
        $this->file = "app/Models/".$this->name.".php";
    }

    function make(...$options)
    {
        Artisan::call("make:model ".$this->name." -m");
    }
}
