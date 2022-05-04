<?php

namespace Fypex\DigisellerClient\Credentials;

use JetBrains\PhpStorm\Pure;

class DigisellerCredentials
{

    private $sellerId;
    private $apiKey;
    private $timestamp;
    private $sign;

    /**
     * DigisellerCredentials constructor.
     * @param int $sellerId
     * @param string $apiKey
     * @param int $timestamp
     */
    public function __construct(int $sellerId, string $apiKey, int $timestamp)
    {
        $this->sellerId = $sellerId;
        $this->apiKey = $apiKey;
        $this->timestamp = $timestamp;
        $this->sign = hash('sha256', $this->apiKey.$this->timestamp);
    }

    /**
     * @return string
     */
    public function getSellerId(): string
    {
        return $this->sellerId;
    }

    /**
     * @return string
     */
    public function getApiKey(): string
    {
        return $this->apiKey;
    }

    /**
     * @return int
     */
    public function getTimestamp(): int
    {
        return $this->timestamp;
    }

    /**
     * @return string
     */
    public function getSign(): string
    {
        return $this->sign;
    }

}
