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
        // ->orderby('LocatieAantal', 'DESC')
        ->limit(5)
        ->get();

        // dd($piechartlocatie[3]->Locatie);

        return view('onzeresultaten', compact('smallfella', 'barchartproducts', 'piechartlocatie'));

    }


    public function profilepagecharts(){

        //Code klijner gemaakt.
        $currentuser = Auth::user()->rechten;
        $controltoegang = $currentuser;
        // if($currentuser == 'User'){
        //     echo"Geen toegang";
        // }
        // elseif($currentuser == ''){
        //     echo"Geen toegang";
        // }
        // else{
        // }

        $barchartproducts = Product::count();

        $piechartlocatie = DB::table('overzicht')
        ->selectRaw('Locatie, Count(Locatie) AS LocatieAantal')
        ->groupby('Locatie')
        ->orderby('LocatieAantal', 'DESC')
        ->limit(5)
        ->get();

        $Vestiging = ['Amsterdam','Arnhem','Den Bosch','Den Haag','Echt','Groningen','Helmond','Katwijk','Makkum','Oosterhout','Roosendaal','Tilburg','Utrecht','Zelhem','Zwolle'];
        $token = null;
        return view('profiel', compact('controltoegang', 'barchartproducts', 'piechartlocatie', 'token', 'Vestiging'));
    }
}
