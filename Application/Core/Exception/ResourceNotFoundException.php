<?php
namespace Core\Exception;

class ResourceNotFoundException extends \Exception
{
    public function setMessage($message)
    {
        $this->message = "Resource not found.";
    }

    public function setCode($code)
    {
        $this->code = 500;
    }
}