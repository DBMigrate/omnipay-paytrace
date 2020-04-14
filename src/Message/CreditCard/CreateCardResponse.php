<?php

namespace Omnipay\TalusPay\Message\CreditCard;

class CreateCardResponse extends AuthorizeResponse
{
    /**
     * Is the response successful?
     *
     * @return boolean
     */
    public function isSuccessful()
    {
        return isset($this->data['customer_id']) && !empty($this->data['customer_id'])
        && isset($this->data['success']) && $this->data['success']
        && (!isset($this->data['ERROR']) || empty($this->data['ERROR']));
    }

    public function getCardReference()
    {
        return isset($this->data['customer_id']) ? $this->data['customer_id'] : null;
    }
}
