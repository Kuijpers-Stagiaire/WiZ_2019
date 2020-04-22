<?php


namespace App\Http\Middleware;

use Illuminate\Support\Facades\Auth;
use App\User;

use Closure;

class CheckRechten
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        //toevoeging Van middleware die controleert of die persoon toegang heeft tot die pagina's
        $users = ["controlpanel", "edit", "destroy", "overzicht/product_Scannen", "overzicht/nieuw"];
        $managers = ["controlpanel/users"];
        if(isset($request->user()->rechten))
        {
            if($request->user()->rechten == "User")
            {
                foreach($users as $user)
                {
                    if(strpos($request->path(), $user) !== false)
                    {
                        return redirect("401");
                    }
                }
            }
            else if($request->user()->rechten == "Product-Manager")
            {
                foreach($managers as $manager)
                {
                    if(strpos($request->path(), $manager) !== false)
                    {
                        return redirect("401");
                    }
                }
            }
        }

        return $next($request);
    }
}
