<?php


namespace Miniyus\TistoryApi\Tistory\EndPoint\Oauth;

use Miniyus\RestfulApiClient\Api\EndPoint\AbstractSubClient;
use Miniyus\TistoryApi\Tistory\EndPoint\Oauth\Resource\AccessToken;
use Miniyus\TistoryApi\Tistory\EndPoint\Oauth\Resource\Authorize;
use Exception;
use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Illuminate\Support\Facades\Log;
use Miniyus\RestfulApiClient\Api\EndPoint\AbstractEndPoint;

/**
 * Class Oauth
 * @package Miniyus\TistoryApi\Tistory\EndPoint\Oauth
 */
class Oauth extends AbstractEndPoint
{
    public function endPoint(): string
    {
        return 'oauth';
    }

    /**
     * @return Authorize|AbstractSubClient
     */
    public function authorize(): Authorize
    {
        return $this->makeClient('authorize');
    }

    /**
     * @return AccessToken|AbstractSubClient
     */
    public function accessToken(): AccessToken
    {
        return $this->makeClient('access_token');
    }

    /**
     * @return array|null
     * @throws FileNotFoundException
     * @throws Exception
     */
    public function auth(): ?array
    {
        $loginModule = $this->authorize();

        $res = $loginModule->request(
            $this->config('client_id'),
            $this->config('redirect_uri'),
            $this->config('response_type'),
            $this->config('state')
        );

        if (isset($res['code'])) {
            Log::info($res['code']);
            $token = $this->accessToken()->request(
                $this->config('client_id'),
                $this->config('client_secret'),
                $this->config('redirect_uri'),
                $res['code']
            );
        } else {
            Log::warning('fail issue token');
            return null;
        }

        [$name, $token] = explode('=', $token);
        Log::info($name . ': ' . $token);
        return [$name => $token];
    }
}
