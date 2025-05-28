<?php

namespace Upgradelabs\Ifthenpay\Tests;

use Illuminate\Support\Facades\Http;
use Upgradelabs\Ifthenpay\Facades\Ifthenpay;

class MbwayTest extends TestCase
{
    public function testCreateMbwayPayment()
    {
        Http::fake([
            'https://api.ifthenpay.com/spg/payment/mbway' => Http::response([
                'Amount' => '100.00',
                'Message' => 'Pending',
                'OrderId' => 'order-1',
                'RequestId' => 'req-1',
                'Status' => '000'
            ], 200)
        ]);

        $response = Ifthenpay::createMbwayPayment([
            'orderId' => 'order-1',
            'amount' => '100.00',
            'mobileNumber' => '912345678'
        ]);

        $this->assertEquals('Pending', $response['Message']);
    }

    public function testGetMbwayStatus()
    {
        Http::fake([
            'https://api.ifthenpay.com/spg/payment/mbway/status*' => Http::response([
                'CreatedAt' => '01-01-2025 00:00:00',
                'Message' => 'Success',
                'RequestId' => 'req-1',
                'Status' => '000',
                'UpdateAt' => '01-01-2025 00:01:00'
            ], 200)
        ]);

        $response = Ifthenpay::getMbwayStatus('req-1');
        $this->assertEquals('Success', $response['Message']);
    }
}
