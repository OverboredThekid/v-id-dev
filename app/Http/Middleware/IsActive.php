<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\staff;
use App\Settings\BadgeSettings;

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

    public function handle(Request $request, Closure $next)
    {
        // Retrieve the employee record using the slug passed in the route
        $staff = staff::where('id', $request->slug)->first();

        // Check if the employee record was found
        if ($staff) {
            if ($staff->is_active && $this->isredirect() ) {
                // If the employee is active and redirect is true, allow the request to proceed
                return $next($request);
            } else {
                if (!$staff->is_active) {
                    return abort(403, 'This Staff Member Is Not Active.');
                }
                if (!$this->isredirect()) {
                    return abort(403, 'The redirect is not allowed.');
                }
            }
        } else {
            // If the employee record was not found, redirect the user to a 404 error page
            return abort(404, 'This Staff Member Was Not Found');
        }
    }
}
