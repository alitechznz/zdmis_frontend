<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SetGlobalScopeForUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (auth()->check()) {
            $user = auth()->user();

            // Handling ministryUser
            $ministry_id = optional($user->ministryUser)->ministry_id;
            if ($ministry_id) {
                $request->attributes->set('ministry_id', $ministry_id);
            }

            // Handling departmentUser
            $department_id = optional($user->departmentUser)->department_id;
            if ($department_id) {
                $request->attributes->set('department_id', $department_id);
            }

            // Handling institutionUser
            $institution_id = optional($user->institutionUser)->institution_id;
            if ($institution_id) {
                $request->attributes->set('institution_id', $institution_id);
            }

            // Handling institutionUser
            $municipal_id = optional($user->municipalUser)->municipal_id;
            if ($municipal_id) {
                $request->attributes->set('municipal_id', $municipal_id);
            }

            // Handling institutionUser
            $rd_committee_id = optional($user->rdcUser)->region_id;
            if ($rd_committee_id ) {
                $request->attributes->set('region_id', $rd_committee_id);
            }
        }

        return $next($request);
    }
}
