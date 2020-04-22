<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOverzichtTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Schema::create('overzicht', function (Blueprint $table) {
        //     $table->increments('id');
        //     $table->integer('mutatiecode');
        //     $table->char('productcode_fabrikant', 20);
        //     $table->bigInteger('gln_fabrikant');
        //     $table->char('gtin_product', 14);
        //     $table->date('ingangsdatum');
        //     $table->char('locatie', 200);
        //     $table->longText('productomschrijving');
        //     $table->longText('specificaties');
        //     $table->char('statuscode', 3);
        //     $table->char('gtin_product_opvolger', 14);
        //     $table->char('productcode_opvolger', 20); 
        //     $table->char('gtin_product_voorganger', 14); 
        //     $table->char('productcode_voorganger', 20);
        //     $table->char('netto_gewicht', 19);
        //     $table->longText('eenheid_gewicht');
        //     $table->char('aantal', 150);
        //     $table->char('fabrikaat', 35);
        //     $table->char('productserie', 35);
        //     $table->char('producttype', 35);
        //     $table->char('imagelink_1', 255);
        //     $table->char('imagelink_2', 255);
        //     $table->char('imagelink_3', 255);
        //     $table->char('code_productgroep', 4);
        //     $table->char('volgnummer_productklasse', 3);
        //     $table->char('versie_normblad', 2);
        //     $table->longText('status_normblad');
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
        Schema::dropIfExists('overzicht');
    }
}
