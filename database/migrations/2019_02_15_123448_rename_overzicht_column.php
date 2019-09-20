<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RenameOverzichtColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Schema::table('overzicht', function(Blueprint $table)
        // {   
        //     // Rename the productcode_fabrikant column to productcode_fabrikant so that all database columns are within the sql coding standard
        //     $table->renameColumn('productcode_fabrikant', 'productcode_fabrikant');
        // });
        // Schema::table('overzicht', function(Blueprint $table)
        // {   
        //     // Rename the gtin_fabrikant column to gtin_product so that all database columns are within the sql coding standard
        //     $table->renameColumn('gtin_fabrikant', 'gtin_product');
        // });
        // Schema::table('overzicht', function(Blueprint $table)
        // {   
        //     // Rename the specificaties column to specificaties so that all database columns are within the sql coding standard
        //     $table->renameColumn('Statuscode', 'statuscode');
        // });
        // Schema::table('overzicht', function(Blueprint $table)
        // {   
        //     // Rename the Eenheid gewicht column to eenheid_gewicht so that all database columns are within the sql coding standard
        //     $table->renameColumn('Eenheid gewicht', 'eenheid_gewicht');
        // });

        // Schema::table('overzicht', function(Blueprint $table)
        // {   
        //     // Rename the specificaties column to specificaties so that all database columns are within the sql coding standard
        //     $table->renameColumn('Statuscode', 'statuscode');
        // });


        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        
        // Schema::table('overzicht', function(Blueprint $table)
        // {   
        //     // Rename the productcode_fabrikant column to productcode_fabrikant so that all database columns are within the sql coding standard
        //     $table->renameColumn('productcode_fabrikant', 'productcode_fabrikant');
        // });
        // Schema::table('overzicht', function(Blueprint $table)
        // {   
        //     // Rename the gtin_fabrikant column to gtin_product so that all database columns are within the sql coding standard
        //     $table->renameColumn('gtin_fabrikant', 'gtin_product');
        // });
        // Schema::table('overzicht', function(Blueprint $table)
        // {   
        //     // Rename the specificaties column to specificaties so that all database columns are within the sql coding standard
        //     $table->renameColumn('statuscode', 'Statuscode');
        // });
        // Schema::table('overzicht', function(Blueprint $table)
        // {   
        //     // Rename the Eenheid gewicht column to eenheid_gewicht so that all database columns are within the sql coding standard
        //     $table->renameColumn('Eenheid gewicht', 'eenheid_gewicht');
        // });

        // Schema::table('overzicht', function(Blueprint $table)
        // {   
        //     // Rename the specificaties column to specificaties so that all database columns are within the sql coding standard
        //     $table->renameColumn('statuscode', 'Statuscode');
        // });
    } 
}
