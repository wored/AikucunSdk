<?php

namespace Wored\AikucunSdk;


use Hanson\Foundation\Foundation;

/***
 * Class AikucunSdk
 * @package \Wored\AikucunSdk
 *
 * @property \Wored\AikucunSdk\Api $api
 */
class AikucunSdk extends Foundation
{
    protected $providers = [
        ServiceProvider::class
    ];

    public function __construct($config)
    {
        $config['debug'] = $config['debug'] ?? false;
        parent::__construct($config);
    }

    public function request(string $interfaceName, array $params = [])
    {
        return $this->api->request($interfaceName, $params);
    }
}