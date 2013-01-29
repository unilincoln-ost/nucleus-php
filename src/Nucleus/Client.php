<?php

namespace Nucleus;

class Client
{

	private $client;
	
	public function __construct($config)
	{
		 $this->client = NucleusClient::factory($config);
	}
    
    public function __call($method, $params)
    {
	    if (isset($params))
    	{
	    	return $this->client->$method($params[0]);
	    }
	    else
	    {
		    return $this->client->$method;
	    }
    }
}

// EOF