# Omnipay: PayTrace

**PayTrace driver for the Omnipay PHP payment processing library**

[Omnipay](https://github.com/thephpleague/omnipay) is a framework agnostic, multi-gateway payment
processing library for PHP 5.3+. This package implements [PayTrace](https://www.paytrace.net) support for Omnipay.

An attempt to move this to omnipay 3 and PayTrace JSON api.
## Installation
(to be updated - probably I'll have to name fork differently to be able to use it instead of current omnipay-paytrace)


Omnipay is installed via [Composer](http://getcomposer.org/). To install, simply add it
to your `composer.json` file:

```json
{
    "require": {
        "softcommerce/omnipay-paytrace": "~1.0"
    }
}
```

And run composer to update your dependencies:

    $ curl -s http://getcomposer.org/installer | php
    $ php composer.phar update

## Basic Usage

The following gateways are provided by this package:

* Paytrace_CreditCard
* Paytrace_Check

Usage Example:
```php
$ccGateway = \Omnipay\Omnipay::create('Paytrace_CreditCard');
$ccGateway->setUserName('demo123')
	->setPassword('demo123')
	->setTestMode(true);

$creditCardData = ['number' => '4242424242424242', 'expiryMonth' => '6', 'expiryYear' => '2016', 'cvv' => '123'];
$response = $ccGateway->purchase(['amount' => '10.00', 'currency' => 'USD', 'card' => $creditCardData])->send();

if ($response->isSuccessful()) {
	// SUCCESS
    echo $response->getMessage();
} else {
	// FAIL
    echo $response->getMessage();
}

$chGateWay = \Omnipay\Omnipay::create('Paytrace_Check');
$chGateway->setUserName('demo123')
	->setPassword('demo123')
	->setTestMode(true);

$checkData = ['routingNumber' => '325070760', 'bankAccount' => '1234567890', 'name' => 'John Doe'];
$response = $chGateway->purchase(['amount' => '10.00', 'currency' => 'USD', 'check' => $checkData])->send();

if ($response->isSuccessful()) {
	// SUCCESS
    echo $response->getMessage();
} else {
	// FAIL
    echo $response->getMessage();
}
```


For general usage instructions, please see the main [Omnipay](https://github.com/thephpleague/omnipay)
repository.
