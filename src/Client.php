<?php 

namespace Shopee;

use GuzzleHttp\Client as HttpClient;
use GuzzleHttp\Exception\ClientException as GuzzleClientException;
use GuzzleHttp\Exception\ServerException as GuzzleServerException;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Uri;
use GuzzleHttp\Psr7\Utils;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\UriInterface;
use Dotenv\Dotenv;
use InvalidArgumentException;
use Psr\Http\Message\ResponseInterface;
use Shopee\Exception\Api\AuthException;
use Shopee\Exception\Api\BadRequestException;
use Shopee\Exception\Api\ClientException;
use Shopee\Exception\Api\Factory;
use Shopee\Exception\Api\ServerException;

class Client 
{
    const VERSION = '1.0';

    const DEFAULT_BASE_URL       = 'https://partner.shopeemobile.com';
    const TEST_BASE_URL          = 'https://partner.test-stable.shopeemobile.com';

    const DEFAULT_USER_AGENT     = 'shopee-php/' . self::VERSION;

    /** @var ClientInterface */
    protected $httpClient;

    /** @var UriInterface */
    protected $baseUrl;

    /** @var string */
    protected $userAgent;

    /** @var string Shopee Partner Secret key */
    protected $secret;

    /** @var string */
    protected $accessToken;

    /** @var int */
    protected $partnerId;

    /** @var int */
    protected $shopId;

    /** @var NodeAbstract[] */
    protected $nodes = [];

    /** @var SignatureController */
    protected $signatureController;
    

    public function __construct(array $config = [], $test = true)
    {
        $dotenv = Dotenv::createImmutable(__DIR__ . '/..');
        $dotenv->load();

        $config = array_merge([
            'httpClient'    => null,
            'accessToken'   => null,
            'shopid'        => null,
            'baseUrl'       => $test ? self::TEST_BASE_URL : self::DEFAULT_BASE_URL,
            'userAgent'     => self::DEFAULT_USER_AGENT,
            'secret'        => $_ENV['SHOPEE_PARTNER_KEY'],
            'partner_id'    => (int)$_ENV['SHOPEE_PARTNER_ID'],
        ], $config);

        $this->httpClient   = $config['httpClient'] ?: new HttpClient();;
        $this->userAgent    = $config['userAgent'];
        $this->secret       = $config['secret'];
        $this->partnerId    = $config['partner_id'];
        $this->shopId       = $config['shopid'];
        $this->accessToken  = $config['accessToken'] ?: '';

        $this->setBaseUrl($config['baseUrl']);

        $this->signatureController = new SignatureController($this->secret, $this->partnerId);

        $this->nodes['product']     = new Nodes\Product\Product($this);
        $this->nodes['mediaSpace']  = new Nodes\MediaSpace\MediaSpace($this);
        $this->nodes['order']       = new Nodes\Order\Order($this);
    }

    public function __get(string $name)
    {
        if (!array_key_exists($name, $this->nodes)) {
            throw new InvalidArgumentException(sprintf('Property "%s" not exists', $name));
        }

        return $this->nodes[$name];
    }

    public function getUserAgent(): string
    {
        return $this->userAgent;
    }

    /**
     * @param string $userAgent
     * @return $this
     */
    public function setUserAgent(string $userAgent)
    {
        $this->userAgent = $userAgent;

        return $this;
    }

    public function getBaseUrl(): UriInterface
    {
        return $this->baseUrl;
    }

    /**
     * @param string $url
     * @return $this
     */
    public function setBaseUrl(string $url)
    {
        $this->baseUrl = new Uri($url);

        return $this;
    }

    public function getDefaultParameters(): array
    {
        return [
            'partner_id'    => $this->partnerId,
            'shop_id'       => $this->shopId,
            // 'timestamp'     => time(),          // Put the current UNIX timestamp when making a request
        ];
    }


    /**
     * Create HTTP JSON body
     *
     * The HTTP body should contain a serialized JSON string only
     *
     * @param array $data
     * @return string
     */
    protected function createJsonBody(array $data): string
    {
        $data = array_merge($this->getDefaultParameters(), $data);

        return json_encode($data);
    }

    /**
     * Generate an HMAC-SHA256 signature for a HTTP request
     *
     * @param string $path
     * @return string
     */
    protected function signature(string $path): string
    {
        // $url = Uri::composeComponents($uri->getScheme(), $uri->getAuthority(), $uri->getPath(), '', '');

        return $this->signatureController->generateSignature($path, $this->accessToken, $this->shopId);
    }

    /**
     * @param string $path
     * @param array $method
     * @param array $headers
     * @param array $data
     * @return RequestInterface
     */
    public function newRequest($path, $method = 'GET', array $headers = [], $data = [], $contentType = 'json'): RequestInterface
    {
        $params = $this->getDefaultParameters();
        $sign   = $this->signature($path);

        $query  = 'partner_id=' . $params['partner_id'] . "&timestamp=" . time();
        $query  .= '&access_token=' . $this->accessToken . '&shop_id=' . $this->shopId . '&sign=' . $sign;

        if ($method == 'GET'){
            foreach ($data as $key => $value){
                $query .= '&' . $key . '='. $value;
            }
        }

        $uri    = Uri::composeComponents($this->baseUrl->getScheme(), $this->baseUrl->getAuthority(), $path, $query, '');

        $headers['User-Agent']      = $this->userAgent;

        if ($method == 'POST'){
            if ($contentType == 'json'){
                $headers['Content-Type']    = 'application/json';
                $jsonBody = $this->createJsonBody($data);

                return new Request(
                    $method,
                    $uri,
                    $headers,
                    $jsonBody
                );
            }
            else {
                // $headers['multipart'] = $data;
                $body['multipart'] = $data;

                return new Request(
                    $method,
                    $uri,
                    $headers,
                    $body
                );
            }
        }
        else {
            return new Request(
                $method,
                $uri,
                $headers
            );
        }



        // $res = $this->httpClient->request($method, $uri, $headers);
        // return $res;




        // $uri    = Utils::uriFor($uri);
        // $path   = $this->baseUrl->getPath() . $uri->getPath();
        // $uri    = $uri
        //         ->withScheme($this->baseUrl->getScheme())
        //         ->withUserInfo($this->baseUrl->getUserInfo())
        //         ->withHost($this->baseUrl->getHost())
        //         ->withPort($this->baseUrl->getPort())
        //         ->withPath($path);

        // $jsonBody = $this->createJsonBody($data);

        // $headers['Authorization'] = $this->signature($uri, $jsonBody);
        // $headers['User-Agent'] = $this->userAgent;
        // $headers['Content-Type'] = 'application/json';

        // return new Request(
        //     'POST',
        //     $uri,
        //     $headers,
        //     $jsonBody
        // );
    }

    public function formRequest($path, array $headers = [], $data = []): ResponseInterface
    {
        $params = $this->getDefaultParameters();
        $sign   = $this->signature($path);

        $query  = 'partner_id=' . $params['partner_id'] . "&timestamp=" . time();
        $query  .= '&access_token=' . $this->accessToken . '&shop_id=' . $this->shopId . '&sign=' . $sign;

        $uri    = Uri::composeComponents($this->baseUrl->getScheme(), $this->baseUrl->getAuthority(), $path, $query, '');

        // $headers['multipart'] = $data;
        $body['multipart'] = $data;
        
        return $this->httpClient->request('POST', $uri, [
            'multipart' => [
                $data
            ]
        ]);
    }

    public function send(RequestInterface $request): ResponseInterface
    {
        try {
            $response = $this->httpClient->send($request);
        } catch (GuzzleClientException $exception) {
            switch ($exception->getCode()) {
                case 400:
                    $className = BadRequestException::class;
                    break;
                case 403:
                    $className = AuthException::class;
                    break;
                default:
                    $className = ClientException::class;
            }
            $response = $exception->getResponse();
            // throw Factory::create($className, $exception);
        } catch (GuzzleServerException $exception) {
            $response = $exception->getResponse();
            // throw Factory::create(ServerException::class, $exception);
        }

        return $response;
    }

    public function getAuthorizationURL($redirect = '')
    {
        $params = $this->getDefaultParameters();

        $path   = '/api/v2/shop/auth_partner';
        $sign   = $this->signature($path);

        $query  = 'partner_id=' . $params['partner_id'] . "&timestamp=" . time() . '&sign=' . $sign . '&redirect=' . $redirect;
        $url    = Uri::composeComponents($this->baseUrl->getScheme(), $this->baseUrl->getAuthority(), $path, $query, '');
        return $url;
    }

    public function generateAccessToken(string $code, int $shopId = null)
    {
        $params = $this->getDefaultParameters();

        $path   = '/api/v2/auth/token/get';
        $sign   = $this->signature($path);

        $query  = 'partner_id=' . $params['partner_id'] . "&timestamp=" . time() . '&sign=' . $sign;
        $uri    = Uri::composeComponents($this->baseUrl->getScheme(), $this->baseUrl->getAuthority(), $path, $query, '');

        $headers['User-Agent']      = $this->userAgent;
        $headers['Content-Type']    = 'application/json';

        $params['code'] = $code;

        if ($shopId){
            $params['shop_id'] = $shopId;
        }

        $jsonBody = $this->createJsonBody($params);
        $headers['body'] = $jsonBody;

        $res = $this->httpClient->request('POST', $uri, $headers);

        return $res->getBody();
    }

    public function refreshAccessToken($refreshToken){
        $params = $this->getDefaultParameters();

        $path   = '/api/v2/auth/access_token/get';
        $sign   = $this->signature($path);

        $query  = 'partner_id=' . $params['partner_id'] . "&timestamp=" . time() . '&sign=' . $sign;
        $uri    = Uri::composeComponents($this->baseUrl->getScheme(), $this->baseUrl->getAuthority(), $path, $query, '');

        $headers['User-Agent']      = $this->userAgent;
        $headers['Content-Type']    = 'application/json';

        $params['refresh_token'] = $refreshToken;

        $jsonBody = $this->createJsonBody($params);
        $headers['body'] = $jsonBody;
        try {
            $response = $this->httpClient->request('POST', $uri, $headers);
        }
        catch (GuzzleClientException $exception){
            $response = $exception->getResponse();
        }
        
        return $response->getBody();
    }
}

