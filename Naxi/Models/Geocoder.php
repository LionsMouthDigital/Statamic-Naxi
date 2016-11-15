<?php

namespace Statamic\Addons\Naxi\Models;

use GuzzleHttp\Client;
use Statamic\Extend\Extensible;

class Geocoder
{
    use Extensible;

    /**
     * Geocode an address.
     *
     * @author Curtis Blackwell
     * @param  string $address
     * @param  string $accessToken Mapbox access token.
     * @return array               Geocode API call results.
     */
    public function geocode($address, $accessToken = '')
    {
        // Get data from cache if it exists.
        if ($data = $this->cache->get($address)) {
            return $data;
        }

        // Perform the API request.
        $client   = new Client();
        $response = $client->request('GET', $this->getUrl($address), [
            'query' => [
                'access_token' => $accessToken ?: $this->getAccessToken()
            ],
        ]);

        // Ain't nobody want no JSON.
        $data = json_decode($response->getBody(), true);

        // Cache data.
        $this->cache->put($address, $data);

        return $data;
    }

    /**
     * Get the URL to cURL to.
     *
     * @author Curtis Blackwell
     * @param  string $address
     * @return string
     */
    private function getUrl($address)
    {
        return 'https://api.mapbox.com/geocoding/v5/mapbox.places/' .
            urlencode($address) .
            '.json';
    }

    /**
     * Get the access token from settings.
     *
     * @author Curtis Blackwell
     * @return string
     */
    public function getAccessToken()
    {
        if (!$accessToken = $this->getConfig('access_token')) {
            \Log::error('Set your Mapbox access token in Geocode\'s settings.');
        }

        return $accessToken;
    }
}
