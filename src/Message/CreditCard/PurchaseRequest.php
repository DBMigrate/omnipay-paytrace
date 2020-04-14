<?php

namespace Omnipay\TalusPay\Message\CreditCard;

class PurchaseRequest extends AuthorizeRequest
{
    protected $type = 'Sale';

    public function getEndpoint()
    {
        if ($this->getCardReference()) {
            // by customer id
            return $this->getParameter('baseUrl') .'/v1/transactions/sale/by_customer';
        }

        // keyed sale
        return $this->getParameter('baseUrl') .'/v1/transactions/sale/keyed';
    }
}
