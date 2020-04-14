<?php

namespace Omnipay\TalusPay\Message\CreditCard;

class CaptureRequest extends AbstractRequest
{
    protected $type = 'Capture';
    protected $responseClass = 'Omnipay\TalusPay\Message\CreditCard\CaptureResponse';

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
