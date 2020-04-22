<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductimagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Schema::create('productimages', function (Blueprint $table) {
        //     $table->increments('id');
        //     $table->char('prt', 3);
        //     $table->char('locatie', 100);
        //     $table->integer('productcode');
        //     $table->char('afkorting', 3);
        //     $table->char('url_www', 3);
        //     $table->char('imagelink', 92);
        //     $table->longText('productomschrijving');
        //     $table->char('land', 2);
        //     $table->char('size_nmmr', 2);
        //     $table->char('size', 66);
        //     $table->timestamps();
        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('productimages');
    }
}
