<?php

namespace App\Http\Controllers;

use App\District;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

class HooksControoler extends ApiController
{
    public function mpesoAgencies(Request $request)
    {
        $lastrunstatus = $request->json('lastrunstatus');

        if ('success' == $lastrunstatus) {
            $response = $this->getHttpClient()->get('https://www.kimonolabs.com/api/dvpm3jde', [
                'query' => [
                    'apikey'    => config('services.kimonolabs.api_key'),
                    'kimmodify' => 1,
                    'kimbypage' => 1,
                ],
            ]);

            $districts = json_decode($response->getBody(), true);

            app('db')->transaction(function () use ($districts) {
                foreach ($districts as $district) {
                    $eloquentDistrict = District::firstOrCreate([
                        'name' => $district['district'],
                        'page' => $district['page'],
                    ]);

                    foreach ($district['neighborhoods'] as $neighborhood) {
                        $eloquentNeighborhood = $eloquentDistrict->neighborhoods()->firstOrCreate(['name' => $neighborhood['name']]);

                        foreach ($neighborhood['agencies'] as $agency) {
                            $eloquentNeighborhood->agencies()->firstOrCreate([
                                'address' => $agency['address'],
                                'name'    => $agency['name'],
                            ]);
                        }
                    }
                }
            });
        }

        return $this->respondNoContent();
    }

    /**
     * Get a fresh instance of the Guzzle HTTP client.
     *
     * @return Client
     */
    protected function getHttpClient()
    {
        return new Client();
    }
}
