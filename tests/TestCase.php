<?php

namespace Upgradelabs\Ifthenpay\Tests;

use Orchestra\Testbench\TestCase as BaseTestCase;
use Upgradelabs\Ifthenpay\IfthenpayServiceProvider;

abstract class TestCase extends BaseTestCase
{
    protected function getPackageProviders($app)
    {
        return [IfthenpayServiceProvider::class];
    }

    protected function getEnvironmentSetUp($app)
    {
        // Enable sandbox and set test keys
        $app['config']->set('ifthenpay.sandbox', true);
        $app['config']->set('ifthenpay.mb_key', 'TEST_MB_KEY');
        $app['config']->set('ifthenpay.mbway_key', 'TEST_MBWAY_KEY');
        $app['config']->set('ifthenpay.ccard_key', 'TEST_CCARD_KEY');
        $app['config']->set('ifthenpay.gateway_key', 'TEST_GATEWAY_KEY');
        $app['config']->set('ifthenpay.google_key', 'TEST_GOOGLE_KEY');
        $app['config']->set('ifthenpay.apple_key', 'TEST_APPLE_KEY');
        $app['config']->set('ifthenpay.backoffice_key', 'TEST_BACKOFFICE_KEY');
    }
}
