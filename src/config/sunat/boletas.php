<?php

namespace App\Config\Sunat;

use Cake\Log\Log;

class Boletas
{
    // Constantes de configuración SUNAT
    const TIPO_COMPROBANTE = '03'; // Código para boleta
    const TIPO_DOCUMENTO_RUC = '6'; // Código para RUC
    const TIPO_DOCUMENTO_DNI = '1'; // Código para DNI

    const MONEDA = 'PEN'; // Moneda en soles
    const TIPO_OPERACION = '0101'; // Venta de bienes muebles
    const IGV_RATE = 0.18; // 18% IGV
    const CODIGO_AFECTACION_IGV = '10'; // Gravado - Operación Onerosa

    // Datos del emisor (empresa)
    const EMPRESA_RUC = '10412857955';
    const EMPRESA_RAZON_SOCIAL = 'MONSEFU LOZANO GLORIA CONSUELO';

    /**
     * Genera la estructura completa de datos para una factura electrónica SUNAT
     * 
     * @param array $data Datos de la factura
     *   - idfactura: ID de la factura (ej: F001-00000001)
     *   - note: Nota opcional
     *   - rucCliente: RUC del cliente
     *   - razonSocialCliente: Razón social del cliente
     *   - direccionCliente: Dirección del cliente
     *   - PaymentMeansID: Forma de pago (Contado/Credito)
     *   - items: Array de items con [quantity, price, descripcion, subtotal, igv_amount]
     *   - totalPrice: Monto total sin IGV
     *   - totalIgvPrice: Monto total de IGV
     *   
     * @return array Estructura de datos UBL para SUNAT
     */
    public function boletaEstructuraData(array $data): array
    {
        Log::info("Generando estructura de boleta: " . $data['idfactura']);

        return [
            "fileName" => self::EMPRESA_RUC . "-" . self::TIPO_COMPROBANTE . "-" . $data['idfactura'],
            "documentBody" => [
                "cbc:UBLVersionID" => [
                    "_text" => "2.1"
                ],
                "cbc:CustomizationID" => [
                    "_text" => "2.0"
                ],
                "cbc:ID" => [
                    "_text" => $data['idfactura']
                ],
                "cbc:IssueDate" => [
                    "_text" => date("Y-m-d")
                ],
                "cbc:IssueTime" => [
                    "_text" => date("H:i:s")
                ],
                "cbc:InvoiceTypeCode" => [
                    "_attributes" => [
                        "listID" => self::TIPO_OPERACION
                    ],
                    "_text" => self::TIPO_COMPROBANTE
                ],

                "cbc:Note" => [
                    [
                        "_text" => $data['note'] ?? 'SIN NOTA'
                    ]
                ],
                "cbc:DocumentCurrencyCode" => [
                    "_text" => self::MONEDA
                ],
                "cac:AccountingSupplierParty" => [
                    "cac:Party" => [
                        "cac:PartyIdentification" => [
                            "cbc:ID" => [
                                "_attributes" => [
                                    "schemeID" => self::TIPO_DOCUMENTO_RUC
                                ],
                                "_text" => self::EMPRESA_RUC
                            ]
                        ],
                        "cac:PartyLegalEntity" => [
                            "cbc:RegistrationName" => [
                                "_text" => self::EMPRESA_RAZON_SOCIAL
                            ],
                            "cac:RegistrationAddress" => [
                                "cbc:AddressTypeCode" => [
                                    "_text" => "0000"
                                ]
                            ]
                        ]
                    ]
                ],
                "cac:AccountingCustomerParty" => [
                    "cac:Party" => [
                        "cac:PartyIdentification" => [
                            "cbc:ID" => [
                                "_attributes" => [
                                    "schemeID" => $data['typedocument'] == "RUC" ? self::TIPO_DOCUMENTO_RUC : self::TIPO_DOCUMENTO_DNI
                                ],
                                "_text" => $data['rucCliente'] //asi se debe de mandar la info 
                            ]
                        ],
                        "cac:PartyLegalEntity" => [
                            "cbc:RegistrationName" => [
                                "_text" => $data['razonSocialCliente'] //asi se debe de mandar la info 
                            ],
                            "cac:RegistrationAddress" => [
                                "cac:AddressLine" => [
                                    "cbc:Line" => [
                                        "_text" => $data['direccionCliente'] //asi se debe de mandar la info 
                                    ]
                                ]
                            ]
                        ]
                    ]
                ],
                "cac:TaxTotal" => 
                    self::estructuraTaxTotal($data)
                ,
                "cac:LegalMonetaryTotal" => 
                    self::estructuraLegalMonetaryTotal($data)
                ,
                "cac:PaymentTerms" => [
                    [
                        "cbc:ID" => [
                            "_text" => "FormaPago"
                        ],
                        "cbc:PaymentMeansID" => [
                            "_text" => $data['PaymentMeansID']
                        ]
                    ]
                ],
                "cac:InvoiceLine" => 
                    self::estructuraItems($data['items'])
                
            ]
        ];
    }

    /**
     * Genera la estructura de items de la factura
     * 
     * @param array $items Array de items con quantity, price, descripcion, subtotal, igv_amount
     * @return array Estructura de InvoiceLines
     */
    private function estructuraItems(array $items): array
    {
        $invoiceLines = [];

        foreach ($items as $index => $item) {
            $quantity = $item['quantity'];
            $precioUnitarioSinIgv = $item['price'];
            $precioUnitarioConIgv = round($precioUnitarioSinIgv * (1 + self::IGV_RATE), 2);
            $subtotal = $item['subtotal'];
            $igvItem = $item['igv_amount'];

            $invoiceLines[] = [
                "cbc:ID" => [
                    "_text" => $index + 1
                ],
                "cbc:InvoicedQuantity" => [
                    "_attributes" => [
                        "unitCode" => "NIU" // Unidad: NIU (Número de items)
                    ],
                    "_text" => $quantity
                ],
                "cbc:LineExtensionAmount" => [
                    "_attributes" => [
                        "currencyID" => self::MONEDA
                    ],
                    "_text" => number_format($subtotal, 2, '.', '')
                ],
                "cac:PricingReference" => [
                    "cac:AlternativeConditionPrice" => [
                        "cbc:PriceAmount" => [
                            "_attributes" => [
                                "currencyID" => self::MONEDA
                            ],
                            "_text" => number_format($precioUnitarioConIgv, 2, '.', '')
                        ],
                        "cbc:PriceTypeCode" => [
                            "_text" => "01" // Precio unitario incluye IGV
                        ]
                    ]
                ],
                "cac:TaxTotal" => [
                    "cbc:TaxAmount" => [
                        "_attributes" => [
                            "currencyID" => self::MONEDA
                        ],
                        "_text" => number_format($igvItem, 2, '.', '')
                    ],
                    "cac:TaxSubtotal" => [
                        [
                            "cbc:TaxableAmount" => [
                                "_attributes" => [
                                    "currencyID" => self::MONEDA
                                ],
                                "_text" => number_format($subtotal, 2, '.', '')
                            ],
                            "cbc:TaxAmount" => [
                                "_attributes" => [
                                    "currencyID" => self::MONEDA
                                ],
                                "_text" => number_format($igvItem, 2, '.', '')
                            ],
                            "cac:TaxCategory" => [
                                "cbc:Percent" => [
                                    "_text" => "18"
                                ],
                                "cbc:TaxExemptionReasonCode" => [
                                    "_text" => self::CODIGO_AFECTACION_IGV
                                ],
                                "cac:TaxScheme" => [
                                    "cbc:ID" => [
                                        "_text" => "1000"
                                    ],
                                    "cbc:Name" => [
                                        "_text" => "IGV"
                                    ],
                                    "cbc:TaxTypeCode" => [
                                        "_text" => "VAT"
                                    ]
                                ]
                            ]
                        ]
                    ]
                ],
                "cac:Item" => [
                    "cbc:Description" => [
                        "_text" => $item['descripcion']
                    ]
                ],
                "cac:Price" => [
                    "cbc:PriceAmount" => [
                        "_attributes" => [
                            "currencyID" => self::MONEDA
                        ],
                        "_text" => number_format($precioUnitarioSinIgv, 2, '.', '')
                    ]
                ]
            ];
        }

        return $invoiceLines;
    }

    /**
     * Genera la estructura de totales de impuestos
     * 
     * @param array $data Datos con totalPrice y totalIgvPrice
     * @return array Estructura TaxTotal
     */
    private function estructuraTaxTotal(array $data): array
    {
        $totalSinIgv = $data['totalPrice'];
        $totalIgv = $data['totalIgvPrice'];

        return [
            "cbc:TaxAmount" => [
                "_attributes" => [
                    "currencyID" => self::MONEDA
                ],
                "_text" => number_format($totalIgv, 2, '.', '')
            ],
            "cac:TaxSubtotal" => [
                [
                    "cbc:TaxableAmount" => [
                        "_attributes" => [
                            "currencyID" => self::MONEDA
                        ],
                        "_text" => number_format($totalSinIgv, 2, '.', '')
                    ],
                    "cbc:TaxAmount" => [
                        "_attributes" => [
                            "currencyID" => self::MONEDA
                        ],
                        "_text" => number_format($totalIgv, 2, '.', '')
                    ],
                    "cac:TaxCategory" => [
                        "cac:TaxScheme" => [
                            "cbc:ID" => [
                                "_text" => "1000"
                            ],
                            "cbc:Name" => [
                                "_text" => "IGV"
                            ],
                            "cbc:TaxTypeCode" => [
                                "_text" => "VAT"
                            ]
                        ]
                    ]
                ]
            ]
        ];
    }

    /**
     * Genera la estructura de totales monetarios
     * 
     * @param array $data Datos con totalPrice y totalIgvPrice
     * @return array Estructura LegalMonetaryTotal
     */
    private function estructuraLegalMonetaryTotal(array $data): array
    {
        $totalSinIgv = $data['totalPrice'];
        $totalIgv = $data['totalIgvPrice'];
        $totalConIgv = $totalSinIgv + $totalIgv;

        return [
            "cbc:LineExtensionAmount" => [
                "_attributes" => [
                    "currencyID" => self::MONEDA
                ],
                "_text" => number_format($totalSinIgv, 2, '.', '')
            ],
            "cbc:TaxInclusiveAmount" => [
                "_attributes" => [
                    "currencyID" => self::MONEDA
                ],
                "_text" => number_format($totalConIgv, 2, '.', '')
            ],
            "cbc:PayableAmount" => [
                "_attributes" => [
                    "currencyID" => self::MONEDA
                ],
                "_text" => number_format($totalConIgv, 2, '.', '')
            ]
        ];
    }
}
 