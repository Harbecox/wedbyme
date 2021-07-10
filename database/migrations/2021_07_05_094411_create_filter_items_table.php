<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFilterItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('filter_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("group_id")->index();
            $table->foreign('group_id')
                ->references('id')
                ->on('filter_groups')
                ->onDelete("cascade")
                ->onUpdate("cascade");
            $table->integer("position")->nullable()->default(0);
            $table->string("title");
            $table->string("value")->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('filter_items');
    }
}
