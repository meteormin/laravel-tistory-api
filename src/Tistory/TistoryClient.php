<?php


namespace Miniyus\TistoryApi\Tistory;

use Miniyus\RestfulApiClient\Api\Contracts\EndPoint;
use Miniyus\TistoryApi\Tistory\EndPoint\Apis\Apis;
use Miniyus\TistoryApi\Tistory\EndPoint\Oauth\Oauth;
use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Miniyus\RestfulApiClient\Api\ApiClient;


/**
 * Class TistoryClient
 * @package Miniyus\TistoryApi\Tistory
 */
class TistoryClient extends ApiClient
{
    protected string $configName = 'tistory';

    /**
     * TistoryClient constructor.
     * @param string|null $host
     * @param string|null $type
     * @param string $server
     */
    public function __construct(string $host = null, ?string $type = 'storage', string $server = 'default')
    {
        parent::__construct($host, $type, $server);
    }

    /**
     * @return Oauth|EndPoint
     */
    public function oauth(): Oauth
    {
        return $this->makeEndPoint('oauth');
    }

    /**
     * @return Apis|EndPoint
     */
    public function apis(): Apis
    {
        return $this->makeEndPoint('apis');
    }

    /**
     * @return static
     * @throws FileNotFoundException
     */
    public function login(): TistoryClient
    {
        $token = $this->oauth()->auth();
        return $this->setToken($token['access_token'], $this->type);
    }

}
