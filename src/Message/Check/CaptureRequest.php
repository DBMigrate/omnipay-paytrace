<?php

namespace Omnipay\TalusPay\Message\Check;

class CaptureRequest extends AbstractRequest
{
    protected $method = 'ManageCheck';
    protected $type = 'Fund';

    public function getData()
    {
        $this->validate('transactionReference');
        $data = $this->getBaseData();
        $data['check_transaction_id'] = $this->getTransactionReference();

        return $data;
    }

    public function getEndpoint()
    {
        return $this->getParameter('baseUrl') .'/v1/checks/manage/fund';
    }
}
