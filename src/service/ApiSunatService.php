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
    protected $urlSend = 'personas/v1/sendBill';
    protected $urlVoid = 'personas/v1/voidBill';
    protected $urlLast = 'personas/lastDocument';

    protected $arrayDataBase = [
        "personaId" => "68d473f06f3f920015e5c150",
        "personaToken" => "DEV_ow7aAKeN93foy60Oc22DpEla28xJInnwffonkPKj4s6xxxY2OAFZVbs79HtM2lAt"
    ];

    protected Client $http;

    public function __construct(Client $http)
    {
        $this->http = $http;
    }

    public function sendRequest(string $path, array $params = [], string $method = 'GET')
    {
        try {
            $url = $this->baseUrl . ltrim($path, '/');

            switch (strtoupper($method)) {
                case 'POST':
                    $response = $this->http->post($url, $params, [
                        'headers' => [
                            'Authorization' => 'Bearer ' . Configure::read('SUNAT_API_KEY')
                        ]
                    ]);
                    break;

                case 'PUT':
                    $response = $this->http->put($url, $params, [
                        'headers' => [
                            'Authorization' => 'Bearer ' . Configure::read('SUNAT_API_KEY')
                        ]
                    ]);
                    break;

                case 'DELETE':
                    $response = $this->http->delete($url, $params, [
                        'headers' => [
                            'Authorization' => 'Bearer ' . Configure::read('SUNAT_API_KEY')
                        ]
                    ]);
                    break;

                default: // GET
                    $response = $this->http->get($url, $params, [
                        'headers' => [
                            'Authorization' => 'Bearer ' . Configure::read('SUNAT_API_KEY')
                        ]
                    ]);
            }
            if ($response->isOk()) {
                return $response->getJson();
            }

            Log::error('SUNAT API Request Failed: ' . $response->getStatusCode());
            return null;
        } catch (\Exception $e) {
            Log::error('SUNAT API Exception: ' . $e->getMessage());
            return null;
        }
    }


    public function lastDocument($params)
    {
        $params = array_merge($this->arrayDataBase, $params);

        $response =  $this->sendRequest($this->urlLast, $params, 'POST');
        Log::info('SUNAT API Last Document Response: ' . json_encode($response));

        if (empty($response) || !is_array($response)) {
           return  [
                'success' => false,
                'message' => 'Error desconocido al obtener el último documento. Last Document'
            ];
        }

        return [
            'success' => true,
            'data' => $response
        ];

    }

    public function sendBill( $body)
    {
        $params = array_merge($this->arrayDataBase, $body);
        
        $response =  $this->sendRequest($this->urlSend, $params, 'POST');


        Log::info('SUNAT API Send Bill Request: ' . json_encode($params));

       // Log::info('SUNAT API Send Bill Response: ' . json_encode($response));

        if (empty($response) || !is_array($response)) {
           return  [
                'success' => false,
                'message' => 'Error desconocido al enviar el comprobante. Send Bill'
            ];
        }

        if (isset($response['errors'])) {
            return [
                'success' => false,
                'message' => 'Error al enviar el comprobante: ' . implode(', ', $response['errors'])
            ];
        }

        return [
            'success' => true,
            'data' => $response
        ];
    }
}
