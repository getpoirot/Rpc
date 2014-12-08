<?php
namespace Poirot\Rpc\Client\Json\Connection;

use Poirot\Core\Entity;

class Option extends Entity
{
    protected $properties = [
        'server_uri'         => null,
        'connection_timeout' => 5,
        'user_agent'         => 'JSON-RPC PHP Client',
    ];
}
 