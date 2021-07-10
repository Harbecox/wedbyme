<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHallFiltersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hall_filters', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("hall_id")->index();
            $table->foreign('hall_id')
                ->references('id')
                ->on('halls')
                ->onDelete("cascade")
                ->onUpdate("cascade");
            $table->unsignedBigInteger("filter_id")->index();
            $table->foreign('filter_id')
                ->references('id')
                ->on('filter_items')
                ->onDelete("cascade")
                ->onUpdate("cascade");
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
        Schema::dropIfExists('hall_filters');
    }
}
