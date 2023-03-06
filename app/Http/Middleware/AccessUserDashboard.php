<?php
namespace App\Http\Middleware;
use App\Helpers\User;
use Closure;
class AccessUserDashboard
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
        if($request->session()->has('userInfo')) {
            $user = User::getInfo();
            if(!$user) {
                $request->session()->forget('userInfo');
            }
            else {
                return $next($request);
            }
            
        }
        return redirect()->route('auth/login'); 
    }
}
