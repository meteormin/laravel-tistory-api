<?php


namespace Miniyus\TistoryApi\Tistory\EndPoint\Apis;

use Miniyus\RestfulApiClient\Api\EndPoint\AbstractSubClient;
use Miniyus\TistoryApi\Tistory\EndPoint\Apis\Resource\Post;
use Miniyus\RestfulApiClient\Api\EndPoint\AbstractEndPoint;

/**
 * Class Apis
 * @package Miniyus\TistoryApi\Tistory\EndPoint\Apis
 * @author Yoo Seongmin <miniyu97@iokcom.com>
 */
class Apis extends AbstractEndPoint
{
    /**
     * @inheritDoc
     */
    public function endPoint(): string
    {
        return 'apis';
    }

    /**
     * @return Post|AbstractSubClient
     */
    public function postApi(): Post
    {
        return $this->makeClient('post');
    }
}
