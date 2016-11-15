<?php

namespace Statamic\Addons\Naxi;

use Statamic\Addons\Naxi\Models\Geocoder;
use Statamic\Extend\Modifier;

class NaxiModifier extends Modifier
{
    /**
     * Returns the coordinates for the best match from geocoding results.
     *
     * @param mixed  $address
     * @param array  $params   Accepts `access_token`.
     * @param array  $context  Contextual values.
     * @return mixed
     */
    public function index($address, $params, $context)
    {
        $response = (new Geocoder())
            ->geocode($address, array_get($params, 'access_token'));

        $bestMatch   = head(array_get($response, 'features', []));
        $coordinates = array_get($bestMatch, 'geometry.coordinates', []);

        return '[' . head($coordinates) . ', ' . last($coordinates) . ']';
    }
}
