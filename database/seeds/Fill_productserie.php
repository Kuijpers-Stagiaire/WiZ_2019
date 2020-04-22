<?php

use Illuminate\Database\Seeder;

class Fill_productserie extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('productseries')->insert([[
            'id' => '1',
            'productserie_naam' => 'Magazijn',
            'productserie_img' => '/img/magazijn.jpg',
        ],
        [
            'id' => '2',
            'productserie_naam' => 'IT',
            'productserie_img' => '/img/it.jpg',
        ],
        [
            'id' => '3',
            'productserie_naam' => 'Elektrotechniek',
            'productserie_img' => '/img/electro.jpg',
        ],
        [
            'id' => '4',
            'productserie_naam' => 'Verwarming & Klimaat',
            'productserie_img' => '/img/verwarming.jpg',
        ],
        [
            'id' => '5',
            'productserie_naam' => 'Sanitair',
            'productserie_img' => '/img/sanitair.jpg',
        ],
        [
            'id' => '6',
            'productserie_naam' => 'Gereedschap',
            'productserie_img' => '/img/gereedschap.jpg',
        ],
        [
            'id' => '7',
            'productserie_naam' => 'Verlichting',
            'productserie_img' => '/img/verlichting.jpg',
        ],
        [
            'id' => '8',
            'productserie_naam' => 'Consumentenproducten',
            'productserie_img' => '/img/consument.jpg',
        ],
        [
            'id' => '9',
            'productserie_naam' => 'P.B.M',
            'productserie_img' => '/img/beveiliging.jpg',
        ]]);
    }
}
