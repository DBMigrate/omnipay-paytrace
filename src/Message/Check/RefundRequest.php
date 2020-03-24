<?php

namespace Omnipay\Paytrace\Message\Check;

class RefundRequest extends AuthorizeRequest
{
    protected $type = 'Refund';

    public function getData()
    {
        if ($this->getCheck()) {
            $this->validate('amount', 'check');
            $check = $this->getCheck();
            $check->validate();
            $data = $this->getBaseData();
            $data['check'] = [
                'account_number' => $check->getBankAccount(),
                'routing_number' => $check->getRoutingNumber(),
            ];
            $data = array_merge($data, $this->getBillingData());
        } else {
            $this->validate('transactionReference');
            $data = $this->getBaseData();
            $data['check_transaction_id'] = $this->getTransactionReference();
        }

        if ($this->getAmount()) {
            $data['amount'] = $this->getAmount();
        }
        return $data;
    }

    public function getEndpoint()
    {
        if ($this->getCheck()) {
            // refund by account
            return $this->getParameter('baseUrl') .'/v1/checks/refund/by_account';
        } else {
            // refund by transaction id
            return $this->getParameter('baseUrl') .'/v1/checks/refund/by_transaction';
        }
    }
}
