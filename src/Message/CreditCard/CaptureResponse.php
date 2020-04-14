<?php

namespace Omnipay\TalusPay\Message\CreditCard;

class CaptureResponse extends AbstractResponse
{
    /**
     * @inheritdoc
     */
    public function isSuccessful()
    {
        return isset($this->data['success']) && ($this->data['success'])
             && (!isset($this->data['ERROR']) || empty($this->data['ERROR']));
    }
}
