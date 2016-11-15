<?php

namespace Statamic\Addons\Naxi;

use Statamic\Addons\Naxi\Models\Geocoder;
use Statamic\Extend\Tags;

class NaxiTags extends Tags
{
    /**
     * Get the full results from the geocode API call.
     *
     * @author Curtis Blackwell
     * @return string
     */
    public function geocode()
    {
        $address     = $this->getParam('address');
        $accessToken = $this->getParam('access_token');

        $response = (new Geocoder())->geocode($address, $accessToken);

        $this->parse($response, $this->context);
    }
}
