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
            $data['CUSTID'] = $this->getCardReference();
        } else {
            $data = array_merge($data, $this->getCardData());
        }
        if ($this->getTestMode()) {
            $data['TEST'] = 'Y';
        }
        $result =  array_merge($data, $this->getBillingData());

        debug_print_backtrace();

        var_dump($result);
        die(__FILE__.":".__LINE__);
        return $result;

    }

    public function getEndpoint()
    {
        return $this->getParameter('endpoint') .'/v1/transactions/authorization/keyed';
    }

}
