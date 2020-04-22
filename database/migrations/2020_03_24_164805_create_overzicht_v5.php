<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOverzichtV5 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //Nieuwe Overzicht table voor database
        //Regel 20,21,22,49 en 50 zijn handmatig bij gevoegd aan het systeem ondanks dat die nodig zijn voor functie systeem
        //de rest van de regels zijn de data zoals het van 2BA afkomst.
        Schema::create('overzicht', function (Blueprint $table) {
            $table->increments('Product_id');
            $table->integer('Aantal')->nullable();
            $table->string('Locatie')->nullable();
            $table->string('Brand')->nullable();
            $table->string('ChangeDate')->nullable();
            $table->string('Deeplink')->nullable();
            $table->string('Description')->nullable();
            $table->string('Features')->nullable();
            $table->string('GTIN')->nullable();
            $table->string('Guid')->nullable();
            $table->string('ID')->nullable();
            $table->string('IsDummy')->nullable();
            $table->string('LongDescription')->nullable();
            $table->string('ManufacturerGLN')->nullable();
            $table->string('ManufacturerName')->nullable();
            $table->string('Model')->nullable();
            $table->string('PredecessorGTIN')->nullable();
            $table->string('PredecessorProductcode')->nullable();
            $table->string('ProductClassDescription')->nullable();
            $table->string('ProductClassID')->nullable();
            $table->string('Productcode')->nullable();
            $table->string('StartDate')->nullable();
            $table->string('StatusCode')->nullable();
            $table->string('SuccessorGTIN')->nullable();
            $table->string('SuccessorProductcode')->nullable();
            $table->string('Version')->nullable();
            $table->string('WeightMeasureUnitCode')->nullable();
            $table->string('WeightMeasureUnitDescription')->nullable();
            $table->string('WeightQuantity')->nullable();
            $table->string('custom-modal-category')->nullable();
            $table->string('ProductImage')->nullable();
            $table->timestamps();
        });
        
        //Hieronder wordt de relatie gelecht tussen de overzicht tabel en de user tabel zodat
        //de gebruiker informatie bekeken kan worden.
        Schema::table('overzicht', function (Blueprint $table) {
            $table->integer('User_id')->unsigned()->after('Product_id');

            $table->foreign('user_id')
            ->references('id')->on('users')
            ->onDelete('cascade');
        });

        Schema::table('overzicht', function (Blueprint $table) {
            $table->integer('Productserie_id')->unsigned()->after('User_id');

            $table->foreign('Productserie_id')
            ->references('id')->on('productseries')
            ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('overzicht_v5');
    }
}
