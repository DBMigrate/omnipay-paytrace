<?php

namespace Omnipay\TalusPay\Message\Check;

class VoidRequest extends CaptureRequest
{
    protected $type = 'Void';

    public function getEndpoint()
    {
        return $this->getParameter('baseUrl') .'/v1/checks/manage/void';
    }
}
