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

    public function control()
    {
        $users = DB::table('users')->simplePaginate(10);
            
        return view('controlpanel', compact('users'));
    }

    public function show(User $user)
    {

        return view('Users.userdetail', compact('user'));
    }

    public function edit(User $user)
    {

        return view('Users.edituser', compact('user'));
    }

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
        $user->rechten = request('rechten');
        $user->vestiging = request('vestiging');
        $user->email = request('email');

        $user->save();

        return redirect('/controlpanel');

    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect('/controlpanel');

    }

    public function newuser()
    {
        return view('Users.usercreate');
    }

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
        $user = Auth::user();
        return view('profile',compact('user',$user));
    }

    public function update_avatar(Request $request){

        $request->validate([
            'avatar' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $user = Auth::user();

        $avatarName = $user->id.'_avatar'.time().'.'.request()->avatar->getClientOriginalExtension();

        $request->avatar->storeAs('avatars',$avatarName);

        $user->avatar = $avatarName;
        $user->save();

        return back()
            ->with('success','You have successfully upload image.');

    }

}
