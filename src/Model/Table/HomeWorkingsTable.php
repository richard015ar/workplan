<?php
namespace App\Model\Table;

use App\Model\Entity\HomeWorking;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * HomeWorkings Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Users
 */
class HomeWorkingsTable extends Table
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

        $this->table('home_workings');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER'
        ]);
    }

    /**
    * This user have a home working this week?
    */
    public function hasThisWeek($userId, $day_work) {
        $weekDayWork = strtotime($day_work);
        $weekDayWork = date('W', $weekDayWork);
        $hw = $this->find()->where(['WEEK(HomeWorkings.day_work)' => $weekDayWork]);
        $hw = $hw->select(['count' => $hw->func()->count('*')]);

        $hw = $hw->toArray();
        if ($hw[0]->count > 0) {
            return true;
        }
        return false;
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
            //->notEmpty('state', 'A state is required');
            //->add('state', 'inList', [
            //    'rule' => ['inList', [1, 2, 3]], // 1 = pendiente , 2 = Aprovado , 3 = rechazado
            //    'message' => 'Please enter a valid state'
            //]);

        $validator
            ->dateTime('day_work')
            ->requirePresence('day_work', 'create')
            ->notEmpty('day_work');

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

    public function getByCurrentUser($Id) {
        $homeWorking = $this->find()
        ->where(['HomeWorkings.user_id' => $Id])
        ->andWhere(['HomeWorkings.day_work > NOW()']);
        return $homeWorking;
    }
}
