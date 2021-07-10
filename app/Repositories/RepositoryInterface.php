<?php


namespace App\Repositories;


interface RepositoryInterface
{
    function getAll($options);
    function get($id);
    function add($data);
    function update($id,$data);
    function delete($id);
}
