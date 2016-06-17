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

    public function getEmployeeList($startDate, $endDate, $order,  $searchTerm = null, $deleted)
    {
        if (is_null($startDate) || is_null($endDate) || is_null($order)) {
            $response['message'] = 'All data must be filled';
            return false;
        } 
        if ($searchTerm != '' || !is_null($searchTerm)) {
            $employee = $this->find()->matching('Users' , function ($q) use($searchTerm){
                return $q->where(['Users.full_name LIKE' => "%$searchTerm%"]);
            });
            $employee = $employee->where(function ($exp, $q) use ($startDate, $endDate){
                return $exp->between('Users.created', $startDate, $endDate);
            });
            $employee = $employee->where(['Employees.user_id']);
            $employee = $employee->select(['Employees.id', 'Users.full_name', 'Users.username', 'Users.id', 'Users.created', 'Users.email']);
            $employee = $employee->order(['Users.full_name' => $order]);
        } else {
            $employee = $this->find()->contain(['Users']);
            $employee = $employee->where(function ($exp, $q) use ($startDate, $endDate){
                return $exp->between('Users.created', $startDate, $endDate);
            });
            $employee = $employee->where(['Employees.user_id']);
            $employee = $employee->select(['Employees.id', 'Users.full_name', 'Users.username', 'Users.id', 'Users.created', 'Users.email']);
            $employee = $employee->order(['Users.full_name' => $order]);
        }
        if(!$deleted) {
            $employee = $employee->where(function ($exp, $q) {
                return $exp->isNull('Users.deleted');
            });
        }
        return $employee;
    }
}
