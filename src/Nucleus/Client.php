<?php

namespace Nucleus;

use Guzzle\Common\Collection;
use Guzzle\Service\Description\ServiceDescription;

class Client extends \Guzzle\Service\Client
{
    /**
     * Factory method to create a new MyServiceClient
     *
     * The following array keys and values are available options:
     * - base_url: Base URL of web service
     * - scheme:   URI scheme: http or https
     * - username: API username
     * - password: API password
     *
     * @param array|Collection $config Configuration data
     *
     * @return self
     */
    public static function factory($config = array())
    {
        $default = array(
            'base_url' => 'https://n2.online.lincoln.ac.uk'
        );
        $required = array('base_url', 'access_token');
        $config = Collection::fromConfig($config, $default, $required);

        $client = new self($config->get('base_url'), $config);
        
        $description = ServiceDescription::factory(__DIR__ . '/service.json');
        
        $client->setDescription($description);
        $client->setDefaultHeaders(array(
        	'Authorization' => 'Bearer ' . base64_encode($config['access_token'])
        ));

        return $client;
    }
}

// EOF