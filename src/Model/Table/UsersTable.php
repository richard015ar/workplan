<?php
namespace App\Model\Table;

use App\Model\Entity\User;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\Event\Event;
use Cake\Auth\DefaultPasswordHasher;
use Cake\Utility\Text;

/**
 * Users Model
 *
 * @property \Cake\ORM\Association\HasMany $Administrators
 * @property \Cake\ORM\Association\HasMany $Employees
 * @property \Cake\ORM\Association\HasMany $NoteEmployees
 * @property \Cake\ORM\Association\HasMany $NoteItems
 * @property \Cake\ORM\Association\HasMany $NotePlans
 */
class UsersTable extends Table
{
    /**
    Before save action
    */
    public function beforeSave(Event $event)
    {
        $entity = $event->data['entity'];

        if ($entity->isNew()) {
            $hasher = new DefaultPasswordHasher();

            // Generate an API 'token'
            $entity->api_key_plain = sha1(Text::uuid());

            // Bcrypt the token so BasicAuthenticate can check
            // it during login.
            $entity->api_key = $hasher->hash($entity->api_key_plain);
        }
        return true;
    }
    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->table('users');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->hasMany('Administrators', [
            'foreignKey' => 'user_id'
        ]);
        $this->hasMany('Employees', [
            'foreignKey' => 'user_id'
        ]);
        $this->hasMany('NoteEmployees', [
            'foreignKey' => 'user_id'
        ]);
        $this->hasMany('NoteItems', [
            'foreignKey' => 'user_id'
        ]);
        $this->hasMany('NotePlans', [
            'foreignKey' => 'user_id'
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
            ->requirePresence('username', 'create')
            ->notEmpty('username');

        $validator
            ->requirePresence('password', 'create')
            ->notEmpty('password');

        $validator
            ->email('email')
            ->requirePresence('email', 'create')
            ->notEmpty('email');

        $validator
            ->dateTime('last_login')
            ->requirePresence('last_login', 'create')
            ->notEmpty('last_login');

        $validator
            ->requirePresence('full_name', 'create')
            ->notEmpty('full_name');

        $validator
            ->notEmpty('role', 'A role is required')
            ->add('role', 'inList', [
                'rule' => ['inList', [1, 2]], // 1 = Admin role, 2 =  Employee role
                'message' => 'Please enter a valid role'
            ]);

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
        $rules->add($rules->isUnique(['username']));
        $rules->add($rules->isUnique(['email']));
        return $rules;
    }

    /*
    This function get a User by Username and Password (plain)
    */
    public function getUserByUsernameAndPassword($username, $password) {
        if (is_null($username) || is_null($password)) {
            return false;
        }
        $user = $this->find()
                ->where(['Users.username' => $username]);
        $user = $user->toArray();
        if ((new DefaultPasswordHasher)->check($password, $user[0]->password)) {
            return $user;
        }
        return false;
    }

}
