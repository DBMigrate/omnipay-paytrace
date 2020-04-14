<?php

namespace Omnipay\TalusPay\Message;

use Omnipay\Common\Http\Exception;

abstract class AbstractRequest extends \Omnipay\Common\Message\AbstractRequest
{
    protected $method;
    protected $type;
    protected $responseClass;

    public function sendData($data)
    {
        $token = $this->getToken();
        $accessToken = $token['access_token'];
        $headers = [
            'Content-type' => 'application/json',
            'Authorization' => 'Bearer ' . $accessToken,
        ];

            $httpResponse = $this->httpClient->request(
                'POST',
                $this->getEndpoint(),
                $headers,
                json_encode($data)
            );

        $responseClass = $this->responseClass;

        try {
            $this->response = new $responseClass($this, $httpResponse->getBody());
        } catch (\Exception $e) {
            var_dump($e->getTraceAsString()); die(__FILE__.':'.__LINE__);
        }

        return $this->response;
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

    public function getIntegratorId()
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

    public function getBaseUrl()
    {
        return $this->getParameter('baseUrl');
    }

    public function setBaseUrl($value)
    {
        return $this->setParameter('baseUrl', $value);
    }

    public function getInvoiceId()
    {
        return $this->getParameter('invoiceId');
    }

    public function setInvoiceId($value)
    {
        return $this->setParameter('invoiceId', $value);
    }

    public function getCardReference()
    {
        return $this->getParameter('custid');
    }

    public function setCardReference($value)
    {
        return $this->setParameter('custid', $value);
    }

    /**
     * @return \Omnipay\Common\CreditCard|\Omnipay\TalusPay\Check
     */
    protected function getBillingSource()
    {
        return null; // @codeCoverageIgnore
    }

    protected function getBillingData()
    {
        $data = [
            'amount' => $this->getAmount(),
            'description' => $this->getDescription(),
            'invoice_id' => $this->getInvoiceId() ?? '',
        ];

        $source = $this->getBillingSource();
        if (!$source) {
            return $data; // @codeCoverageIgnore
        }

        if ($source->getPhone()) {
            $data['phone'] = $source->getPhone();
        }
        if ($source->getEmail()) {
            $data['email'] = $source->getEmail();
        }


        $billingAddress = [];
        $billingAddress['name'] = $source->getBillingName();
        $billingAddress['street_address'] = $source->getBillingAddress1();
        $billingAddress['street_address2'] = $source->getBillingAddress2();
        $billingAddress['city'] = $source->getBillingCity();
        $billingAddress['country'] = $source->getBillingCountry();
        $billingAddress['state'] = $source->getBillingState();
        $billingAddress['zip'] = $source->getBillingPostcode();
        $data['billing_address'] = array_filter($billingAddress);

        $shippingAddress = [];
        $shippingAddress['street_address'] = $source->getShippingAddress1();
        $shippingAddress['street_address2'] = $source->getShippingAddress2();
        $shippingAddress['city'] = $source->getShippingCity();
        $shippingAddress['city'] = $source->getShippingCountry();
        $shippingAddress['state'] = $source->getShippingState();
        $shippingAddress['zip'] = $source->getShippingPostcode();
        $shippingAddress = array_filter($shippingAddress);
        if ($shippingAddress ) {
            $data['shipping_address'] = $shippingAddress;
        }

        return $data;
    }


    public function getToken(): array
    {
        $response = $this->httpClient->request(
            'POST',
            $this->getBaseUrl() . '/oauth/token',
            [
                'Accept' => '*/*'
            ],
            http_build_query([
                'grant_type' => 'password',
                'username' => $this->getUserName(),
                'password' => $this->getPassword(),
            ])
        );

        $result =  \GuzzleHttp\json_decode($response->getBody(), true);

        return $result;
    }



}
