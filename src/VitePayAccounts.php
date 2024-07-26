<?php

namespace ViteGroup\VitePay;

use GuzzleHttp\Exception\GuzzleException;

class VitePayAccounts
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
        return $this->sdk->post($this->sdk->url['accounts']['list']);
    }

    /**
     * @throws GuzzleException
     */
    public function create(string $bank, string $name, string $number, string $username, string $password, string $currency, string $description=''): array
    {
        $param = [
            'bank' => $bank,
            'name' => $name,
            'number' => $number,
            'username' => $username,
            'password' => $password,
            'currency' => $currency,
            'description' => $description
        ];
        return $this->sdk->post($this->sdk->url['accounts']['create'], $param);
    }

    /**
     * @throws GuzzleException
     */
    public function update(string $number, string $password, string $description='', int $status=1): array
    {
        $param = [
            'number' => $number,
            'password' => $password,
            'description' => $description,
            'status' => $status
        ];
        return $this->sdk->post($this->sdk->url['accounts']['update'], $param);
    }

    /**
     * @throws GuzzleException
     */
    public function delete(string $number): array
    {
        $param = [
            'number' => $number
        ];
        return $this->sdk->post($this->sdk->url['accounts']['delete'], $param);
    }
}
