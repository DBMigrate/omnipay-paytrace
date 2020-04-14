<?php

namespace Omnipay\TalusPay\Message\CreditCard;

abstract class AbstractRequest extends \Omnipay\TalusPay\Message\AbstractRequest
{

    public function setEncryptedNumber($data) {
        $this->setParameter('encryptedNumber', $data);
    }

    protected function getBillingSource()
    {
        return $this->getCard();
    }

    protected function getBaseData()
    {
        return [
            'integrator_id' => $this->getIntegratorId(),
        ];
    }

    protected function getCardData()
    {
        $this->validate('card');
        $card = $this->getCard();
        $cardData = [];
        if ( $this->getParameter('encryptedNumber')) {
            $cardData['encrypted_number'] = $this->getParameter('encryptedNumber');
        } else {
            $cardData['number'] = $card->getNumber();
        }
        $cardData['expiration_year'] = substr($card->getExpiryYear(), -2);
        $cardData['expiration_month'] = str_pad($card->getExpiryMonth(), 2, '0', STR_PAD_LEFT);

        return [
            'credit_card' => $cardData,
            'csc' => $card->getCvv(),// 3 digits
        ];
    }
}
