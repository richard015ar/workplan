<?php
namespace App\Model\Table;

use App\Model\Entity\Item;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Items Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Plans
 * @property \Cake\ORM\Association\HasMany $NoteItems
 */
class ItemsTable extends Table
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

        $this->table('items');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Plans', [
            'foreignKey' => 'plan_id',
            'joinType' => 'INNER'
        ]);
        $this->hasMany('NoteItems', [
            'foreignKey' => 'item_id'
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

        $validator
            ->requirePresence('description', 'create')
            ->notEmpty('description');

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
        $rules->add($rules->existsIn(['plan_id'], 'Plans'));
        return $rules;
    }

    public function getItemsByEmployeeId($startDate, $endDate, $order, $employeeId,  $searchTerm = null, $deleted, $stateItem = null) {
        if (is_null($startDate) || is_null($endDate) || is_null($order) || is_null($employeeId)) {
            $response['message'] = 'All data must be filled';
            return false; 
        }
        if ($searchTerm != '' || !is_null($searchTerm)) {
            $items = $this->find()
                            ->matching(
                                'Plans',
                                function ($q) use($searchTerm) {
                                    return $q->where(['description LIKE' => "%$searchTerm%"]);
                                }
                            );
            $items = $items->contain(['Plans'  => function ($q) use ($employeeId) {
                 return $q->where(['Plans.employee_id' => $employeeId]);
                      }]);
            $items = $items->where(function ($exp, $q) use ($startDate, $endDate) {
                                  return $exp->between('Items.created', $startDate, $endDate);
                      });
            $items = $items->select(['id', 'state', 'description', 'created', 'plan_id']);
            $items = $items->order(['Plans.created' => $order]);
        } else {
            $items = $this->find()->contain(['Plans'  => function ($q) use ($employeeId) {
                 return $q->where(['Plans.employee_id' => $employeeId]);
                      }]);
            $items = $items->where(function ($exp, $q) use ($startDate, $endDate) {
                                 return $exp->between('Items.created', $startDate, $endDate);
                      });
            $items = $items->select(['id', 'state', 'description', 'created', 'plan_id']);
            $items = $items->order(['Plans.created' => $order]);
        }
        if(!$deleted) {
            $items = $items->where(function ($exp, $q) {
                          return $exp->isNull('Plans.deleted');
                      });
            $items = $items->where(function ($exp, $q) {
                          return $exp->isNull('Items.deleted');
                      });
        }
        if (!is_null($stateItem)) {
            $stateItem = intval($stateItem);
            $items = $items->where(['Items.state' => $stateItem]);
        }
        return $items;
    }
}
