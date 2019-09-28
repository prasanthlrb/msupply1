<?php

namespace App\Http\Middleware;

use Closure;
use App\company;
use Auth;
class UserType

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
        if(Auth::user()->user_type == "company"){
            $company = company::where('user_id',Auth::user()->id)->get();
            if(count($company) > 0){
                if($company[0]->status == 0){
                    return redirect()->intended('account/company-verify');
                }
            }else{
                return redirect()->intended('account/company');
            }
        }
        return $next($request);
    }
}
