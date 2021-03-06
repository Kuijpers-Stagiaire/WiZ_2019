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
        $users = ["controlpanel", "edit", "destroy", "producten/product_Scannen", "producten/nieuw"];
        $managers = ["controlpanel/users"];
        if(isset($request->user()->rechten))
        {
            //Wanneer de "User" probeert de pagina's te bezoeken die niet voor hem zijn: 401-pagina
            if($request->user()->rechten == "User")
            {
                foreach($users as $user)
                {
                    if(strpos($request->path(), $user) !== false)
                    {
                        return redirect("404");
                    }
                }
            }
            else if($request->user()->rechten == "Product-Manager")
            {
                //Wanneer de "Product-manager" probeert de pagina's te bezoeken van de admin: 401-pagina
                foreach($managers as $manager)
                {
                    if(strpos($request->path(), $manager) !== false)
                    {
                        return redirect("404");
                    }
                }
            }
        }

        return $next($request);
    }
}
