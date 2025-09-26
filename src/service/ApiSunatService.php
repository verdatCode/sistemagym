<?php

namespace App\Service;

use Cake\Http\Client;
use Cake\Log\Log;
use Cake\Core\Configure;
use Cake\I18n\FrozenTime;
use Cake\I18n\FrozenDate;

class ApiSunatService
{
    protected $baseUrl = 'https://back.apisunat.com/';

    protected $urlSend = '/personas/v1/sendBill';
    protected $urlVoid = '/personas/v1/voidBill';
    protected $urlLast = '/personas/lastDocument';

    protected $http;

    public function __construct()
    {
        $this->http = new Client();
    }

    public function getRucData($ruc)
    {
        try {
            $response = $this->http->get('https://api.apis.net.pe/v1/ruc?numero=' . $ruc, [
                'Authorization' => 'Bearer ' . Configure::read('SUNAT_API_KEY')
            ]);

            if ($response->isOk()) {
                $data = $response->getJson();
                if (isset($data['error'])) {
                    Log::error('SUNAT API Error: ' . $data['error']);
                    return null;
                }
                return $data;
            } else {
                Log::error('SUNAT API Request Failed: ' . $response->getStatusCode());
                return null;
            }
        } catch (\Exception $e) {
            Log::error('SUNAT API Exception: ' . $e->getMessage());
            return null;
        }
    }
}