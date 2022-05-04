<?php

namespace Fypex\DigisellerClient\Models;

class ErrorModel extends Model
{

    protected $code;
    protected $message;
    protected $reason;

    public function __construct($error)
    {

        $this->code = $error['code'];
        $this->message = $error['message'];
        $this->reason = $error['reason'] ?? '';

    }

    public function getCode()
    {
        return $this->code;
    }

    public function getMessage()
    {
        return $this->message;
    }

    public function getReason()
    {
        return $this->reason;
    }

}
