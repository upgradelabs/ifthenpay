<?php

namespace Upgradelabs\Ifthenpay\Tests;

use Illuminate\Support\Facades\Http;
use Upgradelabs\Ifthenpay\Facades\Ifthenpay;

class CreditCardTest extends TestCase
{
    public function testInitCreditCardPayment()
    {
        Http::fake([
            'https://ifthenpay.com/api/creditcard/init/*' => Http::response([
                'Message' => 'Success',
                'PaymentUrl' => 'https://payment.url',
                'RequestId' => 'req-1',
                'Status' => '0'
            ], 200)
        ]);

        $response = Ifthenpay::initCreditCardPayment([
            'orderId' => 'order-1',
                    'amount' => '50.00',
                    'successUrl' => 'https://success',
                    'errorUrl' => 'https://error',
                    'cancelUrl' => 'https://cancel'
        ]);

        $this->assertEquals('https://payment.url', $response['PaymentUrl']);
    }
}
