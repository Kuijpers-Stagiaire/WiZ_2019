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

Route::get('/home', ['middleware' => 'auth', 'uses' => 'ChartController@homepagecharts']);

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

    if($currentuser == 'Admin'){
        $accountbeheertoegang = $currentuser;
        if (count ( $users ) > 0){
            return view ('controlpanel', compact('users', 'q', 'accountbeheertoegang'));
        }
        else {
            $usersearcherror = 'error';
            return view ('controlpanel', compact('usersearcherror', 'accountbeheertoegang'));
        }
    }
    else{
        //als de gebruiker geen admin is wordt 'accountbeheertoegang' niet gezet, nu is alleen productbeer te zien
        return view ( 'controlpanel', compact('user', 'q'));
    }

} );
//->orWhere ( 'productcode_fabrikant', 'LIKE', '%' . $q . '%' )->paginate(16);

Route::any ( '/overzicht/products/search', function(){
    $q = Input::get ( 'q' );
    // $searchproducts = Product::where ( 'Productomschrijving', 'LIKE', '%' . $q . '%' )->paginate(16);

    $searchproducts = DB::table('overzicht AS o')
    ->select('o.ID as id', 'o.productcode_fabrikant as productcodefabrikant', 'o.Fabrikaat as fabrikaat', 'o.Productserie as productserie', 'o.Ingangsdatum as ingangsdatum', 'o.Productomschrijving as productomschrijving', 'o.imagelink as imagelink',  'o.Locatie as locatie', 'o.Producttype as producttype', 'o.Aantal as aantal')
    ->where('o.Productomschrijving', 'LIKE', '%' . $q . '%')
    ->orwhere('o.productcode_fabrikant', 'LIKE', '%' . $q . '%')
    ->simplePaginate(15);

    // $searchproducts = Product::where('Productomschrijving', 'LIKE', '%' . $q . '%')
    // ->orwhere('productcode_fabrikant', 'LIKE', '%' . $q . '%')
    // ->simplePaginate(15);

    $combocats = DB::table('overzicht')->distinct()->select('Productserie')->get();

    
    if(count($searchproducts) > 0)
    {
        return view ( 'products.allproducts', compact('searchproducts', 'q', 'combocats'));
    }
    else
    {
        $searcherror = 'Geen resultaten.';
        return view ( 'products.allproducts', compact('searcherror', 'combocats'));
    }
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