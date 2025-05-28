<?php

namespace Upgradelabs\Ifthenpay\Tests;

use Illuminate\Support\Facades\Http;
use Upgradelabs\Ifthenpay\Facades\Ifthenpay;

class WalletTest extends TestCase
{
    public function testCreateGooglePayPayment()
    {
        Http::fake([
            'https://api.ifthenpay.com/gateway/pinpay/*' => Http::response([
                'PinCode' => '1234',
                'RedirectUrl' => 'https://redirect.url'
            ], 200)
        ]);

        $response = Ifthenpay::createGooglePayPayment([
            'id' => 'order-1',
            'amount' => '30.00'
        ]);

        $this->assertEquals('1234', $response['PinCode']);
    }

    public function testCreateApplePayPayment()
    {
        Http::fake([
            'https://api.ifthenpay.com/gateway/pinpay/*' => Http::response([
                'PinCode' => '5678',
                'RedirectUrl' => 'https://redirect.url'
            ], 200)
        ]);

        $response = Ifthenpay::createApplePayPayment([
            'id' => 'order-1',
            'amount' => '40.00'
        ]);

        $this->assertEquals('5678', $response['PinCode']);
    }
}
