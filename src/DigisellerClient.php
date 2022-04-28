<?php

namespace Fypex\DigisellerClient;

use Fypex\DigisellerClient\Exception\GeneralException;
use Fypex\DigisellerClient\Request\Products;
use Http\Client\HttpClient;
use Http\Client\Curl\Client as CurlClient;
use Http\Message\MessageFactory\DiactorosMessageFactory;
use Psr\Http\Message\ResponseInterface;

class DigisellerClient
{

    protected $client;
    protected $messageFactory;

    public function __construct(?HttpClient $client = null)
    {
        $this->client = $client ?: new CurlClient(null,null,[
            CURLOPT_SSL_VERIFYHOST => false,
            CURLOPT_SSL_VERIFYPEER => false,
        ]);
        $this->messageFactory = new DiactorosMessageFactory();
    }

    public function products(): Products
    {
        return new Products($this->client);
    }

    protected function isJsonResponse(ResponseInterface $response): bool
    {
        $header = $response->getHeader('Content-Type')[0] ?? null;
        [$type,] = explode(';', $header);

        return $type === 'application/json';
    }

    protected function getHeaders($contentType = 'application/json'): array
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
