<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use Illuminate\Support\Facades\DB;


use Image;

class UsersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    // Hier worden alle gebruikers getoond in het controle paneel 
    public function control()
    {
        $users = DB::table('users')->simplePaginate(10);
            
        return view('controlpanel', compact('users'));
    }

    // Met deze functie wordt de gebruikersinformatie getoond  
    public function show(User $user)
    {

        return view('Users.userdetail', compact('user'));
    }

    //Met deze functie kun je pagina bezoeken waar je de gegevens kunt aanpassen van de gebruiker 
    public function edit(User $user)
    {

        return view('Users.edituser', compact('user'));
    }

    //Met deze functie kun je de gegevens van de gebruiker aanpassen 
    public function update(User $user)
    {

        $this->validate(request(), [
            'voornaam' => 'required', 'string', 'max:255',
            'achternaam' => 'required', 'string', 'max:255',
            'rechten' => 'required', 'string', 'max:255',
            'vestiging' => 'required', 'string', 'max:255',
            'email' => 'required', 'string', 'email', 'max:255', 'unique:users',
        ]);

        $user->voornaam = request('voornaam');
        $user->achternaam = request('achternaam');
        //In de "rechten" staan de rollen beschreven(Admin, productmanager en user)
        $user->rechten = request('rechten');
        $user->vestiging = request('vestiging');
        $user->email = request('email');

        $user->save();

        return redirect('/controlpanel');

    }

    //Om een gebruiker te verwijderen
    public function destroy(User $user)
    {
        $user->delete();
        return redirect('/controlpanel');

    }

    //Om de pagina te bezoeken waar je een gebruiker kunt toevoegen
    public function newuser()
    {
        return view('Users.usercreate');
    }

    //Deze functie zorgt ervoor dat de nieuwe gebruiker opgeslagen wordt in de DB
    public function store()
    {
        $this->validate(request(), [
            'voornaam' => ['required', 'string', 'max:255'],
            'achternaam' => ['required', 'string', 'max:255'],
            'rechten' => ['required', 'string', 'max:255'],
            'vestiging' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ]);
        
        $user = User::create(request(['voornaam', 'achternaam', 'password', 'rechten', 'vestiging', 'email']));

        
        // $user->voornaam = $request->voornaam;
        // $user->achternaam = $request->achternaam;
        // $user->rechten = $request->rechten;
        // $user->vestiging = $request->vestiging;
        // $user->email = $request->email;
        // $user->password = bcrypt( $request->password );
        // $user->remember_token = $request->_token;
        // $user->save();

        return redirect('/controlpanel');

    }

    public function profilepic()
    {
        $token = null;
        $user = Auth::user();
        return view('profile')->with(['token' => $token, 'user' => $user]);
    }

    //Deze functie zorgt ervoor dat je de profielfoto kunt aanpassen van een gebruiker
    public function update_avatar(Request $request){

        $request->validate([
            'avatar' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $user = Auth::user();

        $avatarName = $user->id.'_avatar'.time().'.'.request()->avatar->getClientOriginalExtension();

        // $request->avatar->storeAs('avatars',$avatarName);
        $destinationPath = public_path('/storage/avatars');
        $request->avatar->move($destinationPath, $avatarName);

        $user->avatar = $avatarName;
        $user->save();

        return back()
            ->with('success','You have successfully upload image.');

    }

}
