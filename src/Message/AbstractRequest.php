<?php

namespace Omnipay\Paytrace\Message;

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
            'MIME-Version' => '1.0',
            // wtf
            'Content-type' => 'application/x-www-form-urlencoded',
            'Contenttransfer-encoding' => 'text',
            'Authorization' => 'Bearer ' . $accessToken,
        ];


        $httpResponse = $this->httpClient->request(
            'POST',
            $this->getEndpoint(),
            $headers,
            json_encode($data)
        );
        $responseClass = $this->responseClass;

        return $this->response = new $responseClass($this, $httpResponse->getBody());
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

    public function getEndpoint()
    {
        return $this->getParameter('endpoint');
    }

    public function setEndpoint($value)
    {
        return $this->setParameter('endpoint', $value);
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
     * @return \Omnipay\Common\CreditCard|\Omnipay\Paytrace\Check
     */
    protected function getBillingSource()
    {
        return null; // @codeCoverageIgnore
    }

    protected function getBillingData()
    {
        $data = [
            'AMOUNT' => $this->getAmount(),
            'DESCRIPTION' => $this->getDescription(),
            'INVOICE' => $this->getInvoiceId(),
        ];

        $source = $this->getBillingSource();
        if (!$source) {
            return $data; // @codeCoverageIgnore
        }

        $data['BNAME'] = $source->getBillingName();
        $data['PHONE'] = $source->getPhone();
        $data['EMAIL'] = $source->getEmail();

        $data['BADDRESS'] = $source->getBillingAddress1();
        $data['BADDRESS2'] = $source->getBillingAddress2();
        $data['BCITY'] = $source->getBillingCity();
        $data['BCOUNTRY'] = $source->getBillingCountry();
        $data['BSTATE'] = $source->getBillingState();
        $data['BZIP'] = $source->getBillingPostcode();

        $data['SADDRESS'] = $source->getShippingAddress1();
        $data['SADDRESS2'] = $source->getShippingAddress2();
        $data['SCITY'] = $source->getShippingCity();
        $data['SCOUNTRY'] = $source->getShippingCountry();
        $data['SSTATE'] = $source->getShippingState();
        $data['SZIP'] = $source->getShippingPostcode();

        return $data;
    }


    public function getToken(): array
    {
        $response = $this->httpClient->request(
            'POST',
            $this->getEndpoint() . '/oauth/token',
            [
                'Accept' => '*/*'
            ],
            http_build_query([
                'grant_type' => 'password',
                'username' => $this->getUserName(),
                'password' => $this->getPassword(),
            ])
        );

//        debug_print_backtrace();

        $result =  \GuzzleHttp\json_decode($response->getBody(), true);

//        die(__FILE__.':'.__LINE__);

        return $result;
    }



}
