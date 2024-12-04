<?php

namespace App\Services;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Http;

class OTOService
{
    protected $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function getAccessToken($refresh_token)
    {
        $body = ["refresh_token" => $refresh_token];

        try
        {
            $response = Http::post('https://api.tryoto.com/rest/v2/refreshToken', $body);
        } catch (\Throwable $th)
        {
            return response()->json([
                'message' => __('Server error')
            ]);
        }

        return json_decode($response->getBody());
    }

    public function createOrder($body, $orderDetails)
    {
        try
        {
            $body["refresh_token"] =
                $response = Http::withHeaders([
                    'Content-Type' => 'application/json',
                    'Authorization' => 'Bearer ' . setting('oto_access_token')
                ])->post('https://api.tryoto.com/rest/v2/createPickupLocation', $body);

            $response = json_decode($response->getBody());

            if (property_exists($response, 'code') || (property_exists($response, 'message') && !$response->message))
            {
                if (property_exists($response, 'code') && $response->code == 401)
                {
                    $tokensResponse = $this->getAccessToken(env('OTO_REFRESH_TOKEN'));
                    if (property_exists($tokensResponse, 'access_token'))
                    {
                        setting(['oto_access_token' => $tokensResponse->access_token])->save();
                    } else
                    {
                        return $tokensResponse;
                    }
                }
            }

            $response = Http::withHeaders([
                'Content-Type' => 'application/json',
                'Authorization' => 'Bearer ' . setting('oto_access_token')
            ])->post('https://api.tryoto.com/rest/v2/createOrder', $orderDetails);

            return json_decode($response->getBody());
        } catch (\Throwable $th)
        {
            return response()->json([
                'message' => __('Server error')
            ]);
        }
    }

    public function checkDeliveryFee($body)
    {
        try
        {
            // Attempt to make the initial API request to check the delivery fee
            $response = Http::withHeaders([
                'Content-Type' => 'application/json',
                'Authorization' => 'Bearer ' . setting('oto_access_token')
            ])->post('https://api.tryoto.com/rest/v2/checkOTODeliveryFee', $body);
            $response = json_decode($response->getBody());
            // Check if the response indicates an issue with the token
            if (property_exists($response, 'code') || (property_exists($response, 'message') && !$response->message))
            {
                if (property_exists($response, 'code') && $response->code == 401)
                {
                    // Attempt to refresh the access token
                    $tokensResponse = $this->getAccessToken(env('OTO_REFRESH_TOKEN', 'AMf-vBxelL9IqCObQG0W-v2d2ABg5miV35Tn9WXcnGRhd25kHPsFjNcuvZOdv2OWGx2sE1g7KTgmnrLocPpZraUJTy7viFiD46yuujMdsduesIm-ijSr4cIogcyXoZYEPTD3ilCPtCHjUYeKdQ5O-CyhngjZA_Je6i7TIRuqWgkJ912ggrmXMafhrDKYYO6ykxjs3EDJYg3P0e4gBhoJQRFhxtF9SWrxQg'));
                    if (property_exists($tokensResponse, 'access_token'))
                    {
                        setting(['oto_access_token' => $tokensResponse->access_token])->save();
                    } else
                    {
                        return $tokensResponse;
                    }
                }
            }

            // Retry the request with the new token if necessary
            $response = Http::withHeaders([
                'Content-Type' => 'application/json',
                'Authorization' => 'Bearer ' . setting('oto_access_token')
            ])->post('https://api.tryoto.com/rest/v2/checkOTODeliveryFee', $body);
            return json_decode($response->getBody());
        } catch (\Throwable $th)
        {
            return response()->json([
                'message' => __('Server error')
            ]);
        }
    }

    public function availableCities($body)
    {
        try
        {
            // Attempt to make the initial API request to check the delivery fee
            $response = Http::withHeaders([
                'Content-Type' => 'application/json',
                'Authorization' => 'Bearer ' . setting('oto_access_token')
            ])->post('https://api.tryoto.com/rest/v2/availableCities', $body);
            $response = json_decode($response->getBody());
            // Check if the response indicates an issue with the token
            if (property_exists($response, 'code') || (property_exists($response, 'message') && !$response->message))
            {
                if (property_exists($response, 'code') && $response->code == 401)
                {
                    // Attempt to refresh the access token
                    $tokensResponse = $this->getAccessToken(env('OTO_REFRESH_TOKEN', 'AMf-vBxelL9IqCObQG0W-v2d2ABg5miV35Tn9WXcnGRhd25kHPsFjNcuvZOdv2OWGx2sE1g7KTgmnrLocPpZraUJTy7viFiD46yuujMdsduesIm-ijSr4cIogcyXoZYEPTD3ilCPtCHjUYeKdQ5O-CyhngjZA_Je6i7TIRuqWgkJ912ggrmXMafhrDKYYO6ykxjs3EDJYg3P0e4gBhoJQRFhxtF9SWrxQg'));
                    if (property_exists($tokensResponse, 'access_token'))
                    {
                        setting(['oto_access_token' => $tokensResponse->access_token])->save();
                    } else
                    {
                        return $tokensResponse;
                    }
                }
            }

            // Retry the request with the new token if necessary
            $response = Http::withHeaders([
                'Content-Type' => 'application/json',
                'Authorization' => 'Bearer ' . setting('oto_access_token')
            ])->post('https://api.tryoto.com/rest/v2/availableCities', $body);
            return json_decode($response->getBody());
        } catch (\Throwable $th)
        {
            return response()->json([
                'message' => __('Server error')
            ]);
        }
    }
}
