<?php


namespace App\Classes\Entity;

abstract class EntityResourceItem
{
    protected $className;
    protected $nameSpace;
    protected $file;

    protected $name;
    protected $isAdmin;

    function __construct($name, $isAdmin = false)
    {
        $this->name = $name;
        $this->isAdmin = $isAdmin;
        $this->makeNCF();
    }

    protected function getFileContent()
    {
        return file_get_contents($this->file);
    }

    protected function putFileContent($data)
    {
        file_put_contents($this->file, $data);
    }

    protected function getClassName()
    {
        return $this->className;
    }

    protected function getNameSpace()
    {
        return $this->nameSpace;
    }

    protected function getFileName()
    {
        return $this->file;
    }

    abstract protected function makeNCF();

    abstract public function make(EntityResourceItem ...$options);
}
