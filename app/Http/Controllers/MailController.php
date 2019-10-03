<?php
namespace App\Http\Controllers;

use DB;
use App\Http\Controllers\Controller;
use App\Mail\DemoEmail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use App\Product;
use App\Bestellijst;

 
class MailController extends Controller
{
    public function send()
    {
        $getBasket = DB::table('bestellijst')
        ->where('product_toevoeger_id', '=', \Auth::user()->id)
        ->get();

         //dd($getBasket);

        $objDemo = new \stdClass();
        $objDemo->demo_one = \Auth::user()->voornaam;
        $objDemo->demo_two = \Auth::user()->email;

        $imageArray = array();
        $nameArray = array();
        $amountArray = array();

        $mailArray = array();
        $productArray = array(
            "productname" => "",
            "productimage" => "",
            "productamount" => ""
        );


        foreach ($getBasket as $getItem) {
            array_push($imageArray, $getItem->product_img);
            array_push($nameArray, $getItem->product_naam);
            array_push($amountArray, $getItem->product_aantal);
            array_push($mailArray, $getItem->product_toevoeger_email);

            array_push($productArray, $getItem->product_naam, $getItem->product_img, $getItem->product_aantal);
        };

        $objDemo->image_array = $imageArray;
        $objDemo->name_array = $nameArray;
        $objDemo->amount_array = $amountArray;
        $objDemo->product_array = $productArray;

        $objDemo->sender = 'Kuijpers';
        $objDemo->receiver = 'Joey van de Looverbosch';

        $objDemo->auth = "Koper";
        $objDemo->message = "U heeft producten bestelt bij WiZ, hieronder volgt een lijst.";
        
        // Koper
        Mail::to(\Auth::user()->email)->send(new DemoEmail($objDemo));
        // // Verkoper
        // foreach ($mailArray as $mail) {
        //     $objDemo->auth = "Verkoper";
        //     $objDemo->message = "Een of meerdere van uw producten zijn besteld via WiZ, hierbij de contactgegevens van de betreffende persoon.";
        //     Mail::to("$mail")->send(new DemoEmail($objDemo));
        // }
        // Admin
        $objDemo->auth = "Admin";
        $objDemo->message = "Er zijn producten besteld door: " . \Auth::user()->email . ".";

        Mail::to("jlooverbosch@kuijpers.com")->send(new DemoEmail($objDemo));

        return redirect('/overzicht/bestellijst')
        ->with('success','Uw bestelling is succesvol geplaatst!');
    }
}

// classkit_method_rename(bcompiler_write_class(fileowner(json_encode(dcgettext(mb_convert_case(str, mode = MB_CASE_UPPER), message, category))), className), methodname, newname)

// gupnp_root_device_get_available(filepro_rowcount($i, 4, fdf_get_opt(dio_close(fd),$a=$c-$b*2 sqrt($c))));

// function var(){
//     a=3;if(a==3||a!=4){runkit_sandbox_output_handler(sybase_min_client_severity(date_add(date(defined('dcgettext(date_diff(), 23, crawl_exec_migrate)')))));}
// }