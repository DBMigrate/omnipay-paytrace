<?php

namespace Omnipay\Paytrace;

/**
 * @method \Omnipay\Common\Message\RequestInterface completeAuthorize(array $options = array())
 * @method \Omnipay\Common\Message\RequestInterface completePurchase(array $options = array())
 * @method \Omnipay\Common\Message\RequestInterface deleteCard(array $options = array())
 */
class AbstractGateway extends \Omnipay\Common\AbstractGateway
{
    const GATEWAY_TYPE = '';

    public function getName()
    {
        return 'PayTrace Check'; // @codeCoverageIgnore
    }

    public function getDefaultParameters()
    {
        return array(
            'username' => '',
            'password' => '',
            'integratorId' => '',
            'testMode' => false,
            'endpoint' => 'https://api.paytrace.com',
            'baseUrl' => 'https://api.paytrace.com',
        );
    }

    public function authorize(array $params = [])
    {
        return $this->createRequest(
            '\Omnipay\Paytrace\Message\\' . static::GATEWAY_TYPE . '\AuthorizeRequest',
            $params
        );
    }

    public function createCard(array $params = [])
    {
        return $this->createRequest(
            '\Omnipay\Paytrace\Message\\' . static::GATEWAY_TYPE . '\CreateCardRequest',
            $params
        );
    }

    public function updateCard(array $params = [])
    {
        return $this->createRequest(
            '\Omnipay\Paytrace\Message\\' . static::GATEWAY_TYPE . '\UpdateCardRequest',
            $params
        );
    }

    public function capture(array $params = [])
    {
        return $this->createRequest('\Omnipay\Paytrace\Message\\' . static::GATEWAY_TYPE . '\CaptureRequest', $params);
    }

    public function purchase(array $params = [])
    {
        return $this->createRequest('\Omnipay\Paytrace\Message\\' . static::GATEWAY_TYPE . '\PurchaseRequest', $params);
    }

    public function void(array $params = [])
    {
        return $this->createRequest('\Omnipay\Paytrace\Message\\' . static::GATEWAY_TYPE . '\VoidRequest', $params);
    }

    public function refund(array $params = [])
    {
        return $this->createRequest('\Omnipay\Paytrace\Message\\' . static::GATEWAY_TYPE . '\RefundRequest', $params);
    }

    public function getUserName()
    {
        return $this->getParameter('username');
    }

    public function setUserName($value)
    {
        return $this->setParameter('username', $value);
    }

    public function getPassword()
    {
        return $this->getParameter('password');
    }

    public function setPassword($value)
    {
        return $this->setParameter('password', $value);
    }

    public function getIntegrator()
    {
        return $this->getParameter('integratorId');
    }

    public function setIntegratorId($value)
    {
        return $this->setParameter('integratorId', $value);
    }

    public function getEndpoint()
    {
        return $this->getParameter('endpoint');
    }

    public function setEndpoint($value)
    {
        return $this->setParameter('endpoint', $value);
    }

    public function __call($name, $arguments)
    {
        // TODO: Implement @method \Omnipay\Common\Message\RequestInterface completeAuthorize(array $options = array())
        // TODO: Implement @method \Omnipay\Common\Message\RequestInterface completePurchase(array $options = array())
        // TODO: Implement @method \Omnipay\Common\Message\RequestInterface deleteCard(array $options = array())
    }
}
