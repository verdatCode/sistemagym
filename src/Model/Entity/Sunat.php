<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Sunat Entity
 *
 * @property int $id
 * @property string $serie
 * @property int $correlativo
 * @property string|null $respuesta_sunat
 * @property string|null $estado_envio
 * @property string|null $json
 * @property string|null $pdfurl
 */
class Sunat extends Entity
{
    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        'serie' => true,
        'correlativo' => true,
        'respuesta_sunat' => true,
        'estado_envio' => true,
        'json' => true,
        'pdfurl' => true,
    ];
}
