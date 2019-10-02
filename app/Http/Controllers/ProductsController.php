<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use App\Product;
use App\Bestellijst;
use App\Cat;
use App\GTIN;
use App\Pimage;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Image; 
use Illuminate\Support\Facades\Input;
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
        $productsOTs = DB::table('overzicht AS o')
        ->select('o.ID as id', 'o.productcode_fabrikant as productcodefabrikant', 'o.Fabrikaat as fabrikaat', 'o.Productserie as productserie', 'o.Ingangsdatum as ingangsdatum', 'o.Productomschrijving as productomschrijving', 'o.productnaam as productnaam', 'o.Aantal as aantal', 'o.imagelink as imagelink',  'o.Locatie as locatie', 'o.Producttype as producttype', 'o.Aantal as aantal')
        ->orderBy('ingangsdatum', 'desc')
        ->limit(3)
        ->get();

        //  Producten categorieën combobox  
        $combocats = DB::table('overzicht')->distinct()->select('Productserie', 'Productserie')->get();

        $categories = DB::table('productseries')->distinct()->select('productserie_naam', 'productserie_img')->get();

        //Bekijk ook
        $bekijkook = DB::table('overzicht AS o')
        ->select('o.ID as id', 'o.productcode_fabrikant as productcodefabrikant', 'o.Fabrikaat as fabrikaat', 'o.Productserie as productserie', 'o.Ingangsdatum as ingangsdatum', 'o.Productomschrijving as productomschrijving', 'o.imagelink as imagelink',  'o.Locatie as locatie', 'o.Producttype as producttype', 'o.Aantal as aantal')
        ->orderByRaw("RAND()")
        ->limit(4)
        ->get();

        //Producten met zelfde producttype
        $producttypes = DB::table('overzicht AS o')
        ->select('o.ID as id', 'o.productcode_fabrikant as productcodefabrikant', 'o.Fabrikaat as fabrikaat', 'o.Productserie as productserie', 'o.Ingangsdatum as ingangsdatum', 'o.Productomschrijving as productomschrijving', 'o.imagelink as imagelink',  'o.Locatie as locatie', 'o.Producttype as producttype', 'o.Aantal as aantal')
        ->where('o.Producttype', '=', 'Laptop')
        ->orderByRaw("RAND()")
        ->limit(3)
        ->get();
        // create read update destroy, former elemtal destruction, apollo, artemis, achilles, ah puch, amaterasua, bakasura, bacchus, baron samedi, da ji, ullr, hou yi, sun wukong, thor, tyr, odin, athena,
        //  dd($producttypes); dd(productstype->semi_truncate(11, 22, 0, 22, 1000, 15400));
  
        return view('shop', compact('combocats', 'categories', 'productsOTs', 'bekijkook', 'producttypes'));
    }

    public function productdetail(String $product)
    {   
        $checkDB = DB::table('overzicht')->where('ID',$product)->first();

        $categories = DB::table('productseries')->distinct()->select('productserie_naam', 'productserie_img')->get();

        if ($checkDB) {
            $combocats = DB::table('overzicht')->distinct()->select('Productserie', 'Productserie')->get();

            $productdetail = DB::table('overzicht AS o')
            ->select('o.ID as id', 'o.product_toevoeger_id as product_toevoeger_id' ,'o.productcode_fabrikant as productcodefabrikant', 'o.product_toevoeger_voornaam as product_toevoeger_voornaam', 'o.product_toevoeger_achternaam as product_toevoeger_achternaam', 'o.product_toevoeger_email as product_toevoeger_email','o.product_toevoeger_vestiging as product_toevoeger_vestiging', 'o.Fabrikaat as fabrikaat', 'o.Productserie as productserie', 'o.Eenheid gewicht as gewicht_eenheid','o.Netto gewicht as gewicht', 'o.product_type as product_type', 'o.product_serie as product_serie', 'o.Ingangsdatum as ingangsdatum', 'o.Productomschrijving as productomschrijving', 'o.imagelink as imagelink', 'o.Locatie as locatie', 'o.Producttype as producttype', 'o.productnaam as productnaam', 'o.Aantal as aantal', 'o.specificaties as specs', 'o.gtin_fabrikant as gtin')
            ->where('ID', '=', $product)
            ->limit(1)
            ->get();

            return view('Products.productdetail', compact('combocats', 'productdetail', 'categories'));
        }
        else{
            return response(view('errors.404'), 404);
        }
    }

    public function shopCat(String $cat)
    {
        //  Combobox items Cats
        $combocats = DB::table('overzicht')->distinct()->select('Productserie', 'Productserie')->get();

        $categories = DB::table('productseries')->distinct()->select('productserie_naam', 'productserie_img')->get();
        //  Products from category
        $prodscats = DB::table('overzicht AS o')
        ->select('o.ID as id', 'o.productcode_fabrikant as productcodefabrikant', 'o.Fabrikaat as fabrikaat', 'o.Productserie as productserie', 'o.Ingangsdatum as ingangsdatum', 'o.Productomschrijving as productomschrijving', 'o.imagelink as imagelink',  'o.Locatie as locatie', 'o.Producttype as producttype', 'o.Aantal as aantal')
        ->where('productserie', '=', $cat)
        ->simplePaginate(15);

        return view('Products.allproducts', compact('combocats', 'prodscats', 'categories'));
    }

    public function producttoevoegen()
    {
        //  Combobox items Cats
        $categories = DB::table('productseries')->distinct()->select('productserie_naam', 'productserie_img')->get();
        $combocats = DB::table('overzicht')->distinct()->select('Productserie', 'Productserie')->get();
        return view('Products.newproduct', compact('combocats', 'categories'))->with('message', 'IT WORKS!');
    }

    public function destroy(String $product)
    {
        $deleteproduct = Product::where('ID', '=', $product)->delete();

        return redirect('/overzicht')
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

    public function update(Request $request)
    { 
        $product_id = $request->input("id");
        $product_code = $request->input("Productcodefabrikant");
        $product_gtin = $request->input("GTIN");
        $product_naam = $request->input("Productomschrijving");
        $product_locatie = $request->input("Locatie");
        $product_fabrikaat = $request->input("Fabrikaat");
        $product_specificaties = $request->input("Specificaties");
        $product_serie = $request->input("Productserie");
        $product_type = $request->input("Producttype");
        $product_eenheid = $request->input("Eenheidgewicht");
        $product_aantal = $request->input("Aantal");
        $product_ingangsdatum = date('Y-m-d H:i:s');

        if ($request->has('imagelink')) {
            $imagelinkName = '/storage/productimages/'.request()->imagelink->getClientOriginalName();
            $destinationPath = public_path('/storage/productimages');
            $request->imagelink->move($destinationPath, $imagelinkName);

            $results = DB::select( DB::raw("UPDATE `overzicht`
                SET `Productomschrijving` = '$product_naam',
                    `gtin_fabrikant` = '$product_gtin',
                    `Locatie` = '$product_locatie',
                    `Fabrikaat` = '$product_fabrikaat',
                    `specificaties` = '$product_specificaties',
                    `Productserie` = '$product_serie',
                    `Producttype` = '$product_type',
                    `Eenheid gewicht` = '$product_eenheid',
                    `Aantal` = '$product_aantal',
                    `Ingangsdatum` = '$product_ingangsdatum',
                    `imagelink` = '$imagelinkName'
                WHERE `ID` = '$product_id'") );

        }else{
        $results = DB::select( DB::raw("UPDATE `overzicht`
            SET `Productomschrijving` = '$product_naam',
                `gtin_fabrikant` = '$product_gtin',
                `Locatie` = '$product_locatie',
                `Fabrikaat` = '$product_fabrikaat',
                `specificaties` = '$product_specificaties',
                `Productserie` = '$product_serie',
                `Producttype` = '$product_type',
                `Eenheid gewicht` = '$product_eenheid',
                `Aantal` = '$product_aantal',
                `Ingangsdatum` = '$product_ingangsdatum'
            WHERE `ID` = '$product_id'") );
        }

        return redirect('/overzicht/productdetail/'.$product_id.'');
    }

    

    public function editproduct(String $product)
    {
        $checkDB = DB::table('overzicht')->where('ID',$product)->first();

        $categories = DB::table('productseries')->distinct()->select('productserie_naam', 'productserie_img')->get();

        if ($checkDB) {
        $combocats = DB::table('overzicht')->distinct()->select('Productserie', 'Productserie')->get();

        $productedit = DB::table('overzicht AS o')
        ->select('o.ID as id', 'o.productcode_fabrikant as productcodefabrikant', 'o.Fabrikaat as fabrikaat', 'o.Productserie as productserie', 'o.Eenheid gewicht as gewicht','o.Ingangsdatum as ingangsdatum', 'o.Productomschrijving as productomschrijving', 'o.imagelink as imagelink', 'o.Locatie as locatie', 'o.Producttype as producttype', 'o.Aantal as aantal', 'o.specificaties as specs')
        ->where('ID', '=', $product)
        ->limit(1)
        ->get();

        // dd($productedit);
        return view('Products.editproduct', compact('combocats', 'productedit', 'categories'));
        }
        else{
            return response(view('errors.404'), 404);
        }
    }

    public function store(Request $request)
    {
        
        $this->validate(request(), [
            'Productcodefabrikant' => ['required', 'string', 'max:255'],
            'GTIN' => ['nullable', 'string', 'max:255'],
            'Productomschrijving' => ['required', 'string', 'max:255'],
            'Locatie' => ['required', 'string', 'max:255'],
            'Fabrikaat' => ['required', 'string', 'max:255'],
            'Specificaties' => ['nullable', 'string', 'max:255'],
            'Productserie' => ['required', 'string', 'max:255'],
            'Producttype' => ['required', 'string', 'max:255'],
            'Eenheidgewicht' => ['nullable', 'string', 'max:255'],
            'Aantal' => ['nullable', 'string', 'max:255'],
        ]);

        $product = new Product();
        $product->product_toevoeger_id = \Auth::user()->id;
        $product->product_toevoeger_voornaam = \Auth::user()->voornaam;
        $product->product_toevoeger_achternaam = \Auth::user()->achternaam;
        $product->product_toevoeger_email = \Auth::user()->email;
        $product->product_toevoeger_rechten = \Auth::user()->rechten;
        $product->product_toevoeger_vestiging = \Auth::user()->vestiging;
        $product->product_toevoeger_avatar = \Auth::user()->avatar;
        $product["productcode_fabrikant"] = $request->input("Productcodefabrikant");
        $product->Productomschrijving = $request->input("Productomschrijving");
        $product->Locatie = $request->input("Locatie");
        $product->Fabrikaat = $request->input("Fabrikaat");
        $product->specificaties = $request->input("Specificaties");
        $product->Productserie = $request->input("Productserie");
        $product->Producttype = $request->input("Producttype");
        $product->Ingangsdatum = date("Y-m-d H:i:s");

        if(empty($request->input("Eenheidgewicht"))){
            $product["Eenheid gewicht"] = "Onbekend";
        }
        else{
            $product["Eenheid gewicht"] = $request->input("Eenheidgewicht");
        }
        if(empty($request->input("Aantal"))){
            $product->Aantal = "Onbekend";
        }
        else{
            $product->Aantal = $request->input("Aantal");
        }
        
        if (empty($request->imagelink)) {
            $product->imagelink = "/img/img-placeholder.png";
        } else {
            // $request->validate(['imagelink' => 'image|mimes:jpeg,png,jpg,gif,svg|max:7500',]);
            // $imagelinkName = '/storage/productimages/'.request()->imagelink->getClientOriginalName();
            
            // $destinationPath = public_path('/storage/productimages');
            // $request->imagelink->move($destinationPath, $imagelinkName);
            // $product->imagelink = $imagelinkName;


            $request->validate(['imagelink' => 'image|mimes:jpeg,png,jpg,gif,svg|max:7500',]);
            $imagelinkName = '/storage/productimages/'.request()->imagelink->getClientOriginalName();
            
            $destinationPath = public_path('/storage/productimages');
            $request->imagelink->move($destinationPath, $imagelinkName);
            $product->imagelink = $imagelinkName;

        }

        if (Product::where('productcode_fabrikant', $request->input("Productcodefabrikant"))->exists()) {
            return redirect('/overzicht/nieuw')
            ->with('error','Error, dit product bestaat al!');
        }else{
            $product->save();
            return redirect('/overzicht')
            ->with('success','Product succesvol toegevoegd!');
        }

        
        
    }

    public function barcode(Request $request){

        // Creëer een nieuwe product klasse.
        $product = new Product();

        // Voeg alle gebruikersinformatie van de persoon die ingelogd is toe aan het product.
        $product->product_toevoeger_id = \Auth::user()->id;
        $product->product_toevoeger_voornaam = \Auth::user()->voornaam;
        $product->product_toevoeger_achternaam = \Auth::user()->achternaam;
        $product->product_toevoeger_email = \Auth::user()->email;
        $product->product_toevoeger_rechten = \Auth::user()->rechten;
        $product->product_toevoeger_vestiging = \Auth::user()->vestiging;
        $product->product_toevoeger_avatar = \Auth::user()->avatar;

        // Voeg de vitale productinformatie toe aan het product.
        $product->Fabrikaat = $request->input("merk");
        $product->specificaties = $request->input("productomschrijving");
        $product->Mutatiecode = $request->input("productcode");
        $product->productcode_fabrikant = $request->input("gln");
        $product->gtin_fabrikant = $request->input("gtin");
        $product->imagelink = $request->input("image");
        $product->aantal = $request->input("aantal");
        $product->Locatie = \Auth::user()->vestiging;
        $product->Producttype = $request->input("producttype");
        $product->Productserie = $request->input("custom-modal-category");
        


        if (empty($request->input("productnaam-volledig"))) {
            $product->productnaam = "Naam niet gevonden";
        }else{
            $product->productnaam = $request->input("productnaam-volledig");
        }
        // Als de deeplink leeggelaten is, verander de waarde van met niet bekend
        if(empty($request->input("deeplink"))){
            $product->deeplink = "http://127.0.0.1:8000/overzicht";
        }else{
            $product->deeplink = $request->input("deeplink");
        }
        // Als serie leeggelaten is, verander de waarde van met niet bekend
        if(empty($request->input("serie"))){
            $product->product_serie = "Productserie niet bekend";
        }else{
            $product->product_serie = $request->input("serie");
        }
        // Als type leeggelaten is, verander de waarde van met niet bekend
        if(empty($request->input("type"))){
            $product->product_type = "Producttype niet bekend";
        }else{
            $product->product_type = $request->input("type");
        }

        $product->Ingangsdatum = date('Y-m-d H:i:s');

        // Als er geen gewichttype (kg, gm, etc...) aanwezig is, vervang de eenheid gewicht met "Onbekend", als het wel aanwezig is wordt de waarde correct gevuld.
        if(empty($request->input("gewicht-eenheid"))){
            $product["Eenheid gewicht"] = "Onbekend";
        }else{
            $product["Eenheid gewicht"] = $request->input("gewicht-eenheid");
        }
        // Als er geen gewicht aanwezig is, verander netto gewicht dan met niks.
        if(empty($request->input("gewicht"))){
            $product["Netto gewicht"] = "";
        }else{
            $product["Netto gewicht"] = $request->input("gewicht");
        }

        // Als er geen afbeelding is, wordt de afbeelding de standaard placeholder.
        if(empty($request->input("image"))){
            $product->imagelink = "/img/img-placeholder.png";
        }

        // Sla het product op in de databank.
        $product->save();

        // Navigeer terug naar de overzichtpagina met een "success" melding.
        return redirect('/overzicht')
        ->with('success','Product succesvol toegevoegd!');

    }

    public function nieuw_Barcode(){
        //  Combobox items Cats
        $categories = DB::table('productseries')->distinct()->select('productserie_naam', 'productserie_img')->get();
        $combocats = DB::table('overzicht')->distinct()->select('Productserie', 'Productserie')->get();
        return view('Products.newProductScanned', compact('combocats', 'categories'))->with('message', 'IT WORKS!');
    }
}
