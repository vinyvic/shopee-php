<?php 
namespace Shopee\Nodes;

// use Psr\Http\Message\UriInterface;
use Shopee\Client;
use Shopee\RequestParameters;
use Shopee\RequestParametersInterface;
use Shopee\ResponseData;

abstract class Node
{
    /** @var Client */
    protected $client;
    protected $path;

    public function __construct(Client $client, string $path)
    {
        $this->client   = $client;
        $this->path     = $path;
    }

    /**
     * @param string|UriInterface $uri
     * @param array|RequestParameters $parameters
     * @return ResponseData
     */
    public function post($uri, $parameters)
    {
        if ($parameters instanceof RequestParametersInterface) {
            $parameters = $parameters->toArray();
        }

        $request = $this->client->newRequest($this->path . $uri, 'POST', [], $parameters);
        $response = $this->client->send($request);

        return new ResponseData($response);
    }

    
    /**
     * @param string|UriInterface $uri
     * @param array|RequestParameters $parameters
     * @return ResponseData
     */
    public function get($uri, $parameters)
    {
        if ($parameters instanceof RequestParametersInterface) {
            $parameters = $parameters->toArray();
        }

        $request = $this->client->newRequest($this->path . $uri, 'GET', [], $parameters);
        $response = $this->client->send($request);

        return new ResponseData($response);
    }
}