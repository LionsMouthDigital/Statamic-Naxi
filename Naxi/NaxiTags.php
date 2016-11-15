<?php

namespace Statamic\Addons\Naxi;

use Statamic\Addons\Naxi\Models\Geocoder;
use Statamic\Extend\Tags;

class NaxiTags extends Tags
{
    public function init()
    {
        $this->geocoder = new Geocoder;
    }

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

        $response = $this->geocoder->geocode($address, $accessToken);

        $this->parse($response, $this->context);
    }

    public function accessToken()
    {
        return $this->geocoder->getAccessToken();
    }
}
