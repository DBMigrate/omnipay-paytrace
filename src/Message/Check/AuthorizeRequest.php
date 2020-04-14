<?php

namespace Omnipay\TalusPay\Message\Check;

class AuthorizeRequest extends AbstractRequest
{
    protected $method = 'ProcessCheck';
    protected $type = 'Hold';

    /**
     * @inheritdoc
     */
    public function getData()
    {
        $this->validate('amount', 'check');
        $check = $this->getCheck();
        $check->validate();
        $data = $this->getBaseData();
        $data['check'] = [
          'account_number' => $check->getBankAccount(),
          'routing_number' => $check->getRoutingNumber(),
        ];
        $data['amount'] = $this->getAmount();

        return array_merge($data, $this->getBillingData());
    }

    public function getEndpoint()
    {
        return $this->getParameter('baseUrl') .'/v1/checks/sale/by_account';
    }
}
