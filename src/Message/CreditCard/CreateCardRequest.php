<?php

namespace Omnipay\TalusPay\Message\CreditCard;

class CreateCardRequest extends AuthorizeRequest
{
    protected $type = 'CreateCustomer';
    protected $responseClass = 'Omnipay\TalusPay\Message\CreditCard\CreateCardResponse';

    /**
     * @inheritdoc
     */
    public function getData()
    {
        $this->validate('card');
        $data = $this->getBaseData();
        $data = array_merge($data, $this->getCardData());
        unset($data['csc']);
        $data['customer_id'] = $this->getCardReference();
        unset($data['TRANXTYPE']);
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
