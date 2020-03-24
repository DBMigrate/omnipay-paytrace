<?php

namespace Omnipay\Paytrace\Message\CreditCard;

abstract class AbstractRequest extends \Omnipay\Paytrace\Message\AbstractRequest
{
    // why exactly this is needed?
//    protected $method = 'ProcessTranx';

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
        $this->getCard()->validate();
        $card = $this->getCard();
        $cardData = [];
        //TODO: enable encrypted number
        $cardData['number'] = $card->getNumber();
        //TODO 2 or 4 digit (4 also ok)
        $cardData['expiration_year'] = substr($card->getExpiryYear(), -2);
        $cardData['expiration_month'] = str_pad($card->getExpiryMonth(), 2, '0', STR_PAD_LEFT);

        return [
            'credit_card' => $cardData,
            'csc' => $card->getCvv(),// 3 digits
        ];
    }
}
