<?php

namespace Upgradelabs\Ifthenpay\Tests;

use Illuminate\Support\Facades\Http;
use Upgradelabs\Ifthenpay\Facades\Ifthenpay;

class RefundTest extends TestCase
{
    public function testRefund()
    {
        Http::fake([
            'https://ifthenpay.com/api/endpoint/payments/refund' => Http::response([
                'Code' => 1,
                'Message' => 'Successful refunded'
            ], 200)
        ]);

        $response = Ifthenpay::refund('req-1', '10.00');
        $this->assertEquals(1, $response['Code']);
    }
}
