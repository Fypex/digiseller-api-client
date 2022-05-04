<?php

namespace Fypex\DigisellerClient;

use Fypex\DigisellerClient\Credentials\DigisellerCredentials;
use Fypex\DigisellerClient\Denormalizer\AuthorizationDenormalizer;
use Fypex\DigisellerClient\Denormalizer\Products\Products as ProductsDenormalizer;
use Fypex\DigisellerClient\Exception\GeneralException;
use Fypex\DigisellerClient\Request\Products;
use Http\Client\HttpClient;
use Http\Client\Curl\Client as CurlClient;
use Http\Message\MessageFactory\DiactorosMessageFactory;
use Psr\Http\Message\ResponseInterface;
use Symfony\Component\Cache\Adapter\FilesystemAdapter;
use Symfony\Contracts\Cache\ItemInterface;

class DigisellerClient
{

    protected $client;
    protected $messageFactory;
    protected $credentials;
    protected $token;


    public function __construct(DigisellerCredentials $credentials, ?HttpClient $client = null)
    {
        $this->client = $client ?: new CurlClient(null,null,[
            CURLOPT_SSL_VERIFYHOST => false,
            CURLOPT_SSL_VERIFYPEER => false,
        ]);
        $this->messageFactory = new DiactorosMessageFactory();
        $this->credentials = $credentials;

        $this->token = $this->getAuthorizationToken();

    }

    protected function getAuthorizationToken(): string
    {

        $cache = new FilesystemAdapter();

        return $cache->get('token', function (ItemInterface $item) {
            $item->expiresAfter(60);

            $computedValue = $this->Authorization()->getToken();

            return $computedValue;
        });

    }

    public function products(): Products
    {
        return new Products($this->credentials, $this->client);
    }


    protected function Authorization(): Models\Authorization
    {

        $params = [
            "seller_id" =>$this->credentials->getSellerId(),
            "timestamp" => $this->credentials->getTimestamp(),
            "sign" => $this->credentials->getSign()
        ];

        $request = $this->messageFactory->createRequest(
            'POST',
            Digiseller::DEFAULT_URL.'apilogin',
            $this->getHeaders(),
            json_encode($params)
        );


        $response = $this->client->sendRequest($request);
        $data = $this->handleResponse($response);


        return (new AuthorizationDenormalizer())->denormalize($data);

    }

    /**
     * @return string
     */
    protected function getSign(): string
    {
        return $this->credentials->getSign();
    }

    protected function isJsonResponse(ResponseInterface $response): bool
    {
        $header = $response->getHeader('Content-Type')[0] ?? null;
        [$type,] = explode(';', $header);

        return $type === 'application/json';
    }

    protected function getHeaders($contentType = 'application/json', $authorized = true): array
    {
        $headers = [
            'Content-Type' => $contentType,
            'Accept' => '*/*',
        ];

        return $headers;
    }

    protected function handleResponse(ResponseInterface $response)
    {

        if (!$this->isJsonResponse($response)) {
            throw new GeneralException('Response is not "application/json" type');
        }
        $data = json_decode((string)$response->getBody(), true);

        if ($response->getStatusCode() !== 200) {
            throw new GeneralException($data['message'], $response->getStatusCode());
        }

        return $data;
    }

}
