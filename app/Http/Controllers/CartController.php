<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use App\Product;
use App\Bestellijst;
//User model toegevoegd aan de lijst.
use App\User;
use Illuminate\Support\Facades\Validator;

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
    // public function store(String $product, string $aantal)
    public function store(String $product, request $request)
    {   
        //deze code zorgt ervoor dat je geen min-getal kan invoeren als je het aantal invult
        $validator = Validator::make($request->all(), [
            'Aantal'=>'required|regex:/^[0-9]\d*$/'
        ]);

        if($validator->fails()){
            return redirect('/producten')
                        ->withErrors($validator)
                        ->withInput();
        }
        //Id is veranderd naar Product_id.
        $aantal = $request->Aantal;
        $oldAantal = Product::where('Product_id', $product)->first()->Aantal;
        $newAantal = $oldAantal - $aantal;

        if ($newAantal >= 0) {
            Product::where('Product_id', $product)
            ->update(['Aantal' => $newAantal]);
        }else{
            return redirect('/producten')
            ->with('warning','Er zijn maar ' . $oldAantal . ' van dit soort producten beschikbaar, kies een ander aantal a.u.b.');;
        }
            $getProducten = DB::table('overzicht')
            ->where('Product_id', '=', $product)
            ->limit(1)
            ->get();
            
            $userinformation = User::where('id', $getProducten[0]->User_id)->get();
        $item = new Bestellijst();
        //Aanpassing gemaakt zodat de correcte waardes meegegeven worden.
        foreach ($getProducten as $getProduct) {
                $item->product_id = $getProduct->Product_id;
                $item->product_img = $getProduct->ProductImage;
                $item->product_naam = $getProduct->Description;
                
                $item->product_code = $getProduct->Productcode;
                $item->product_aantal = $aantal;
                $item->product_toevoeger_id = \Auth::user()->id;
                $item->product_toevoeger_naam = \Auth::user()->voornaam;
                $item->product_toevoeger_email = \Auth::user()->email;
                $item->product_uitgever_id = $userinformation[0]->id;
                $item->product_uitgever_naam = $userinformation[0]->voornaam;
                $item->product_uitgever_email = $userinformation[0]->email;
                $item->save();     

        }
        return redirect('/producten/bestellijst')
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

        return view('Products.bestellijst', compact('getBasket', 'categories'));
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
        //producten id is aangepast naar Product_id
        $product = Bestellijst::where('bestelling_id', $bestelling)->first()->product_id;

        $oldAantal = Product::where('Product_id', $product)->first()->Aantal;

        $currentAantal = Bestellijst::where('bestelling_id', $bestelling)->first()->product_aantal;

        $difference = abs($currentAantal - $aantal);
        //Toevoeging origineel_aantal om te controleren dat de bestelling niet hoger is dan de vooraad.
        $origineel_aantal = $oldAantal + $currentAantal;
        if ($currentAantal > $aantal) {
            //Controleer of het aantal toegevoegd product een positive getal is, anders geef Melding
            if($aantal >= 0){
                $newAantal = $oldAantal + $difference;

                Product::where('Product_id', $product)
                ->update(['Aantal' => $newAantal]);
            }
            else{
                return redirect('/producten/bestellijst')
                ->with('warning','Aantal moet een positive getal zijn!');
            }
            // $newAantal = $oldAantal + $difference;

            // Product::where('ID', $product)
            // ->update(['Aantal' => $newAantal]);
        }else if($currentAantal < $aantal){
            // CONTROLEER OUD AANTAL OF DE AANTAL NIET KLEINER/Gelijk is aan de voorraad, anders geef melding
            if($origineel_aantal >= $aantal){
                $newAantal = $oldAantal - $difference;

                Product::where('Product_id', $product)
                ->update(['Aantal' => $newAantal]);
            }
            else{
                return redirect('/producten/bestellijst')
                ->with('warning','Niks verandert!');
            }
        }
            // $newAantal = $oldAantal - $difference;

            // Product::where('ID', $product)
            // ->update(['Aantal' => $newAantal]);
        // }else{
        //     return redirect('/producten/bestellijst')
        //     ->with('warning','Niks verandert!');
        // }



        Bestellijst::where('bestelling_id',$bestelling)->update(['product_aantal'=>$aantal]);

        return redirect('/producten/bestellijst')
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
        //producten id is aangepast naar Product_id
        if (Product::where('Product_id', $product)->count() > 0) {
           $oldAantal = Product::where('Product_id', $product)->first()->Aantal;


            $newAantal = $oldAantal + $aantal;

            Product::where('Product_id', $product)
            ->update(['Aantal' => $newAantal]);

            DB::table('bestellijst')
            ->where('bestelling_id',$bestelling)
            ->delete();

            return redirect('/producten/bestellijst')
            ->with('info','Product succesvol verwijderd!');
            
        }else{
             DB::table('bestellijst')
                ->where('bestelling_id',$bestelling)
                ->delete();

            return redirect('/producten/bestellijst')
            ->with('info','Product succesvol verwijderd!');
        }
    }
}
