<?php


namespace Fypex\DigisellerClient\Models;


class UploadKeysResponseModel extends Model
{

    protected $retval;
    protected $retdesc;
    protected $errors;
    /**
     * @var array
     */
    protected $content = [];

    public function __construct(array $data)
    {
        $this->retval = $data['retval'];
        $this->retdesc = $data['retdesc'];
        $this->errors = $data['errors'];
        foreach ($data['content'] as $key){
            array_push($this->content, new UploadKeyResponseModel($key));
        }
    }

    /**
     * @return mixed
     */
    public function getRetval()
    {
        return $this->retval;
    }

    /**
     * @return mixed
     */
    public function getRetdesc()
    {
        return $this->retdesc;
    }

    /**
     * @return mixed
     */
    public function getErrors()
    {
        return $this->errors;
    }

    /**
     * @return array
     */
    public function getContent(): array
    {
        return $this->content;
    }

}
