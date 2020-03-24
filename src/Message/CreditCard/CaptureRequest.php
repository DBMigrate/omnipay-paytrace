<?php

namespace Omnipay\Paytrace\Message\CreditCard;

class CaptureRequest extends AbstractRequest
{
    protected $type = 'Capture';
    protected $responseClass = 'Omnipay\Paytrace\Message\CreditCard\CaptureResponse';

    public function getData()
    {
        $this->validate('transactionReference');
        $data = $this->getBaseData();
        $data['transaction_id'] = $this->getTransactionReference();

        return $data;
    }

    public function getEndpoint()
    {
        return $this->getParameter('baseUrl') .'/v1/transactions/authorization/capture';
    }
}
