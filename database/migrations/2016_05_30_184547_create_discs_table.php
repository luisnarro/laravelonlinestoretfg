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
            $table->bigInteger('ean');
            $table->timestamps();
            $table->string('name');
            $table->integer('year');
            $table->integer('format');
            $table->integer('nsongs');
            $table->double('totalduration');
            $table->integer('artist_id');
            $table->integer('group_id');
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
