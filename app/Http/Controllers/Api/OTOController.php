<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\OTOService;
use Illuminate\Http\Request;

class OTOController extends Controller
{
    private $otoService;

    public function __construct(OTOService $otoService)
    {
        $this->otoService = $otoService;
    }

    public function storeOTOAccessToken(Request $request)
    {
        $request->validate([
            'refresh_token' => ['required'],
        ]);

        $response = $this->otoService->getAccessToken($request->refresh_token);

        setting([
            'oto_access_token' => $response->access_token
        ])->save();

        return $this->success("OTO access token stored successfully", $response);
    }

    public function testOTO(Request $request)
    {
        $request->validate([
            'refresh_token' => ['required'],
        ]);

        return $this->otoService->getAccessToken($request->refresh_token);
    }
    public function checkDeliveryFee(Request $request){
        return $this->otoService->checkDeliveryFee($request);

    }
}