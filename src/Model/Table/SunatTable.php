<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Sunat Model
 *
 * @method \App\Model\Entity\Sunat get($primaryKey, $options = [])
 * @method \App\Model\Entity\Sunat newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Sunat[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Sunat|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Sunat saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Sunat patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Sunat[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Sunat findOrCreate($search, callable $callback = null, $options = [])
 */
class SunatTable extends Table
{
    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('sunat');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->integer('id')
            ->allowEmptyString('id', null, 'create');

        $validator
            ->scalar('serie')
            ->maxLength('serie', 20)
            ->requirePresence('serie', 'create')
            ->notEmptyString('serie');

        $validator
            ->integer('correlativo')
            ->requirePresence('correlativo', 'create')
            ->notEmptyString('correlativo');

        $validator
            ->scalar('respuesta_sunat')
            ->allowEmptyString('respuesta_sunat');

        $validator
            ->scalar('estado_envio')
            ->maxLength('estado_envio', 50)
            ->allowEmptyString('estado_envio');

        $validator
            ->scalar('json')
            ->allowEmptyString('json');

        $validator
            ->scalar('pdfurl')
            ->maxLength('pdfurl', 255)
            ->allowEmptyString('pdfurl');

        return $validator;
    }
}
