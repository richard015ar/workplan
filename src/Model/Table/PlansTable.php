<?php
namespace App\Model\Table;

use App\Model\Entity\Plan;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Plans Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Employees
 * @property \Cake\ORM\Association\HasMany $Items
 * @property \Cake\ORM\Association\HasMany $NotePlans
 */
class PlansTable extends Table
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

        $this->table('plans');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Employees', [
            'foreignKey' => 'employee_id',
            'joinType' => 'INNER'
        ]);
        $this->hasMany('Items', [
            'foreignKey' => 'plan_id'
        ]);
        $this->hasMany('NotePlans', [
            'foreignKey' => 'plan_id'
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

        $validator
            ->integer('state')
            ->requirePresence('state', 'create')
            ->notEmpty('state');

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
        $rules->add($rules->existsIn(['employee_id'], 'Employees'));
        return $rules;
    }

    /*
    A list of plans by employee ID. We need a start/end dates, and a order
    for return a result list.
    A search term can be null.
    * @param startDate DateTime string
    * @param endDate DateTime string
    * @param order String. This can be 'ASC' or 'DESC'
    * @param searchTerm String. Term for search a 'description' field of Item entity
    * @param employeeId Integer. 'employee_id' field of Employee Entity.
    */
    public function getPlansByEmployeeId($startDate, $endDate, $order, $searchTerm = null, $employeeId, $deleted)
    {
        if (is_null($startDate) || is_null($endDate) || is_null($order) || is_null($employeeId)) {
            $response['message'] = 'All data must be filled';
            return false;
        }
        if ($searchTerm != '' || !is_null($searchTerm)) {
                $plans = $this->find()
                ->contain(['Items.NoteItems', 'NotePlans', 'Items'])
                ->matching('Items', function ($q) use($searchTerm) {
                    return $q->where(['Items.description LIKE' => "%$searchTerm%"]);
                }
            );
                $plans = $plans->where(function ($exp, $q) use ($startDate, $endDate){
                    return $exp->between('Plans.created', $startDate, $endDate);
                });
                $plans = $plans->select(['id', 'state', 'created']);
                $plans = $plans->where(['Plans.employee_id' => $employeeId]);
                $plans = $plans->order(['Plans.created' => $order]);
        } else {
                $plans = $this->find();
                $plans = $plans->contain(['Items.NoteItems', 'NotePlans', 'Items']);
                $plans = $plans->where(function ($exp, $q) use ($startDate, $endDate){
                    return $exp->between('Plans.created', $startDate, $endDate);
                });
                $plans = $plans->select(['id', 'state', 'created']);
                $plans = $plans->where(['Plans.employee_id' => $employeeId]);
                $plans = $plans->order(['Plans.created' => $order]);
                           }
        if(!$deleted) {
                $plans = $plans->contain(['Items.NoteItems' => function ($q) {
                      return $q->where(function ($exp, $q) {
                    return $exp->isNull('deleted');
                                });
                            }
                        ]);
                $plans = $plans->contain(['NotePlans' => function ($q) {
                      return $q->where(function ($exp, $q) {
                    return $exp->isNull('NotePlans.deleted');
                            });
                        }
                    ]);
                $plans = $plans->contain(['Items' => function ($q) {
                      return $q->where(function ($exp, $q) {
                    return $exp->isNull('Items.deleted');
                            });
                        }
                    ]);
                $plans = $plans->where(function ($exp, $q) {
                    return $exp->isNull('Plans.deleted');
                                });
                      }
                      return $plans;
    }

    public function getPlans($startDate, $endDate, $order, $searchTerm = null, $deleted, $state = null)
    {
        if (is_null($startDate) || is_null($endDate) || is_null($order)) {
            $response['message'] = 'All data must be filled';
            return false;
        }
        if ($searchTerm != '' || !is_null($searchTerm)) {
                $plans = $this->find()
                                ->contain(['Items'])
                                ->matching(
                                    'Items',
                                    function ($q) use($searchTerm) {
                                    	return $q->where(['Items.description LIKE' => "%$searchTerm%"]);
                                    }
                                );
                $plans = $plans->where(function ($exp, $q) use ($startDate, $endDate){
                    return $exp->between('Plans.created', $startDate, $endDate);
                });
                $plans = $plans->select(['id', 'state', 'created']);
                $plans = $plans->order(['Plans.created' => $order]);
        } else {
                $plans = $this->find()->contain(['Items']);
                $plans = $plans->where(function ($exp, $q) use ($startDate, $endDate){
                    return $exp->between('Plans.created', $startDate, $endDate);
                });
                $plans = $plans->select(['id', 'state', 'created']);
                $plans = $plans->order(['Plans.created' => $order]);
            }
        if(!$deleted) {
            $plans = $plans->where(function ($exp, $q) {
                        return $exp->isNull('Plans.deleted');
                    });
        }
        if (!is_null($state)) {
            $state = intval($state);
            $plans = $plans->where(['Plans.state' => $state]);
            $plans = $plans->select(['id', 'state', 'created']);
        }
       return $plans;

    }
//It function find open plans of logged user.
    public function getPlanOpenByEmployee($employeeId) {
        $plan = $this->find()
        ->select(['id', 'state', 'created'])
        ->where(function ($exp, $q) {
            return $exp->isNull('Plans.deleted');
        })
        ->andWhere(['state =' => 1])
        ->andWhere(['Plans.employee_id' => $employeeId]);
        return $plan;
    }
}
