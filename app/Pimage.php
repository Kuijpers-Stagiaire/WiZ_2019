<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pimage extends Model
{
    protected $guarded = [];

    public function products()
    {
        return $this->belongsTo(Product::class);
    }
    public $timestamps = false;

    protected $table = 'productimages';

    protected $fillable = [
        'imagelink', 'Productomschrijving', 'Productcode',
    ];


}
