<?php

namespace ViteGroup\VitePay;

use GuzzleHttp\Exception\GuzzleException;

class VitePayHistories
{
    private VitePaySdk $sdk;

    public function __construct(string $api_key='')
    {
        $this->sdk = new VitePaySdk($api_key);
    }

    /**
     * @throws GuzzleException
     */
    public function list(string $number): array
    {
        $param = [
            'number' => $number
        ];
        return $this->sdk->post($this->sdk->url['histories']['list'], $param);
    }
}
