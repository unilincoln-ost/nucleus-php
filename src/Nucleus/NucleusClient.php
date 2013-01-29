<?php

namespace Nucleus;

use Guzzle\Common\Collection;
use Guzzle\Service\Builder\ServiceBuilder;
use Guzzle\Service\Description\ServiceDescription;

class NucleusClient extends \Guzzle\Service\Client
{

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
        
        $client->enableMagicMethods(TRUE);

        return $client;
        
    }

}

// EOF