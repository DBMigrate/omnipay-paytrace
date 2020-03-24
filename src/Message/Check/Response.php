<?php

namespace Omnipay\Paytrace\Message\Check;

use Omnipay\Paytrace\Message\AbstractResponse;

class Response extends AbstractResponse
{
    const TRANSACTION_KEY = 'check_transaction_id';

    public function isSuccessful()
    {
        return isset($this->data[static::TRANSACTION_KEY]) && !empty($this->data[static::TRANSACTION_KEY])
        && !isset($this->data['success']) && $this->data['success']
        && (!isset($this->data['errors']) || empty($this->data['errors']));
    }
}
