<?php

namespace Omnipay\Paytrace\Message\CreditCard;

class AuthorizeRequest extends AbstractRequest
{
    protected $type = 'Authorization';
    protected $responseClass = 'Omnipay\Paytrace\Message\CreditCard\AuthorizeResponse';


    public function getData()
    {
        $this->validate('amount');
        $data = $this->getBaseData();
        if ($this->getCardReference()) {
            $data['customer_id'] = $this->getCardReference();
        } else {
            $data = array_merge($data, $this->getCardData());
        }

        $result =  array_merge($data, $this->getBillingData());

        return $result;

    }

    public function getEndpoint()
    {
        if ($this->getCardReference()) {
            // valut authorization by customer id
            return $this->getParameter('baseUrl') .'/v1/transactions/authorization/by_customer';
        }

        // keyed authorization
        return $this->getParameter('baseUrl') .'/v1/transactions/authorization/keyed';
    }

}
