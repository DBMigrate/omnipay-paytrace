<?php

namespace Omnipay\TalusPay\Message\Check;

class CreateCardRequest extends AuthorizeRequest
{
    protected $type = 'CreateCustomer';
    protected $responseClass = 'Omnipay\TalusPay\Message\CreditCard\CreateCardResponse';

    /**
     * @inheritdoc
     */
    public function getData()
    {
        $this->validate('check');
        $check = $this->getCheck();
        $check->validate();
        $data = $this->getBaseData();
        $data['check'] = [
            'account_number' => $check->getBankAccount(),
            'routing_number' => $check->getRoutingNumber(),
        ];
        $data['customer_id'] = $this->getCardReference();

        $billingData = $this->getBillingData();
        unset($billingData['amount']);
        unset($billingData['description']);
        unset($billingData['invoice_id']);
        return array_merge($data, $billingData);
    }

    public function getEndpoint()
    {
        return $this->getParameter('baseUrl') .'/v1/customer/create';
    }
}
