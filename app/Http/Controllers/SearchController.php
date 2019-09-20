<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use App\Product;
use Illuminate\Support\Facades\Input;

use DB;

class SearchController extends Controller
{
    public function searchindex()
    {
        $users = User::all();

        return view('search.search', compact('users'));
    }

    // public function search(Request $request)
    // {
    //     if($request->ajax())
    //     {
    //         $output="";
    //         $users=DB::table('users')->where('email', 'like','%' .$request->search. "%")->get();
    //         if($users)
    //         {
    //             foreach ($users as $key => $user) 
    //             {
    //                 $output.=
    //                 '<a href="/controlpanel/users/'.$user->id.'">'.
    //                 '<div class="row users usersdata">'.
    //                 '<div class="img-col"><img src="https://www.w3schools.com/howto/img_avatar.png" class="profile-img-small"></div>'.
    //                 '<div class="col-4">'.$user->email.'</div>'.
    //                 '<div class="col">'.$user->rechten.'</div>'.
    //                 '<div class="col">'.$user->vestiging.'</div>'.
    //                 '<div class="col">'.$user->id.'</div>'.
    //                 '</div>'.
    //                 '</a>';
    //             }
    //         return Response($output);
    //         }
    //     }
    // }


}
