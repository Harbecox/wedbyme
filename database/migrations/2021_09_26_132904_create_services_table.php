<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("company_id")->index();
            $table->foreign('company_id')
                ->references('id')
                ->on('users')
                ->onDelete("cascade")
                ->onUpdate("cascade");
            $table->json("images")->nullable();
            $table->json("urls")->nullable();
            $table->json("phones");
            $table->string("title");
            $table->string("seo_url");
            $table->float("review");
            $table->unsignedBigInteger("calendar_id")->nullable()->index();
            $table->foreign('calendar_id')
                ->references('id')
                ->on('calendars')
                ->onDelete("cascade")
                ->onUpdate("cascade");
            $table->longText("description")->nullable();
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
        Schema::dropIfExists('services');
    }
}
