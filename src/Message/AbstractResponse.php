<?php

namespace Omnipay\TalusPay\Message;

use Omnipay\Common\Message\RequestInterface;

abstract class AbstractResponse extends \Omnipay\Common\Message\AbstractResponse
{
    const TRANSACTION_KEY = '';

    public function __construct(RequestInterface $request, $data)
    {
        parent::__construct($request, json_decode($data, true));
    }

    public function getTransactionReference()
    {
        return isset($this->data[static::TRANSACTION_KEY]) ? $this->data[static::TRANSACTION_KEY] : null;
    }

    public function getMessage()
    {
        if ($this->isSuccessful()) {
            return isset($this->data['success']) ? $this->data['status_message'] : null;
        } else {
            $key = array_key_first($this->data['errors']);
            $errorParts = [ $key, $this->data['errors'][$key] ];
            return (count($errorParts) == 2) ? $errorParts[1] : null;
        }
    }

    public function getCode()
    {
        if ($this->isSuccessful()) {
            return isset($this->data['response_code']) ? $this->data['response_code'] : null;
        } else {
            $key = array_key_first($this->data['errors']);
            $errorParts = [ $key, $this->data['errors'][$key] ];
            return (count($errorParts) == 2) ? $errorParts[0] : null;
        }
    }
}
