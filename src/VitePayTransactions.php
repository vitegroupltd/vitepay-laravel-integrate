<?php

namespace ViteGroup\VitePay;

use GuzzleHttp\Exception\GuzzleException;

class VitePayTransactions
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
        return $this->sdk->post($this->sdk->url['transactions']['list']);
    }

    /**
     * @throws GuzzleException
     */
    public function create(string $code='', string $number='', int $amount=0, string $description=''): array
    {
        $param = [
            'code' => $code,
            'number' => $number,
            'amount' => $amount,
            'description' => $description
        ];
        return $this->sdk->post($this->sdk->url['transactions']['create'], $param);
    }

    /**
     * @throws GuzzleException
     */
    public function update(string $code, int $amount=0, string $description='', int $status=0, null|int $history_id=null): array
    {
        $param = [
            'code' => $code,
            'amount' => $amount,
            'description' => $description,
            'status' => $status
        ];
        if ($history_id) {
            $param['history_id'] = $history_id;
        }
        return $this->sdk->post($this->sdk->url['transactions']['update'], $param);
    }

    /**
     * @throws GuzzleException
     */
    public function delete(string $code): array
    {
        $param = [
            'code' => $code
        ];
        return $this->sdk->post($this->sdk->url['transactions']['delete'], $param);
    }
}
