<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use App\Product;
use App\Bestellijst;
use App\Cat;
use App\GTIN;
use App\Pimage;
use App\User;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Image; 
use Illuminate\Support\Facades\Input;
//Toevoeging van de Auth Facades zodat de auth:: uitgevoerd kunnen worden.
use Illuminate\Support\Facades\Auth;
//  Add the http\request so you can access data in the function paramaters
//  use Illuminate\Http\Request;


class ProductsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function shopindex()
    {
        //  Producten onlangs toegevoegd
        //13-3-2020 aangepast naar nieuwe database namen.
        $productsOTs = DB::table('overzicht AS o')
        ->select(
            'o.Product_id as id',
            'o.Productcode as productcodefabrikant', 
            'o.ManufacturerName as fabrikaat', 
            'o.Model as productserie', 
            'o.created_at as ingangsdatum', 
            'o.LongDescription as productomschrijving', 
            'o.Description as productnaam', 
            'o.Aantal as aantal', 
            'o.ProductImage as imagelink',  
            'o.Locatie as locatie', 
            'o.Version as producttype' 
        )->orderBy('created_at', 'desc')
        ->limit(3)
        ->get();

        //  Producten categorieën combobox  
        // $combocats = DB::table('overzicht')->distinct()->select('Productserie', 'Productserie')->get();

        $categories = DB::table('productseries')->distinct()->select('productserie_naam', 'productserie_img')->get();

        //Bekijk ook
        //13-3-2020 aangepast naar nieuwe database namen.
        $bekijkook = DB::table('overzicht AS o')
        ->select(
            'o.Product_id as id', 
            'o.Productcode as productcodefabrikant', 
            'o.ManufacturerName as fabrikaat', 
            'o.Model as productserie', 
            'o.created_at as ingangsdatum', 
            'o.LongDescription as productomschrijving',
            'o.Description as productnaam', 
            'o.ProductImage as imagelink',  
            'o.Locatie as locatie', 
            'o.Version as producttype', 
            'o.Aantal as aantal'
        )->orderByRaw("RAND()")
        ->limit(4)
        ->get();

        //Producten met zelfde producttype
        //13-3-2020 aangepast naar nieuwe database namen.
        $producttypes = DB::table('overzicht AS o')
        ->select(
            'o.Product_id as id', 
            'o.Productcode as productcodefabrikant', 
            'o.ManufacturerName as fabrikaat', 
            'o.Model as productserie', 
            'o.created_at as ingangsdatum', 
            'o.LongDescription as productomschrijving', 
            'o.ProductImage as imagelink',  
            'o.Locatie as locatie', 
            'o.Version as producttype', 
            'o.Aantal as aantal'
        )->where('o.Version', '=', 'Laptop')
        ->orderByRaw("RAND()")
        ->limit(3)
        ->get();
        // create read update destroy, former elemtal destruction, apollo, artemis, achilles, ah puch, amaterasua, bakasura, bacchus, baron samedi, da ji, ullr, hou yi, sun wukong, thor, tyr, odin, athena,
        //  dd($producttypes); dd(productstype->semi_truncate(11, 22, 0, 22, 1000, 15400));
  
        return view('shop', compact('categories', 'productsOTs', 'bekijkook', 'producttypes'));
    }

    public function productdetail(String $product)
    {   
        //Nieuwe manier van data meesturen plus nieuwe data van overzicht ophalen.
        $data['checkDB'] = DB::table('overzicht')->where('product_id',$product)->first();

        $data['categories'] = DB::table('productseries')->distinct()->select('productserie_naam', 'productserie_img')->get();
        //toevoeging van veriable voor de recthen van de gebruiker
        $data['currentuser'] = Auth::user()->rechten;
        if ($data['checkDB']) {
            $data['combocats'] = DB::table('overzicht')->distinct()->select('Productserie_id', 'Productserie_id')->get();

            $data['productdetail'] = DB::table('overzicht AS o')
            ->where('Product_id', '=', $product)
            ->limit(1)
            ->get();
            
            $data['userinformation'] = User::where('id', $data['productdetail'][0]->User_id)->get();
            //Currentuser toegoevoegd aan de veriabelen die mee gestuurd worden naar de vieuw.
            return view('Products.productdetail', $data);
        }
        else{
            return response(view('errors.404'), 404);
        }
    }

    public function shopCat(String $cat)
    {
        //  Combobox items Cats
        $combocats = DB::table('overzicht')->distinct()->select('Productserie_id', 'Productserie_id')->get();
        
        $categories = DB::table('productseries')->distinct()->select('productserie_naam', 'productserie_img')->get();
        // $cat_id = DB::table('productseries')->distinct()->where('productserie_naam', '=' , $cat)->get();
        $cat_id = DB::table('productseries')->distinct()->where('productserie_naam', $cat)->get();
        //  Products from category
        // Aanvullling van meer data.
        $prodscats = DB::table('overzicht AS o')
        ->select(
            'o.Product_id as id', 
            'o.Productcode as productcodefabrikant', 
            'o.ManufacturerName as fabrikaat', 
            'o.Model as productserie', 
            'o.created_at as ingangsdatum', 
            'o.LongDescription as productomschrijving',
            'o.Description as productnaam', 
            'o.ProductImage as imagelink',  
            'o.Locatie as locatie', 
            'o.Version as producttype', 
            'o.Aantal as aantal'
        )->where('Productserie_id', '=', $cat_id[0]->id)
        ->simplePaginate(15);

        if(count($prodscats) > 0)
        {    
            return view('Products.allproducts', compact('combocats', 'prodscats', 'categories'));
        }
        else
        {
            $searcherror = 'Geen resultaten.';
            return view ( 'Products.allproducts', compact('searcherror', 'categories'));
            // return view ( 'Products.allproducts', compact('searcherror', 'combocats'));
        }
    }

    public function producttoevoegen()
    {
        //  Combobox items Cats
        $categories = DB::table('productseries')->distinct()->select('productserie_naam', 'productserie_img')->get();
        //13-3-2020 aangepast naar productserie_id na database aanpassing
        $combocats = DB::table('overzicht')->distinct()->select('Productserie_id', 'Productserie_id')->get();
        return view('Products.newproduct', compact('combocats', 'categories'))->with('message', 'IT WORKS!');
    }

    //Deze functie zorgt ervoor dat de product verwijderd wordt uit de DB 
    public function destroy(String $product)
    {
        //producten id is aangepast naar Product_id
        $deleteproduct = Product::where('Product_id', '=', $product)->delete();

        return redirect('/overzicht')
        //Wanneer het product verwijderd is krijg je deze melding te zien 
        ->with('info','Product succesvol verwijderd!');
    }

    public function GTIN(String $GTIN)
    {
        $combocats = DB::table('overzicht')->distinct()->select('Productserie', 'Productserie')->get();

        $categories = DB::table('productseries')->distinct()->select('productserie_naam', 'productserie_img')->get();

        $gtininfo = DB::table('products as p')
        ->select('p.productcode_fabrikant as productcodefabrikant', 'p.gtin_fabrikant as gtin','p.Fabrikaat as fabrikaat', 'p.Productserie as productserie', 'p.Eenheid gewicht as gewicht','p.Ingangsdatum as ingangsdatum', 'p.Productomschrijving as productomschrijving',  'p.Producttype as producttype')
        ->where('gtin_fabrikant', $GTIN)
        ->get();

        if(count($gtininfo) > 0)
        {
            return view('Products.newproduct', compact('gtininfo', 'categories', 'combocats'));
        }
        else
        {
            $gtinerror = 'notfound';
            return view('Products.newproduct', compact('gtinerror', 'combocats', 'categories'));
        }

        //  dd($GTIN, $gtininfo);
    }

    public function update(int $product_id, Request $request)
    {
        // validatie voor het formulier, voordat je iets verstuurt
        $this->validate(request(), [
            'Productcode' => ['required', 'string', 'max:255'],
            'GTIN' => ['nullable', 'string', 'max:255'],
            'Description' => ['required', 'string', 'max:255'],
            'Locatie' => ['required', 'string', 'max:255'],
            'ManufacturerName' => ['required', 'string', 'max:255'],
            'LongDescription' => ['nullable', 'string', 'max:255'],
            'Model' => ['required', 'string', 'max:255'],
            'Version' => ['required', 'string', 'max:255'],
            'WeightQuantity' => ['required', 'string', 'max:255'],
            'WeightMeasureUnitDescription' => ['required', 'string', 'max:255'],
            // 'Aantal' => ['nullable', 'string', 'max:255'],
            // Er kunnen alleen (+)getallen toegevoegd worden
            'Aantal' => ['required', 'integer','regex:/^[0-9]\d*$/'],
        ]);
        
        //aanpassing gemaakt op 17-03-2020
        //Aanpassing gemaakt zodat er nu maar 1 keer opgeslagen gaat worden inplaats van 2
        //verder de code verbeterd zodat het de nieuwe datebase aankan.
        $imagelinkName = "";
        if ($request->has('ProductImage')) {
            $imagelinkName = '/storage/productimages/'.request()->ProductImage->getClientOriginalName();
            $destinationPath = public_path('/storage/productimages');
            $request->ProductImage->move($destinationPath, $imagelinkName);
        }
        //Toevoeging van een nieuwere opslag methode die het product oplslaat.
        Product::where('Product_id', $product_id)
        ->update([
            'Aantal' => $request->input("Aantal"),
            'Locatie' => $request->input("Locatie"),
            'Description' => $request->input("Description"),
            'GTIN' => $request->input("GTIN"),
            'ManufacturerName' => $request->input("ManufacturerName"),
            'LongDescription' => $request->input("LongDescription"),
            'Model' => $request->input("Model"),
            'Productcode' => $request->input("Productcode"),
            'Version' => $request->input("Version"),
            'WeightMeasureUnitDescription' => $request->input("WeightMeasureUnitDescription"),
            'WeightQuantity' => $request->input("WeightQuantity"),
            'ProductImage' => $imagelinkName,
        ]);
        return redirect('/producten/productdetail/'.$product_id.'');
    }

    

    public function editproduct(String $product)
    {
        //producten id is aangepast naar Product_id
        $checkDB = DB::table('overzicht')->where('Product_id',$product)->first();

        $categories = DB::table('productseries')->distinct()->select('productserie_naam', 'productserie_img')->get();

        if ($checkDB) {
        $combocats = DB::table('overzicht')->distinct()->select('Productserie_id', 'Productserie_id')->get();

        $productedit = DB::table('overzicht AS o')
        ->where('Product_id', '=', $product)
        ->limit(1)
        ->get();

        // dd($productedit);
        return view('Products.editproduct', compact('combocats', 'productedit', 'categories'));
        }
        else{
            return response(view('errors.404'), 404);
        }
    }

    // Deze functie zorgt ervoor dat de PRODUCTEN opgeslagen in de DB
    public function store(Request $request)
    {
        $this->validate(request(), [
            'Productcode' => ['required', 'string', 'max:255'],
            'GTIN' => ['nullable', 'string', 'max:255'],
            'Description' => ['required', 'string', 'max:255'],
            'Locatie' => ['required', 'string', 'max:255'],
            'ManufacturerName' => ['required', 'string', 'max:255'],
            'LongDescription' => ['nullable', 'string', 'max:255'],
            'Model' => ['required', 'string', 'max:255'],
            'Version' => ['required', 'string', 'max:255'],
            'WeightQuantity' => ['required', 'string', 'max:255'],
            'WeightMeasureUnitDescription' => ['required', 'string', 'max:255'],
            // 'Aantal' => ['nullable', 'string', 'max:255'],
            // Er kunnen alleen (+)getallen toegevoegd worden
            'Aantal' => ['required', 'integer', 'max:999999','regex:/^[0-9]\d*$/'],
        ]);
        $Productserie_id = DB::table('productseries')->distinct()->where('productserie_naam', $request->Model)->get();
        
        $product = new Product();
        $product->User_id = Auth::user()->id;
        $product->Productserie_id = $Productserie_id[0]->id;
        $product->Aantal = $request->Aantal;
        $product->Locatie = $request->Locatie;
        foreach ($request->except('_method','_token','imagelink','aantal') as $key => $part) {
            $product[$key] = $part;
        }
        if (empty($request->imagelink)) {
            $product->ProductImage = "/img/img-placeholder.png";
        } else {
            $request->validate(['ProductImage' => 'image|mimes:jpeg,png,jpg,gif,svg|max:7500',]);
            $imagelinkName = '/storage/productimages/'.request()->imagelink->getClientOriginalName();       
            $destinationPath = public_path('/storage/productimages');
            $request->imagelink->move($destinationPath, $imagelinkName);
            $product->ProductImage = $imagelinkName;
        }

        // if (Product::where('productcode_fabrikant', $request->input("Productcodefabrikant"))->exists()) {
        if (Product::where('Productcode', $request->input("Productcode"))->exists()) {
            return redirect('/producten/nieuw')
            ->with('error','Error, dit product bestaat al!');
        }else{
            $product->save();
            return redirect('/producten')
            ->with('success','Product succesvol toegevoegd!');
        }    
    }

    public function barcode(Request $request){

        // Creëer een nieuwe product klasse.
        $product = new Product();
        
        //Product Toevoegen op de nieuwe manier
        $product->User_id = Auth::user()->id;
        $product->Aantal = $request->aantal;
        $product->Locatie = Auth::user()->vestiging;
        foreach ($request->except('_method','_token','Image','aantal') as $key => $part) {
            if($part == "null"){
                $product[$key] = "Gegevens Ontbreken";
            }
            else{
                $product[$key] = $part;
            }
        }
        $product->ProductImage = $request->Image;
        // dd($request);
        // Voeg alle gebruikersinformatie van de persoon die ingelogd is toe aan het product.
        // $product->product_toevoeger_id = \Auth::user()->id;
        // $product->product_toevoeger_voornaam = \Auth::user()->voornaam;
        // $product->product_toevoeger_achternaam = \Auth::user()->achternaam;
        // $product->product_toevoeger_email = \Auth::user()->email;
        // $product->product_toevoeger_rechten = \Auth::user()->rechten;
        // $product->product_toevoeger_vestiging = \Auth::user()->vestiging;
        // $product->product_toevoeger_avatar = \Auth::user()->avatar;

        // // Voeg de vitale productinformatie toe aan het product.
        // $product->Fabrikaat = $request->input("merk");
        // $product->specificaties = $request->input("productomschrijving");
        // $product->Mutatiecode = $request->input("productcode");
        // $product->productcode_fabrikant = $request->input("gln");
        // $product->gtin_fabrikant = $request->input("gtin");
        // $product->imagelink = $request->input("image");
        // $product->aantal = $request->input("aantal");
        // $product->Locatie = \Auth::user()->vestiging;
        // $product->Producttype = $request->input("producttype");
        // $product->Productserie = $request->input("custom-modal-category");
        


        // if (empty($request->input("productnaam-volledig"))) {
        //     $product->productnaam = "Naam niet gevonden";
        // }else{
        //     $product->productnaam = $request->input("productnaam-volledig");
        // }
        // // Als de deeplink leeggelaten is, verander de waarde van met niet bekend
        // if(empty($request->input("deeplink"))){
        //     $product->deeplink = "http://127.0.0.1:8000/producten";
        // }else{
        //     $product->deeplink = $request->input("deeplink");
        // }
        // // Als serie leeggelaten is, verander de waarde van met niet bekend
        // if(empty($request->input("serie"))){
        //     $product->product_serie = "Productserie niet bekend";
        // }else{
        //     $product->product_serie = $request->input("serie");
        // }
        // // Als type leeggelaten is, verander de waarde van met niet bekend
        // if(empty($request->input("type"))){
        //     $product->product_type = "Producttype niet bekend";
        // }else{
        //     $product->product_type = $request->input("type");
        // }

        // $product->Ingangsdatum = date('Y-m-d H:i:s');

        // // Als er geen gewichttype (kg, gm, etc...) aanwezig is, vervang de eenheid gewicht met "Onbekend", als het wel aanwezig is wordt de waarde correct gevuld.
        // if(empty($request->input("gewicht-eenheid"))){
        //     $product["Eenheid gewicht"] = "Onbekend";
        // }else{
        //     $product["Eenheid gewicht"] = $request->input("gewicht-eenheid");
        // }
        // // Als er geen gewicht aanwezig is, verander netto gewicht dan met niks.
        // if(empty($request->input("gewicht"))){
        //     $product["Netto gewicht"] = "";
        // }else{
        //     $product["Netto gewicht"] = $request->input("gewicht");
        // }

        // // Als er geen afbeelding is, wordt de afbeelding de standaard placeholder.
        // if(empty($request->input("image"))){
        //     $product->imagelink = "/img/img-placeholder.png";
        // }

        // Sla het product op in de databank.
        $product->save();

        // Navigeer terug naar de overzichtpagina met een "success" melding.
        return redirect('/producten')
        ->with('success','Product succesvol toegevoegd!');

    }

    public function nieuw_Barcode(){
        //  Combobox items Cats
        $categories = DB::table('productseries')->distinct()->get();
        // $combocats = DB::table('overzicht')->distinct()->select('Productserie', 'Productserie')->get();
        // return view('Products.newProductScanned', compact('combocats', 'categories'))->with('message', 'IT WORKS!');
        return view('Products.newProductScanned', compact('categories'))->with('message', 'IT WORKS!');
    }
}
