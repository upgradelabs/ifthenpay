# Upgradelabs Ifthenpay Laravel Package

This package provides an easy integration with the Ifthenpay API for Laravel projects.

## Installation

Require the package via composer:

```bash
composer require upgradelabs/ifthenpay
```

Publish the configuration file:

```bash
php artisan vendor:publish --provider="Upgradelabs\Ifthenpay\IfthenpayServiceProvider" --tag="config"
```

Set your API keys in your `.env` file:

```
IFTHENPAY_SANDBOX=true
IFTHENPAY_MB_KEY=MBK-xxxxxxxx
IFTHENPAY_MBWAY_KEY=MBWAY-xxxxxxxx
IFTHENPAY_CCARD_KEY=CCARD-xxxxxxxx
IFTHENPAY_GATEWAY_KEY=GWK-xxxxxxxx
IFTHENPAY_GOOGLE_KEY=GOOGLE-xxxxxxxx
IFTHENPAY_APPLE_KEY=APPLE-xxxxxxxx
IFTHENPAY_BACKOFFICE_KEY=BACKOFFICE-xxxxxxxx
```

## Usage

Use the `Ifthenpay` facade for all operations:

```php
use Ifthenpay;

// Create Multibanco Reference
$response = Ifthenpay::createMultibancoReference([
    'orderId' => 'order-1234',
    'amount' => '123.45',
    'description' => 'Order description',
    'url' => 'https://example.com',
    'expiryDays' => 3,
]);

// Initiate MB WAY payment
$response = Ifthenpay::createMbwayPayment([
    'orderId' => 'order-1234',
    'amount' => '123.45',
    'mobileNumber' => '912345678',
]);

// Check MB WAY payment status
$status = Ifthenpay::getMbwayStatus($response['RequestId']);

// Initialize Credit Card payment
$response = Ifthenpay::initCreditCardPayment([
    'orderId'    => 'order-1234',
    'amount'     => '123.45',
    'successUrl' => 'https://example.com/success',
    'errorUrl'   => 'https://example.com/error',
    'cancelUrl'  => 'https://example.com/cancel',
    'language'   => 'en',
]);

// Create Google Pay payment
$response = Ifthenpay::createGooglePayPayment([
    'id'          => 'order-1234',
    'amount'      => '123.45',
    'description' => 'Order description',
    'lang'        => 'en',
    'expiredate'  => '20250101',
    'btnCloseUrl'    => 'https://example.com/close',
    'btnCloseLabel'  => 'Close',
    'success_url'    => 'https://example.com/success',
    'error_url'      => 'https://example.com/error',
    'cancel_url'     => 'https://example.com/cancel',
]);

// Create Apple Pay payment
$response = Ifthenpay::createApplePayPayment([
    'id'     => 'order-1234',
    'amount' => '123.45',
]);

// Issue a refund
$response = Ifthenpay::refund('request-id-123', '50.00');
```

## Testing

Run the tests with:

```bash
vendor/bin/phpunit
```

## License

MIT
