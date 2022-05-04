<?php


namespace Fypex\DigisellerClient\Models;


use Fypex\DigisellerClient\ToArrayAccess;
use Fypex\DigisellerClient\Traits\toArrayTrait;

class Authorization implements ToArrayAccess
{

    use toArrayTrait;

    protected $retval;
    protected $desc;
    protected $token;
    protected $seller_id;
    protected $valid_thru;

    public function __construct(array $data)
    {

        $this->retval = $data['retval'];
        $this->desc = $data['desc'];
        $this->token = $data['token'];
        $this->seller_id = $data['seller_id'];
        $this->valid_thru = $data['valid_thru'];

    }

    /**
     * @return int
     */
    public function getRetVal(): int
    {
        return $this->retval;
    }

    /**
     * @return string
     */
    public function getDesc(): string
    {
        return $this->desc;
    }

    /**
     * @return string
     */
    public function getToken(): string
    {
        return $this->token;
    }

    /**
     * @return int
     */
    public function getSellerId(): int
    {
        return $this->seller_id;
    }

    /**
     * @return string
     */
    public function getValidThru(): string
    {
        return $this->valid_thru;
    }

}
