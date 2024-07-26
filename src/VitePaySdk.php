<?php

namespace ViteGroup\VitePay;

use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Config;

class VitePaySdk
{
    public array $url;
    private string $api_key;
    private string $server;
    private Client $client;

    public function __construct(string $api_key='')
    {
        $this->api_key = empty($api_key) ? Config::get('vitepay.api_key') : $api_key;
        $this->server = 'https://vitepay.dev/api';
        $this->url = [
            'banks' => [
                'list' => '/banks/list',
            ],
            'accounts' => [
                'list' => '/accounts/list',
                'create' => '/accounts/create',
                'update' => '/accounts/update',
                'delete' => '/accounts/delete'
            ],
            'histories' => [
                'list' => '/histories/list'
            ],
            'transactions' => [
                'list' => '/transactions/list',
                'create' => '/transactions/create',
                'update' => '/transactions/update',
                'delete' => '/transactions/delete'
            ],
        ];

        $this->client = new Client([
            'headers' => ['User-Agent' => 'VitePay (+https://vitepay.dev)', 'X-Api-Key' => $this->api_key],
            'http_errors' => false
        ]);
    }

    public function parse($data): array
    {
        try {
            if (!$data) {
                return [];
            }
            $tmp = json_decode(json_encode($data, true), true);
            if (!is_array($tmp)) {
                $tmp = json_decode($tmp, true);
            }
            return $tmp ?? ['status' => false, 'message' => 'The post param has some wrong type of values'];
        } catch (\Exception) {
            return ['status' => false, 'message' => 'The post param has some wrong type of values'];
        }
    }

    /**
     * @throws GuzzleException
     */
    public function post(string $uri, array $param=[]): array
    {
        if (!str_starts_with($uri, 'https://') && !str_starts_with($uri, 'http://')) {
            $url = $this->server . $uri;
        } else {
            $url = $uri;
        }
        $param['api_key'] = $this->api_key;
        $res = $this->client->request('POST', $url, [
            'json' => $param
        ]);
        if ($res->getStatusCode() == 200) {
            return $this->parse($res->getBody()->getContents());
        } else {
            return ['status' => false, 'message' => 'HTTP error '. $res->getStatusCode()];
        }
    }
}