<?php
namespace App\Model\Table;

use App\Model\Entity\Administrator;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Administrators Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Users
 */
class AdministratorsTable extends Table
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

        $this->table('administrators');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER'
        ]);
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

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->existsIn(['user_id'], 'Users'));
        return $rules;
    }

    public function getAdministratorList($startDate, $endDate, $order,  $searchTerm = null)
    {
        if (is_null($startDate) || is_null($endDate) || is_null($order)) {
            $response['message'] = 'All data must be filled';
            return false;
        }
        if ($searchTerm != '' || !is_null($searchTerm)) {
            $administrators = $this->find()->contain([
                'Plans.Items' => function ($q) use($searchTerm){
                    return $q->where(['Items.description LIKE' => "%$searchTerm%"]);
                }
            ]);
            $administrators = $administrators->where(function ($exp, $q) use ($startDate, $endDate) {
                return $exp->between('User.full_name', $startDate, $endDate);
            });
            $administrators = $administrators->where(['Administrators.user_id'])
                ->order(['Users.full_name' => $order])
                ->where(function ($exp, $q) {
                    return $exp->isNull('deleted');
                });
        } else {
            $administrators = $this->find()->contain(['Users'])
            ->where(function ($exp, $q) use ($startDate, $endDate){
                return $exp->between('Users.full_name', $startDate, $endDate);
            });
            $administrators = $administrators->where(['Administrators.user_id'])
            ->order(['Users.full_name' => $order])
            ->where(function ($exp, $q) {
                return $exp->isNull('deleted');
            });
        }
        return $administrators;
    }
}
