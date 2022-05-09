<?php


namespace Fypex\DigisellerClient\Models;


class RemoveContentResponseModel extends Model
{

    protected $retval;
    protected $retdesc;
    protected $errors;
    protected $deleted_count;


    public function __construct(array $data)
    {

        $this->retval = $data["retval"];
        $this->retdesc = $data["retdesc"];
        $this->errors = $data["errors"];
        $this->deleted_count = $data["content"]["deleted_count"];

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
     * @return mixed
     */
    public function getDeletedCount()
    {
        return $this->deleted_count;
    }

}
