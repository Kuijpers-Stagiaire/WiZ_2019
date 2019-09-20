<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use App\Product;
use App\Bestellijst;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(String $product, String $aantal)
    {   

        $oldAantal = Product::where('ID', $product)->first()->Aantal;

        $newAantal = $oldAantal - $aantal;

        if ($newAantal >= 0) {
            Product::where('ID', $product)
            ->update(['Aantal' => $newAantal]);
        }else{
            return redirect('/overzicht')
            ->with('warning','Er zijn maar ' . $oldAantal . ' van dit soort producten beschikbaar, kies een ander aantal!');;
        }
            $getProducten = DB::table('overzicht')
            ->select('ID', 'product_toevoeger_id' ,'productcode_fabrikant', 'product_toevoeger_id','product_toevoeger_voornaam', 'product_toevoeger_achternaam', 'product_toevoeger_email','product_toevoeger_vestiging', 'Fabrikaat', 'Productserie', 'Eenheid gewicht','Ingangsdatum', 'Productomschrijving', 'productnaam', 'imagelink', 'Locatie', 'Producttype', 'Aantal', 'specificaties')
            ->where('ID', '=', $product)
            ->limit(1)
            ->get();
            
        $item = new Bestellijst();

        foreach ($getProducten as $getProduct) {
                    
                $item->product_id = $getProduct->ID;
                $item->product_img = $getProduct->imagelink;

                if($getProduct->Productomschrijving == "") {
                    $item->product_naam = $getProduct->productnaam;
                }else{
                    $item->product_naam = $getProduct->Productomschrijving;
                }
                
                $item->product_code = $product;
                $item->product_aantal = $aantal;
                $item->product_toevoeger_id = \Auth::user()->id;
                $item->product_toevoeger_naam = \Auth::user()->voornaam;
                $item->product_toevoeger_email = \Auth::user()->email;
                $item->product_uitgever_id = $getProduct->product_toevoeger_id;
                $item->product_uitgever_naam = $getProduct->product_toevoeger_voornaam;
                $item->product_uitgever_email = $getProduct->product_toevoeger_email;

                $item->save();     

        }
        return redirect('/overzicht/bestellijst')
        ->with('success','Product succesvol toegevoegd!');;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $getBasket = DB::table('bestellijst')
            ->select('bestelling_id', 'product_id', 'product_img','product_naam', 'product_code', 'product_aantal', 'product_toevoeger_id','product_toevoeger_naam', 'updated_at', 'created_at')
            ->where('product_toevoeger_id', '=', \Auth::user()->id)
            ->get();

        $categories = DB::table('productseries')->distinct()->select('productserie_naam', 'productserie_img')->get();

        return view('products.bestellijst', compact('getBasket', 'categories'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateCustom(String $bestelling, String $aantal)
    {

        $product = Bestellijst::where('bestelling_id', $bestelling)->first()->product_id;

        $oldAantal = Product::where('ID', $product)->first()->Aantal;

        $currentAantal = Bestellijst::where('bestelling_id', $bestelling)->first()->product_aantal;

        $difference = abs($currentAantal - $aantal);

        if ($currentAantal > $aantal) {

            $newAantal = $oldAantal + $difference;

            Product::where('ID', $product)
            ->update(['Aantal' => $newAantal]);
        }else if($currentAantal < $aantal){
            $newAantal = $oldAantal - $difference;

            Product::where('ID', $product)
            ->update(['Aantal' => $newAantal]);
        }else{
            return redirect('/overzicht/bestellijst')
            ->with('warning','Niks verandert!');
        }



        Bestellijst::where('bestelling_id',$bestelling)->update(['product_aantal'=>$aantal]);

        return redirect('/overzicht/bestellijst')
        ->with('info','Productinformatie succesvol aangepast!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(String $bestelling, String $product, String $aantal)
    {      

        if (Product::where('ID', $product)->count() > 0) {
           $oldAantal = Product::where('ID', $product)->first()->Aantal;


            $newAantal = $oldAantal + $aantal;

            Product::where('ID', $product)
            ->update(['Aantal' => $newAantal]);

            DB::table('bestellijst')
            ->where('bestelling_id',$bestelling)
            ->delete();

            return redirect('/overzicht/bestellijst')
            ->with('info','Product succesvol verwijderd!');
            
        }else{
             DB::table('bestellijst')
                ->where('bestelling_id',$bestelling)
                ->delete();

            return redirect('/overzicht/bestellijst')
            ->with('info','Product succesvol verwijderd!');
        }
    }
}
