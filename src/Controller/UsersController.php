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
            $username = $this->request->data['username'];
            $password = $this->request->data['password'];
            $realUser = $this->Users->getUserByUsernameAndPassword($username, $password);
            if(is_null($realUser[0]['deleted'])) {
                if ($realUser) {
                    $this->Auth->setUser($realUser);
                    unset($realUser[0]['api_key']);
                    unset($realUser[0]['created']);
                    unset($realUser[0]['deleted']);
                    unset($realUser[0]['modified']);
                    unset($realUser[0]['last_login']);
                    $response['message'] = 'User identified';
                    $response['user'] = $realUser;
                    $this->set(compact('response'));
                    return;
                }
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

    /**
     * View method
     *
     * @param string|null $id User id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
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
        // this is a return variable
        $response = [
          'message' => '',
          'error' => false
        ];

        if ($this->request->is(['put'])) {
            if($this->request->data['email'] && $this->request->data['full_name']) {
                $user = $this->Users->get($id);
                $user->id = intval($id);
                if($user->id == $this->Auth->user('id') || $this->Auth->user('role') == 1 ) {
                    if(isset($this->request->data['password'])) {
                        $user->password = $this->request->data['password'];
                    }
                    if ($user->email != $this->request->data['email']) {
                        $user->email = $this->request->data['email'];
                    }
                    $user->full_name = $this->request->data['full_name'];
                    $user->isNew(false);
                    if ($this->Users->save($user)) {
                        $response['message'] = 'The user has been saved.';
                        $response['user'] = $user;
                        $this->set(compact('response'));
                        return;
                    }
                    $response['message'] = 'The user cannot been saved.';
                    $response['error'] = true;
                    $this->set(compact('response'));
                    return;
                } else {
                    $response['message'] = "You don't authorized";
                    $response['error'] = true;
                    $this->set(compact('response'));
                    return;
                }
            }
            $response['message'] = 'All fields is required';
            $response['error'] = true;
            $this->set(compact('response'));
            return;
        }
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
        $response = [
          'message' => '',
          'error' => false
        ];
        if ($this->request->is(['put'])) {
            $user = $this->Users->get($id);
            if($user->id == $this->Auth->user('id') || $this->Auth->user('role') == 1 ) {
                $user->deleted = date('Y-m-d H:i:s');
                $user->api_key_plain = null;
                $user->api_key = null;
                if ($this->Users->save($user)) {
                    $response['message'] = 'The user has been deleted.';
                    $response['user'] = $user;
                    $this->set(compact('response'));
                    return;
                }
            }
        }
        $response['error'] = true;
        $response['message'] = 'The user could not be deleted. Please, try again.';
        $this->set(compact('response'));
        return;
    }

    public function search() {
        $response = [
            'error' => true,
            'message' => ''
        ];
        if($this->Auth->user('role') == 1) {
            if ($this->request->is('get')) {
                $deleted = $this->request->query('deleted');
                $search = $this->request->query('search');
                $result = $this->Users->getSearch($search, $deleted);
                $response['error'] = false;
                $response['Result'] = $result;
                $this->set(compact('response'));
                return;
            }
        }
    }
}
