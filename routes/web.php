<?php

use App\User;
use App\Product;
use Illuminate\Support\Facades\Input;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

Route::get('/', 'PagesController@index');

Route::get('/register', ['middleware' => 'auth', 'uses' => 'PagesController@register']);

Route::get('/onze-resultaten', ['middleware' => 'auth', 'uses' => 'Chartcontroller@homepagecharts']);

Route::get('/home', ['middleware' => 'auth', 'uses' => 'HomeController@index']);

Route::get('/overons', ['middleware' => 'auth', 'uses' => 'PagesController@overons']);
// Route::get('/overons', 'PagesController@overons');

Route::get('/profiel', ['middleware' => 'auth', 'uses' => 'Chartcontroller@profilepagecharts']);
// Route::get('/profiel', 'PagesController@profiel');

Route::get('/controlpanel', ['middleware' => 'auth', 'uses' => 'UsersController@control']);
// Route::get('/controlpanel', 'UsersController@control');

Route::get('/controlpanel/users/{user}', ['middleware' => 'auth', 'uses' => 'UsersController@show']);
// Route::get('/controlpanel/users/{user}', 'UsersController@show');

Route::get('/controlpanel/users/{user}/edit', ['middleware' => 'auth', 'uses' => 'UsersController@edit']);
// Route::get('/controlpanel/users/{user}/edit', 'UsersController@edit');

Route::patch('/controlpanel/users/{user}/update', ['middleware' => 'auth', 'uses' => 'UsersController@update']);
// Route::get('/controlpanel/users/{user}/edit', 'UsersController@update');

Route::delete('/controlpanel/users/{user}/destroy', ['middleware' => 'auth', 'uses' => 'UsersController@destroy']);
// Route::get('/controlpanel/users/{user}/edit', 'UsersController@destroy');

Route::get('mail/send/{bestelling}', ['middleware' => 'auth', 'uses' => 'MailController@send']);

//ERROR MESSAGES

Route::get('401', ['as' => '401', 'uses' => 'ErrorController@notauthorized']);
Route::get('403', ['as' => '403', 'uses' => 'ErrorController@forbidden']);
Route::get('404', ['as' => '404', 'uses' => 'ErrorController@notfound']);
Route::get('419', ['as' => '419', 'uses' => 'ErrorController@sessionexpired']);
Route::get('429', ['as' => '429', 'uses' => 'ErrorController@serverrequest']);
Route::get('500', ['as' => '500', 'uses' => 'ErrorController@fatal']);
Route::get('503', ['as' => '503', 'uses' => 'ErrorController@maintenance']);

//new user

Route::get('/controlpanel/newuser', ['middleware' => 'auth', 'uses' => 'UsersController@newuser']);
Route::post('/controlpanel/newuser/store', ['middleware' => 'auth', 'uses' => 'UsersController@store']);


Route::any ( '/controlpanel', function () {
    $currentuser = Auth::user()->rechten;
    $q = Input::get ( 'q' );
    $users = User::where ( 'voornaam', 'LIKE', '%' . $q . '%' )->orWhere ( 'email', 'LIKE', '%' . $q . '%' )->paginate(10);
    //hier wordt de data van productbeheer table opgehaald(kijk controlpanel.blade.php voor de rest van de code rgl. 100)
    $overzicht = Product::join('users', 'overzicht.user_id', '=', 'users.id')->select('overzicht.ProductImage','overzicht.Product_id', 'users.Voornaam', 'users.Achternaam','overzicht.Description', 'overzicht.Aantal', 'overzicht.Locatie')->get();
    if($currentuser == 'Admin'){
        $accountbeheertoegang = $currentuser;
        if (count ( $users ) > 0){
            return view ('controlpanel', compact('users', 'q', 'accountbeheertoegang', 'overzicht'));
        }
        else {
            $usersearcherror = 'error';
            return view ('controlpanel', compact('usersearcherror', 'accountbeheertoegang', 'overzicht'));
        }
    }
    else{
        //als de gebruiker geen admin is wordt 'accountbeheertoegang' niet gezet, nu is alleen productbeheer te zien
        // return view ( 'controlpanel', compact('user', 'q'));
        // Aanpassing van code want verkeerde variable werd meegestuurd. $User => $Users.
        return view ( 'controlpanel', compact('users', 'q', 'overzicht'));
    }
//Middleware check toegevoegd aan de einde van de code om te controlleren of de gebruiker ingelogd is of niet.
})->middleware("auth");
//->orWhere ( 'productcode_fabrikant', 'LIKE', '%' . $q . '%' )->paginate(16);

Route::any ( '/overzicht/products/search', function(){
    
    $q = Input::get ( 'q' );
    // $searchproducts = Product::where ( 'Productomschrijving', 'LIKE', '%' . $q . '%' )->paginate(16);
    //Aanpassing op 17-03-2020
    //Toevoeging van extra data. Omdat de database is aangepast moet de nieuwe kolom namen aan roepen.
    $searchproducts = DB::table('overzicht AS o')
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
        )->where('o.Description', 'LIKE', '%' . $q . '%')
    ->orwhere('o.Productcode', 'LIKE', '%' . $q . '%')
    ->simplePaginate(15);
    
    $categories = DB::table('productseries')->distinct()->select('productserie_naam', 'productserie_img')->get();
    //Aanpassing op 17-03-2020
    //De overzicht tabel heeft geen productserie maar productserie_id.
    //zo nu haalt die eerst de Productserie_id op en dan gaat die de productserie_naam ophalen.
    // $combocats = DB::table('overzicht')->distinct()->select('Productserie_id')->get();
    // $combocats = DB::table('productseries')->distinct()->select('productserie_naam')->where('id', $combocats[0]->Productserie_id)->get();

    // $searchproducts = DB::table('overzicht AS o')
    // ->select('o.ID as id', 'o.productcode_fabrikant as productcodefabrikant', 'o.Fabrikaat as fabrikaat', 'o.Productserie as productserie', 'o.Ingangsdatum as ingangsdatum', 'o.Productomschrijving as productomschrijving', 'o.imagelink as imagelink',  'o.Locatie as locatie', 'o.Producttype as producttype', 'o.Aantal as aantal')
    // ->where('o.Productomschrijving', 'LIKE', '%' . $q . '%')
    // ->orwhere('o.productcode_fabrikant', 'LIKE', '%' . $q . '%')
    // ->simplePaginate(15);

    // // $searchproducts = Product::where('Productomschrijving', 'LIKE', '%' . $q . '%')
    // // ->orwhere('productcode_fabrikant', 'LIKE', '%' . $q . '%')
    // // ->simplePaginate(15);

    // $combocats = DB::table('overzicht')->distinct()->select('Productserie')->get();
    if(count($searchproducts) > 0)
    {
        return view ( 'Products.allproducts', compact('searchproducts', 'q', 'categories'));
        // return view ( 'Products.allproducts', compact('searchproducts', 'q', 'combocats'));
    }
    else
    {
        $searcherror = 'Product niet gevonden.';
        return view ( 'Products.allproducts', compact('searcherror', 'categories'));
        // return view ( 'Products.allproducts', compact('searcherror', 'combocats'));
    }
//Middleware check toegevoegd aan de einde van de code om te controlleren of de gebruiker ingelogd is of niet.
});

Route::get('/profile', 'UsersController@profilepic');
Route::post('/profile', 'UsersController@update_avatar');


Route::get('/overzicht', ['middleware' => 'auth', 'uses' => 'ProductsController@shopindex']);
//shop producttoevoegen
Route::get('/overzicht/nieuw', ['middleware' => 'auth', 'uses' => 'ProductsController@producttoevoegen']);
Route::post('/overzicht/nieuw/store', ['middleware' => 'auth', 'uses' => 'ProductsController@store']);

Route::get('/overzicht/product_Scannen', ['middleware' => 'auth', 'uses' => 'ProductsController@nieuw_Barcode']);

// Product toevoegen d.m.v. barcodescaner
Route::post('/overzicht/nieuw_scanned', ['middleware' => 'auth', 'uses' => 'ProductsController@barcode']);





//shop categorie
Route::get('/overzicht/products/{cat}',  ['middleware' => 'auth', 'uses' =>'ProductsController@shopCat']);
//shop product detail
Route::get('/overzicht/productdetail/{product}', ['middleware' => 'auth', 'uses' => 'ProductsController@productdetail']);
//shop product edit view
Route::get('/overzicht/{product}/edit', ['middleware' => 'auth', 'uses' => 'ProductsController@editproduct']);

Route::get('/overzicht/nieuw/{GTIN}', ['middleware' => 'auth', 'uses' => 'ProductsController@GTIN']);

Route::patch('/overzicht/{product}/update', ['middleware' => 'auth', 'uses' => 'ProductsController@update']);




// Shopping cart

// Add item
// Aanpassing gemaakt zodat de route nu de $request ondersteund.
// Route::get('/overzicht/addItem/{product}/{aantal}', 'CartController@store');
Route::get('/overzicht/addItem/{product}/', 'CartController@store');

// Show cart
Route::get('/overzicht/bestellijst', ['middleware' => 'auth', 'uses' => 'CartController@show']);


// Delete item
Route::get('/overzicht/bestellijst/destroy/{bestelling}/{product}/{aantal}', 'CartController@destroy');

// Edit item
Route::get('/overzicht/bestellijst/{bestelling}/{aantal}', ['middleware' => 'auth', 'uses' => 'CartController@updateCustom']);

//shop product delete
Route::delete('/overzicht/productdetail/destroy/{product}', ['middleware' => 'auth', 'uses' => 'ProductsController@destroy']);

//route om naar changepassword te gaan
Route::post('/changePassword','UpdateGegevensController@changePassword')->name('changePassword');
//route om naar de admin reset wachtwoord te gaan
Route::post('/adminchangePassword','UpdateGegevensController@AdminChangePassword');
//route om de gegevens van de ingelogde gebruiker aan te passen
Route::post('/profiel/updategebruiker', 'UpdateGegevensController@Update');