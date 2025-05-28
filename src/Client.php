<?php

namespace Upgradelabs\Ifthenpay;

use Illuminate\Support\Facades\Http;
use Upgradelabs\Ifthenpay\Exceptions\IfthenpayException;
use Upgradelabs\Ifthenpay\Exceptions\MultibancoException;
use Upgradelabs\Ifthenpay\Exceptions\MbwayException;
use Upgradelabs\Ifthenpay\Exceptions\CreditCardException;
use Upgradelabs\Ifthenpay\Exceptions\WalletException;
use Upgradelabs\Ifthenpay\Exceptions\RefundException;

class Client
{
    public function createMultibancoReference(array $data): array
    {
        $endpoint = config('ifthenpay.sandbox')
            ? config('ifthenpay.multibanco.sandbox')
            : config('ifthenpay.multibanco.init');

        $data['mbKey'] = config('ifthenpay.mb_key');

        $response = Http::post($endpoint, $data);
        if (!$response->successful()) {
            throw new MultibancoException('HTTP Error: '.$response->status());
        }

        $body = $response->json();
        if (($body['Status'] ?? null) !== '0') {
            throw new MultibancoException($body['Message'] ?? 'Unknown error', (int) ($body['Status'] ?? -1));
        }

        return $body;
    }

    public function createMbwayPayment(array $data): array
    {
        $endpoint = config('ifthenpay.mbway.endpoint');
        $data['mbWayKey'] = config('ifthenpay.mbway_key');

        $response = Http::post($endpoint, $data);
        if (!$response->successful()) {
            throw new MbwayException('HTTP Error: '.$response->status());
        }

        $body = $response->json();
        if (($body['Status'] ?? null) !== '000') {
            throw new MbwayException($body['Message'] ?? 'Unknown error', (int) ($body['Status'] ?? -1));
        }

        return $body;
    }

    public function getMbwayStatus(string $requestId): array
    {
        $endpoint = config('ifthenpay.mbway.status_endpoint');

        $response = Http::get($endpoint, [
            'mbWayKey' => config('ifthenpay.mbway_key'),
            'requestId' => $requestId,
        ]);

        if (!$response->successful()) {
            throw new MbwayException('HTTP Error: '.$response->status());
        }

        $body = $response->json();
        if (($body['Status'] ?? null) !== '000') {
            throw new MbwayException($body['Message'] ?? 'Unknown error', (int) ($body['Status'] ?? -1));
        }

        return $body;
    }

    public function initCreditCardPayment(array $data): array
    {
        $endpoint = config('ifthenpay.creditcard.base_url').'/'.config('ifthenpay.ccard_key');

        $response = Http::post($endpoint, $data);
        if (!$response->successful()) {
            throw new CreditCardException('HTTP Error: '.$response->status());
        }

        $body = $response->json();
        if (($body['Status'] ?? null) !== '0') {
            throw new CreditCardException($body['Message'] ?? 'Unknown error', (int) ($body['Status'] ?? -1));
        }

        return $body;
    }

    protected function createPinpayPayment(array $data, string $accounts): array
    {
        $endpoint = config('ifthenpay.pinpay.base_url').'/'.config('ifthenpay.gateway_key');
        $data['accounts'] = $accounts;

        $response = Http::post($endpoint, $data);
        if (!$response->successful()) {
            throw new WalletException('HTTP Error: '.$response->status());
        }

        $body = $response->json();
        if (!isset($body['PinCode'], $body['RedirectUrl'])) {
            throw new WalletException($body['Message'] ?? 'Unknown error');
        }

        return $body;
    }

    public function createGooglePayPayment(array $data): array
    {
        return $this->createPinpayPayment($data, 'GOOGLE|'.config('ifthenpay.google_key'));
    }

    public function createApplePayPayment(array $data): array
    {
        return $this->createPinpayPayment($data, 'APPLE|'.config('ifthenpay.apple_key'));
    }

    public function refund(string $requestId, string $amount): array
    {
        $endpoint = config('ifthenpay.refund.endpoint');
        $data = [
            'backofficekey' => config('ifthenpay.backoffice_key'),
            'requestId'    => $requestId,
            'amount'       => $amount,
        ];

        $response = Http::post($endpoint, $data);
        if (!$response->successful()) {
            throw new RefundException('HTTP Error: '.$response->status());
        }

        $body = $response->json();
        if (($body['Code'] ?? 0) !== 1) {
            throw new RefundException($body['Message'] ?? 'Unknown error', (int) ($body['Code'] ?? 0));
        }

        return $body;
    }
}
