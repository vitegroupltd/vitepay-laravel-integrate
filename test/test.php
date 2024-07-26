<?php

namespace App\Console\Commands;

use GuzzleHttp\Exception\GuzzleException;
use ViteGroup\VitePay\VitePayTransactions;
use Illuminate\Console\Command;

class VitePayTestCommand extends Command
{
    protected $signature = 'vitepay:test';

    protected $description = 'Test VitePay SDK';

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @throws GuzzleException
     */
    public function handle()
    {
        $instance = new VitePayTransactions();
        print_r($instance->create(
            'INV-test-01',
            '',
            100000,
            'Description-test-01'
        ));
    }
}