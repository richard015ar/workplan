<?php
namespace App\Model\Table;

use App\Model\Entity\Config;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Configs Model
 *
 */
class ConfigsTable extends Table
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

        $this->table('configs');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');
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
            ->allowEmpty('id', 'create');

        $validator
            ->dateTime('time_start')
            ->requirePresence('time_start', 'create')
            ->notEmpty('time_start');

        $validator
            ->dateTime('time_end')
            ->requirePresence('time_end', 'create')
            ->notEmpty('time_end');

        return $validator;
    }
}
