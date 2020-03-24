<?php

namespace Omnipay\Paytrace\Message\CreditCard;

class VoidRequest extends CaptureRequest
{
    protected $type = 'Void';


    public function getEndpoint()
    {
        return $this->getParameter('baseUrl') . '/v1/transactions/void';
    }
}
