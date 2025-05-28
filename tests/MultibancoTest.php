<?php

namespace Upgradelabs\Ifthenpay\Tests;

use Illuminate\Support\Facades\Http;
use Upgradelabs\Ifthenpay\Facades\Ifthenpay;

class MultibancoTest extends TestCase
{
    public function testCreateMultibancoReference()
    {
        Http::fake([
            'https://ifthenpay.com/api/multibanco/reference/sandbox' => Http::response([
                'Amount' => '123.45',
                'Entity' => '12345',
                'ExpiryDate' => '01-01-2026',
                'Message' => 'Success',
                'OrderId' => 'order-1',
                'Reference' => '123456789',
                'RequestId' => 'req-1',
                'Status' => '0'
            ], 200)
        ]);

        $response = Ifthenpay::createMultibancoReference([
            'orderId' => 'order-1',
            'amount' => '123.45'
        ]);

        $this->assertEquals('123.45', $response['Amount']);
        $this->assertEquals('12345', $response['Entity']);
    }
}
