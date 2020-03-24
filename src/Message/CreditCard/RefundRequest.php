<?php

namespace Omnipay\Paytrace\Message\CreditCard;

class RefundRequest extends AbstractRequest
{
    protected $type = 'Refund';
    protected $responseClass = 'Omnipay\Paytrace\Message\CreditCard\CaptureResponse';

    public function getData()
    {
        if ($this->getCard()) {
            $this->validate('amount', 'card');
            $this->getCard()->validate();
            $data = $this->getBaseData();
            $data['amount'] = $this->getAmount();
            $data = array_merge($data, $this->getCardData());

        } else {
            $this->validate('transactionReference');
            $data = $this->getBaseData();
            $data['transaction_id'] = $this->getTransactionReference();
            if ($this->getAmount()) {
                $data['amount'] = $this->getAmount();
            }
        }
        return $data;
    }

    public function getEndpoint()
    {
        if ($this->getCard()) {
            // keyed refund
            return $this->getParameter('baseUrl') . '/v1/transactions/refundauth/keyed';
        }

        // refund for transaction id
        return $this->getParameter('baseUrl') .'/v1/transactions/refundauth/for_transaction';
    }
}
