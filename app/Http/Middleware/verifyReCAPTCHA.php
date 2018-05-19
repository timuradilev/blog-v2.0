<?php

namespace App\Http\Middleware;

use Closure;
use ReCaptcha\ReCaptcha;

class verifyReCAPTCHA
{
    /**
     * Handle an incoming request. Verify reCAPTCHA
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $remoteIp = $request->server('REMOTE_ADDR');
        $secret   = env('SETTINGS_GOOGLE_RECAPTCHA_SECRET_KEY');

        $recaptcha = new ReCaptcha($secret);
        $status = $recaptcha->verify($request->input('g-recaptcha-response'), $remoteIp);
        if ($status->isSuccess()) {
            return $next($request);
        } else {
            return back()->withInput()->withErrors(['recaptcha' => __('messages.recaptcha')]);
        }
    }
}
