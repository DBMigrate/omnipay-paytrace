<?php

namespace Omnipay\Paytrace\Message\CreditCard;

class AuthorizeResponse extends AbstractResponse
{
    /**
     * Is the response successful?
     *
     * @return boolean
     */
    public function isSuccessful()
    {

        return isset($this->data['approval_code']) && !empty($this->data['approval_code'])
            && isset($this->data['success']) && $this->data['success']
        && (!isset($this->data['ERROR']) || empty($this->data['ERROR']));
    }
}
