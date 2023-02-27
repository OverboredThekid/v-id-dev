<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\staff;
use app\Settings\BadgeSettings;

class IsActive
{
    private function getStaff(Request $request): ?staff
    {
        return staff::where('id', $request->id)->first();
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
     return redirect("Https://generationsav.com/stafflinks");
    }
}
