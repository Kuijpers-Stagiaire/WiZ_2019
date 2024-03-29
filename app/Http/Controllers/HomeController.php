<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Hash;
use App\Rules\MatchOldPassword;
use App\User;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

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
            return redirect()->back()->with(["success" => "Password changed successfully!", 'CorrectTab' => 'Wachtwoordveranderen']);
    }

    public function AdminChangePassword(Request $request)
    {
        
        $request->validate([
            'Nieuw_ww' => 'required',
            'user_email' => 'required', 
        ]);

        $user = User::where('email', $request->user_email)->get();
        dump($user);
        $user[0]->password = $request->Nieuw_ww;
        $user[0]->save();

        return redirect()->back()->with("success" , "Wachtwoord is Successvol aangepast!");
    }
}