<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDiscsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('discs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->index();
            $table->timestamps();
            $table->string('name');
            $table->integer('year');
            $table->integer('format');
            $table->integer('nsongs');
            $table->double('totalduration');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('discs');
    }
}
