<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateShoppingcartsWishlistsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shoppingcarts_wishlists', function (Blueprint $table) {
            $table->integer('user_id');
            $table->timestamps();
            $table->integer('disc_id');
            $table->integer('quantity');
            $table->double('price');
            $table->boolean('shcrt_whlst');

            $table->primary(['user_id', 'disc_id', 'shcrt_whlst']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('shoppingcarts_wishlists');
    }
}