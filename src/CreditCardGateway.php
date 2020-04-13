<?php

namespace Omnipay\Paytrace;

class CreditCardGateway extends AbstractGateway
{
    const GATEWAY_TYPE = 'CreditCard';

    public function getName()
    {
        return 'taluspay CreditCard';
    }

    public function getSupportsVisa()
    {
        return $this->getParameter('supportsVisa');
    }

    public function setSupportsVisa($value)
    {
        return $this->setParameter('supportsVisa', $value);
    }

    public function getSupportsMastercard()
    {
        return $this->getParameter('supportsMastercard');
    }

    public function setSupportsMastercard($value)
    {
        return $this->setParameter('supportsMastercard', $value);
    }

    public function getSupportsAmericanExpress()
    {
        return $this->getParameter('supportsAmericanExpress');
    }

    public function setSupportsAmericanExpress($value)
    {
        return $this->setParameter('supportsAmericanExpress', $value);
    }

    public function getSupportsDiscovery()
    {
        return $this->getParameter('supportsDiscovery');
    }

    public function setSupportsDiscover($value)
    {
        return $this->setParameter('supportsDiscovery', $value);
    }
}
