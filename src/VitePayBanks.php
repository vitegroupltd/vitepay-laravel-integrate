<?php

namespace ViteGroup\VitePay;

use GuzzleHttp\Exception\GuzzleException;

class VitePayBanks
{
    private VitePaySdk $sdk;

    public function __construct(string $api_key='')
    {
        $this->sdk = new VitePaySdk($api_key);
    }

    /**
     * @throws GuzzleException
     */
    public function list(): array
    {
        return $this->sdk->post($this->sdk->url['banks']['list']);
    }
}
