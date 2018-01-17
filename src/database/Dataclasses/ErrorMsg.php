<?php

class ErrorMsg
{

    protected $id;
    protected $error_msg;

    public function __construct($id, $error_msg)
    {
        $this->id = $id;
        $this->error_msg = $error_msg;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @param mixed $error_msg
     */
    public function setErrorMsg($error_msg)
    {
        $this->error_msg = $error_msg;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getErrorMsg()
    {
        return $this->error_msg;
    }
}