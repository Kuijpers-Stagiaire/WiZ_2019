<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;
use App\User;
use App\Product;

class Chartcontroller extends Controller
{
    public function homepagecharts(){

        $smallfella = User::count();

        $barchartproducts = Product::count();

        $piechartlocatie = DB::table('overzicht')
        ->selectRaw('Locatie, Count(Locatie) AS LocatieAantal')
        ->groupby('Locatie')
        ->orderby('LocatieAantal', 'DESC')
        ->limit(5)
        ->get();

        // dd($piechartlocatie[3]->Locatie);

        return view('home', compact('smallfella', 'barchartproducts', 'piechartlocatie'));

    }


    public function profilepagecharts(){

        $currentuser = Auth::user()->rechten;
        if($currentuser == 'User'){
        }
        else{
            $controltoegang = $currentuser;
        }

        $barchartproducts = Product::count();

        $piechartlocatie = DB::table('overzicht')
        ->selectRaw('Locatie, Count(Locatie) AS LocatieAantal')
        ->groupby('Locatie')
        ->orderby('LocatieAantal', 'DESC')
        ->limit(5)
        ->get();

        return view('profiel', compact('controltoegang', 'barchartproducts', 'piechartlocatie'));
    }
}
