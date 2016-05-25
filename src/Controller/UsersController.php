<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;
use Cake\Network\Exception\NotFoundException;


/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 */
class UsersController extends AppController
{
    public function beforeFilter(Event $event)
    {
       parent::beforeFilter($event);
       $this->Auth->allow(['add', 'logout', 'login']);
    }

    public function login()
    {
        $response = [
          'message' => '',
          'error' => false
        ];
        if ($this->request->is('post')) {
            // $user = $this->Auth->identify();
            $username = $this->request->data['username'];
            $password = $this->request->data['password'];
            $realUser = $this->Users->getUserByUsernameAndPassword($username, $password);
            if ($realUser) {
                $this->Auth->setUser($realUser);
                $response['message'] = 'User identified';
                $response['user'] = $realUser;
                $this->set(compact('response'));
                return;
            }
            $response['message'] = 'Invalid username or password, try again';
            $response['error'] = true;
            $this->set(compact('response'));
        }
    }

    public function logout()
    {
        $this->Auth->logout();
        return $this->redirect($this->Auth->logout());
    }

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $users = $this->paginate($this->Users);

        $this->set(compact('users'));
        //$this->set('_serialize', ['users']);
    }

    /**
     * View method
     *
     * @param string|null $id User id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $user = $this->Users->get($id, [
            'contain' => ['Administrators', 'Employees', 'NoteEmployees', 'NoteItems', 'NotePlans']
        ]);

        $this->set('user', $user);
        $this->set('_serialize', ['user']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
      // this is a return variable
      $response = [
        'message' => '',
        'error' => false
      ];
      $user = $this->Users->newEntity();
      if ($this->request->is('post')) {
          $this->request->data['role'] = intval($this->request->data['role']);

        // Creating entities
        $employee = $this->Users->Employees->newEntity();
        $administrator = $this->Users->Administrators->newEntity();
        $user = $this->Users->patchEntity($user, $this->request->data);
        if ($this->Users->save($user)) {
            $response['user'] = $user;
            if ($this->request->data['role'] == 1) {
                $administratorData['user_id'] = $user->id;
                $administrator = $this->Users->Administrators->patchEntity($administrator, $administratorData);
                if ($this->Users->Administrators->save($administrator)) {
                    $response['message'] = 'The user has been saved.';
                    $response['administrator'] = $administrator;
                    $this->set(compact('response'));
                    return;
                }
              }
              if ($this->request->data['role'] == 2) {
                $employeeData['user_id'] = $user->id;
                $employeeData['charge'] = 'Developer';
                $employee = $this->Users->Employees->patchEntity($employee, $employeeData);
                //debug($employee);
                if ($this->Users->Employees->save($employee)) {
                    $response['message'] = 'The user has been saved.';
                    $response['employee'] = $employee;
                    $this->set(compact('response'));
                    return;
                }
              }
            }
            $response['error'] = true;
            $response['message'] = 'Error saving user';
            $this->set(compact('response'));
            return;
        }
    }

    /**
     * Edit method
     *
     * @param string|null $id User id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $user = $this->Users->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $user = $this->Users->patchEntity($user, $this->request->data);
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The user could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('user'));
        $this->set('_serialize', ['user']);
    }

    /**
     * Delete method
     *
     * @param string|null $id User id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $user = $this->Users->get($id);
        if ($this->Users->delete($user)) {
            $this->Flash->success(__('The user has been deleted.'));
        } else {
            $this->Flash->error(__('The user could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
