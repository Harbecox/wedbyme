<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCalendarDaysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('calendar_days', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("calendar_id")->index();
            $table->foreign('calendar_id')
                ->references('id')
                ->on('calendars')
                ->onDelete("cascade")
                ->onUpdate("cascade");
            $table->date("date");
            $table->text("comment")->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('calendar_days');
    }
}
