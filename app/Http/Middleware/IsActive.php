<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\staff;
use app\Settings\BadgeSettings;

class IsActive
{
    function isredirect(): string
    {
        return app(BadgeSettings::class)->is_redirect;
    }
    public function qrlink(): string
    {
        return app(BadgeSettings::class)->qr_link;
    }
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        // Retrieve the employee record using the slug passed in the route
        $staff = staff::where('id', $request->slug)->first();
        if (!$this->isredirect()) {
            // Check if the employee record was found
            if ($staff) {
                // If the employee record was found, check if the employee is active
                if ($staff->is_active) {
                    // If the employee is active, allow the request to proceed
                    return $next($request);
                } else {
                    // If the employee is not active, redirect the user to a 404 error page
                    return abort(403, 'This Staff Member Is Not Active.');
                }
            } else {
                // If the employee record was not found, redirect the user to a 404 error page
                return abort(403, 'This Staff Member Was Not Found');
            }
        } elseif ($this->isredirect()) {
            $staff = staff::where('id', $request->slug)->first();
            // Check if the employee record was found
            if ($staff) {
                // If the employee record was found, check if the employee is active
                if ($staff->is_active) {
                    // If the employee is active, allow the request to proceed
                    return redirect($this->qrlink());
                } else {
                    // If the employee is not active, redirect the user to a 404 error page
                    return abort(403, 'This Staff Member Is Not Active.');
                }
            } else {
                // If the employee record was not found, redirect the user to a 404 error page
                return abort(403, 'This Staff Member Was Not Found');
            }
        }
    }
}
