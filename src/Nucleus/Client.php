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
    
	    if (isset($params[0]))
    	{
	    	$command = $this->client->getCommand($method, $params[0]);
	    }
	    else
	    {
		    $command = $this->client->getCommand($method);
	    }
	    
	    return $this->client->execute($command);
    }
}

// EOF