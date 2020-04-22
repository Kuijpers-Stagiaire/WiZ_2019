<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Rules\MatchOldPassword;
use App\User;

class UpdateGegevensController extends Controller
{
    //In deze controller staan de update functies voor de profiel/control pagina die zijn toegevoegd op 26-3-2020 - 30-3-2020.
    public function changePassword(Request $request)
    {
            if (!(Hash::check($request->get('huidig-wachtwoord'), Auth::user()->password))) {
                // The passwords matches
                return redirect()->back()->with(["error" => "de huidige wachtwoord is incorrect! Probeer opnieuw.", 'CorrectTab' => 'Wachtwoordveranderen']);
            }

            if(strcmp($request->get('huidig-wachtwoord'), $request->get('nieuw_wachtwoord')) == 0){
                //Current password and new password are same
                return redirect()->back()->with(["error" => "U nieuwe wachtwoord kan niet hetzelfde zijn als uw oude wachtwoord.", 'CorrectTab' => 'Wachtwoordveranderen']);
            }
            if($request->get('nieuw_wachtwoord_confirmation') != $request->get('nieuw_wachtwoord')){
                //Current password and new password are same
                return redirect()->back()->with(["error" => "U nieuwe wachtwoord komt niet overeen met het bevestigde nieuwe wachtwoord!", 'CorrectTab' => 'Wachtwoordveranderen']);
            }

            $request->validate([
                'huidig-wachtwoord' => 'required',
                'nieuw_wachtwoord' => 'required|min:6|confirmed',
            ]);

            $user = Auth::user();
            $user->password = $request->nieuw_wachtwoord;
            $user->save();
            return redirect()->back()->with(["success" => "Wachtwoord is succesvol geüpdate!", 'CorrectTab' => 'Wachtwoordveranderen']);
    }

    public function AdminChangePassword(Request $request)
    {
        
        $request->validate([
            'Nieuw_ww' => 'required',
            'user_email' => 'required', 
        ]);

        $user = User::where('email', $request->user_email)->get();
        $user[0]->password = $request->Nieuw_ww;
        $user[0]->save();

        return redirect()->back()->with("success" , "Wachtwoord is succesvol geüpdate!");
    }

    public function Update(Request $request)
    {
        $request->validate([
            'Nieuw_Voornaam' => 'required|max:50',
            'Nieuw_Achternaam' => 'required|max:100',
            'Nieuw_Email' => 'required|email|max:100',
        ]);

        $user = Auth::user();
        $user->Voornaam = $request->Nieuw_Voornaam;
        $user->Achternaam = $request->Nieuw_Achternaam;
        $user->Email = $request->Nieuw_Email;
        $user->save();
        
        return redirect()->back()->with(["success_gegevens" => "Gegevens zijn succesvol aangepast!", 'CorrectTab' => 'UpdateGegevens']);
    }
}
