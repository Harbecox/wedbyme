<?php

namespace App\Console\Commands;

use App\Classes\Entity\EntityController;
use App\Classes\Entity\EntityModel;
use App\Classes\Entity\EntityRepository;
use App\Classes\Entity\EntityResource;
use App\Classes\Entity\EntityResourceItem;
use App\Classes\Entity\EntityStoreRequest;
use App\Classes\Entity\EntityUpdateRequest;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Symfony\Component\Console\Output\StreamOutput;

class entity extends Command
{
    protected $signature = 'make:entity {name} {--admin}';

    protected $description = 'Command description';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $name = ucfirst($this->argument('name'));
        $isAdmin = $this->option('admin');
        $model = new EntityModel($name);
        $model->make();
        echo "Model Created !!\n";
        echo "Migration Created !!\n";
        $resource = new EntityResource($name,$isAdmin);
        $resource->make();
        echo "Resource Created !!\n";
        $repository = new EntityRepository($name,$isAdmin);
        $repository->make($resource);
        echo "Repository Created !!\n";
        $storeRequest = new EntityStoreRequest($name,$isAdmin);
        $storeRequest->make();
        echo "StoreRequest Created !!\n";
        $updateRequest = new EntityUpdateRequest($name,$isAdmin);
        $updateRequest->make();
        echo "UpdateRequest Created !!\n";
        $controller = new EntityController($name,$isAdmin);
        $controller->make($model,$repository,$storeRequest,$updateRequest);
        echo "Controller Created !!\n";
        return 0;
    }


}
