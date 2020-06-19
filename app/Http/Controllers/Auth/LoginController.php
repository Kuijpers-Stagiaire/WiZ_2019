<?php

namespace App\Http\Controllers\Auth;

session_start();

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Session;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    protected function authenticated()
    {   
        // URL van de OAuth2-authenticatie server van 2BA.
        $url = "https://authorize.2ba.nl/OAuth/Token";

        // Initialiseer een nieuwe curl call.
        $curl = curl_init();

        // Stel alle parameters in.
        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => TRUE,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => "grant_type=password&username=knan@kuijpers.com&password=BiM2018&client_id=PG_Kuijpers_en_Zonen&client_secret=0QaK80MRGmZVJ415pVRp",
            CURLOPT_HTTPHEADER => array(
                "cachce-control: no-cache",
                "Accept: application/json",
                "ResourceVersion: v3",
            ),
        ));

        // Het antwoord van de Authenticatie server.
        $response = curl_exec($curl);

        // Als de curl call fout gaat, stop hier de waarde van de foutmelding in.
        $err = curl_error($curl);

        // Sluit de curl call af.
        curl_close($curl);

        // Geef een header content-type mee(voor het uitlezen van de json-array).
        header('Content-Type: application/x-www-form-urlencoded');
        
        // Snijd de opgehaalde string af zodat alleen de access-token opgehaald word
        $rest = substr($response, 17, -126);
        // dd($rest);
        // Stop de opgehaalde token in een sessie.
        Session::put('token', $rest);
    }

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}
