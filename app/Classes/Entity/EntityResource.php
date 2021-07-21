<?php


namespace App\Classes\Entity;
use Illuminate\Support\Facades\Artisan;

class EntityResource extends EntityResourceItem
{

    protected function makeNCF()
    {
        $this->className = $this->name."Resource";
        $this->nameSpace = 'App\\Http\\Resources\\'.$this->className;
        $this->file = "app/Http/Resources/".$this->className.".php";
    }

    public function make(...$options)
    {
        Artisan::call("make:resource ".$this->className);
    }
}
