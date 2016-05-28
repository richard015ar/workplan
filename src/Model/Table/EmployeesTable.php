<?php
namespace App\Model\Table;

use App\Model\Entity\Employee;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Employees Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Users
 * @property \Cake\ORM\Association\HasMany $NoteEmployees
 * @property \Cake\ORM\Association\HasMany $Plans
 */
class EmployeesTable extends Table
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

        $this->table('employees');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER'
        ]);
        $this->hasMany('NoteEmployees', [
            'foreignKey' => 'employee_id'
        ]);
        $this->hasMany('Plans', [
            'foreignKey' => 'employee_id'
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
            ->requirePresence('charge', 'create')
            ->notEmpty('charge');

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

    /*
    Return ID by User ID
    */
    public function getIdByUserId($userId) {
        $userId = intval($userId);
        if ($userId == 0) {
            return false;
        }
        $employee = $this->find()->where(['user_id' => $userId]);
        $employee = $employee->toArray();
        return $employee[0]->id;
    }

    public function getEmployeeList($startDate, $endDate, $order,  $searchTerm = null)
    {
        if (is_null($startDate) || is_null($endDate) || is_null($order)) {
            $response['message'] = 'All data must be filled';
            return false;
        }
        if ($searchTerm != '' || !is_null($searchTerm)) {
            $employee = $this->find()->contain([
                'Plans.Items' => function ($q) use($searchTerm){
                    return $q->where(['Items.description LIKE' => "%$searchTerm%"]);
                }
            ]);
            $employee = $employee->where(function ($exp, $q) use ($startDate, $endDate) {
                return $exp->between('User.full_name', $startDate, $endDate);
            });
            $employee = $employee->where(['Employees.user_id'])
            ->order(['Users.full_name' => $order]);
        } else {
            $employee = $this->find()->contain(['Users'])
            ->where(function ($exp, $q) use ($startDate, $endDate){
                return $exp->between('Users.full_name', $startDate, $endDate);
            });
            $employee = $employee->where(['Employees.user_id'])
            ->order(['Users.full_name' => $order]);
        }
        return $employee;
    }
}
