<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class UserShouldVerified
{
    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);
        if (Auth::check() && !Auth::user()->is_verified) {
            $link = url('auth/send-verification') . '?email=' . urlencode(Auth::user()->email);
            Auth::logout();

            Session::flash("flash_notification", [
                "level" => "warning",
                "message" => "Silahkan klik pada link aktivasi yang telah kami kirim. <a class='text-blue-600 hover:text-blue-700 hover:underline' href='$link'>Kirim lagi</a>."
            ]);
            return redirect('/login');
        }
        return $response;
    }
}
