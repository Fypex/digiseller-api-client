<?php


namespace Fypex\DigisellerClient\Models;


class UploadKeyResponseModel extends Model
{

    protected $content_id;
    protected $serial;

    public function __construct(array $data)
    {
        $this->content_id = $data['content_id'];
        $this->serial = $data['serial'];
    }

    /**
     * @return mixed
     */
    public function getContentId()
    {
        return $this->content_id;
    }

    /**
     * @return mixed
     */
    public function getSerial()
    {
        return $this->serial;
    }

}
