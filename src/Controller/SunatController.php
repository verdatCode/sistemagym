<?php

namespace App\Controller;

use App\Config\Sunat\Boletas;
use App\Controller\AppController;
use App\Service\ApiSunatService;
use App\config\sunat\facturas;
use Cake\Http\Client;
use Cake\Log\Log;

/**
 * Sunat Controller
 *
 *
 * @method \App\Model\Entity\Sunat[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class SunatController extends AppController
{
    //injection dependency service ApiSunatService
    protected $apiSunatService;
    protected $boleta = "03";
    protected $factura = "01";
    protected $serieFactura = "F001";
    protected $serieBoleta = "B001";


    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $sunat = $this->paginate($this->Sunat);

        $this->set(compact('sunat'));
    }

    public function boleta()
    {
        $data = $this->lastDocument($this->boleta, $this->serieBoleta);
        $data = $data['data'] ?? [];

        $dataserie = $data['serie'] ?? '';
        $datasuggestedNumber = $data['suggestedNumber'] ?? '';


        $this->set(compact('dataserie', 'datasuggestedNumber'));

           if ($this->request->is('post')) {
            return $this->saveInvoiceBoleta();
        }
    }
    public function factura()

    {
        $data = $this->lastDocument($this->factura, $this->serieFactura);
        $data = $data['data'] ?? [];
       
        $dataserie = $data['serie'] ?? '';
        $datasuggestedNumber = $data['suggestedNumber'] ?? '';
         

        $this->set(compact('dataserie', 'datasuggestedNumber'));

         if ($this->request->is('post')) {
            return $this->saveInvoice();
        }
    }

    public function saveInvoice()
     {

        Log::error("llego aqui");
        $data = $this->request->getData();
        $data = $this->dataStructure($data);
        $data = $this->estructureFactura($data);
       $data = $this->sendDocument($data);
        Log::error($data);
    }

    public function saveInvoiceBoleta()
    {

        Log::error("llego aqui boleta");
        $data = $this->request->getData();
        $data = $this->dataStructure($data);
        $data = $this->estructureBoleta($data);
        $data = $this->sendDocument($data);
        Log::error($data);
    }




    protected function lastDocument($typeDocument, $serieDocument)
    {
        $http = new Client();
        $apiSunat = new ApiSunatService($http);
        $consultFactura = [
            "type" => $typeDocument,
            "serie" => $serieDocument
        ];
        return   $apiSunat->lastDocument($consultFactura);
    }
    protected function sendDocument($data)
    {
        $http = new Client();
        $apiSunat = new ApiSunatService($http);
        $consultFactura = $data;
        return   $apiSunat->sendBill($consultFactura);
    }

    protected function estructureFactura(array $data): array
    {
        $facturasunat = new facturas();
        $estructureFactua = $facturasunat->FacturaEstructuraData($data);
        return $estructureFactua;
    }

    public function estructureBoleta(array $data): array
    {
        $boletasunat = new Boletas();
        $estructureFactua = $boletasunat->BoletaEstructuraData($data);
        return $estructureFactua;
    }

  


    protected function dataStructure(array $array): array
    {
       
        $structure = [];
        $structure['idfactura'] = $array['serie'] ."-".$array['idserie'];
        $structure['note'] = $array['nota'] ?? '';
        $structure['rucCliente'] = $array['numDoc'] ?? '';
        $structure['razonSocialCliente'] = $array['cliente'] ?? '';
        $structure['direccionCliente'] = $array['direccion'] ?? '';
        $structure['note'] = $array['nota'] ?? '';
        $structure['totalPrice'] = $array['subtotal'] ;
        $structure['totalIgvPrice'] = $array['igv_total'] ;
        $structure['typedocument'] = $array['tipoDoc'] ?? 'RUC';
        $structure['PaymentMeansID'] = $array['PaymentMeansID'] ?? 'Contado';
        
        foreach (json_decode($array['items'], true) as $item) {
            $structure['items'][] = [
                'quantity' => $item['cantidad'],
                'descripcion' => $item['descripcion'],
                'price' => $item['precio_base'],
                'subtotal' => $item['subtotal'],
                'igv_amount' => $item['igv_amount'],
                'total' => $item['total'],
                'aplica_igv' => $item['aplica_igv'],
            ];
        }

        return $structure;
    }

}
