<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFilterGroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('filter_groups', function (Blueprint $table) {
            $table->id();
            $table->string("title");
            $table->integer("position")->nullable()->default(0);
            $table->enum("type",\App\Models\FilterGroup::TYPES);
            $table->enum("cat",\App\Models\FilterGroup::CATS);
            $table->string("name")->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('filter_groups');
    }
}
