<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubmenuTable extends Migration
{
    /**
     * Run the migrations.
     */
     public function up()
    {
        Schema::create('submenu', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('menu_id');
            $table->string('name');
            $table->string('slug');
            $table->timestamps();

            $table->foreign('menu_id')->references('id')->on('menus');
        });
    }

    /**
     * Reverse the migrations.
     */
     public function down()
    {
        Schema::dropIfExists('submenu');
    }
    
};