<?php

namespace App\Http\Middleware;

use Closure;
use App\Services\OTOService;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class OtoAccessToken
{
    private $otoService;
    public function __construct(OTOService $otoService)
    {
        $this->otoService = $otoService;
    }
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!setting('oto_access_token'))
        {
            $response = $this->otoService->getAccessToken(env('OTO_REFRESH_TOKEN', 'AMf-vBxelL9IqCObQG0W-v2d2ABg5miV35Tn9WXcnGRhd25kHPsFjNcuvZOdv2OWGx2sE1g7KTgmnrLocPpZraUJTy7viFiD46yuujMdsduesIm-ijSr4cIogcyXoZYEPTD3ilCPtCHjUYeKdQ5O-CyhngjZA_Je6i7TIRuqWgkJ912ggrmXMafhrDKYYO6ykxjs3EDJYg3P0e4gBhoJQRFhxtF9SWrxQg'));

            setting([
                'oto_access_token' => $response->access_token
            ])->save();
        }
        return $next($request);
    }
}
