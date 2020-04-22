<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBestellijst extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bestellijst', function (Blueprint $table) {
            $table->increments('bestelling_id');
            $table->tinyInteger('bestelling_geplaatst');
            $table->string('product_img');
            $table->string('product_id');
            $table->string('product_naam');
            $table->integer('product_code');
            $table->integer('product_aantal');
            $table->integer('product_toevoeger_id');
            $table->string('product_toevoeger_naam');
            $table->string('product_toevoeger_email');
            $table->integer('product_uitgever_id');
            $table->string('product_uitgever_naam');
            $table->string('product_uitgever_email');
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
        Schema::dropIfExists('bestellijst');
    }
}
