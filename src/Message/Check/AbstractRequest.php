<?php

namespace Omnipay\TalusPay\Message\Check;

use Omnipay\TalusPay\Check;

abstract class AbstractRequest extends \Omnipay\TalusPay\Message\AbstractRequest
{
    protected $responseClass = 'Omnipay\TalusPay\Message\Check\Response';

    /**
     * @return \Omnipay\TalusPay\Check
     */
    public function getCheck()
    {
        return $this->getParameter('check');
    }

    public function setCheck($value)
    {
        if ($value && !$value instanceof Check) {
            $value = new Check($value);
        }

        return $this->setParameter('check', $value);
    }

    protected function getBillingSource()
    {
        return $this->getCheck();
    }

    protected function getBaseData()
    {
        return [
            'integrator_id' => $this->getIntegratorId(),
        ];
    }
}
