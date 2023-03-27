<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Auth;

class MarkAsRead
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if($request->query('notification_id')){
           $user = Auth::user();
            if ($user) {
               $noti =  $user->unreadNotifications()->findOrFail('notification_id');
                if($noti){
                    $noti->markAsRead();
                }
            }
        }
        return $next($request);
    }
}
