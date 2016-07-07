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
            $table->increments('disc_id');
            $table->bigInteger('ean');
            $table->timestamps();
            $table->string('name');
            $table->integer('year');
            $table->integer('format');
            $table->integer('nsongs');
            $table->double('totalduration');
            $table->integer('artist_id');
            $table->integer('group_id');
            $table->string('img_path');
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
