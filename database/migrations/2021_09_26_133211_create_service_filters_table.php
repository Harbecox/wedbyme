<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServiceFiltersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('service_filters', function (Blueprint $table) {
            $table->unsignedBigInteger("service_id")->index();
            $table->foreign('service_id')
                ->references('id')
                ->on('services')
                ->onDelete("cascade")
                ->onUpdate("cascade");
            $table->unsignedBigInteger("filter_id")->index();
            $table->foreign('filter_id')
                ->references('id')
                ->on('filter_items')
                ->onDelete("cascade")
                ->onUpdate("cascade");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('service_filters');
    }
}
