<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * HomeWorkings Controller
 *
 * @property \App\Model\Table\HomeWorkingsTable $HomeWorkings
 */
class HomeWorkingsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    /**
     * View method
     *
     * @param string|null $id Home Working id.
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
        /*
        To Do (TODO) for tomorrow:
        I can have two home homeworking in same day?
        */
        $response = [
          'message' => '',
          'error' => false
        ];
        $homeWorking = $this->HomeWorkings->newEntity();
        if ($this->request->is('post') && $this->request->data['day_work']) {
            $userId = $this->Auth->user('id');
            $workData['user_id'] = $userId;
            $workData['state'] = 1;
            if (
                strtotime($this->request->data['day_work']) > strtotime(date('Y-m-d')) &&
                !$this->HomeWorkings->hasThisWeek($this->Auth->user('id'), $this->request->data['day_work'])
            ) {
                $workData['day_work'] = $this->request->data['day_work'];
                $homeWorking = $this->HomeWorkings->patchEntity($homeWorking, $workData);
                if ($this->HomeWorkings->save($homeWorking)) {
                    $response['message'] = 'The home working has been saved.';
                    $response['homeWorking'] = $homeWorking;
                    $this->set(compact('response'));
                    return;
                }
            }
            $response['message'] = 'The home working could not be saved. Please, try again.';
            $response['error'] = true;
            $this->set(compact('response'));
            return;
        }
    }
    /**
     * Edit method
     *
     * @param string|null $id Home Working id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id)
    {

        // this is a return variable
        $response = [
          'message' => '',
          'error' => false
        ];
        if ($this->request->is(['put'])) {
            if($this->Auth->user('role') == 1) {
                if($this->request->data['state'] && $this->request->data['day_work']) {
                    $homeWorking = $this->HomeWorkings->get($id);
                    if(strtotime($this->request->data['day_work']) >= strtotime(date('Y-m-d'))) {
                        $homeWorking->day_work = $this->request->data['day_work'];
                        $homeWorking->state = $this->request->data['state'];
                        if ($this->HomeWorkings->save($homeWorking)) {
                            $response['message'] = 'The home working has been saved.';
                            $response['homeWorking'] = $homeWorking;
                            $this->set(compact('response'));
                            return;
                        } else {
                            $response['message'] = "This Home Work can't be saved";
                        }
                    } else {
                        $response['message'] = 'No meet the requirements';
                    }
                } else {
                    $response['message'] = 'Day work is required';
                }
                $response['error'] = true;
                $this->set(compact('response'));
                return;
            }
            if($this->Auth->user('role') == 2) {
                if($this->request->data['day_work']) {
                    $homeWorking = $this->HomeWorkings->get($id);
                    if(
                        $homeWorking->user_id == $this->Auth->user('id')  &&
                        strtotime($this->request->data['day_work']) >= strtotime(date('Y-m-d')) &&
                        $homeWorking->state == 1
                    ) {
                        $homeWorking->day_work = $this->request->data['day_work'];
                        if ($this->HomeWorkings->save($homeWorking)) {
                            $response['message'] = 'The home working has been saved.';
                            $response['homeWorking'] = $homeWorking;
                            $this->set(compact('response'));
                            return;
                        } else {
                            $response['message'] = "This Home Work can't be saved";
                        }
                    } else {
                        $response['message'] = 'No meet the requirements';
                    }
                } else {
                    $response['message'] = 'Day work is required';
                }
                $response['error'] = true;
                $this->set(compact('response'));
                return;
            }
            $response['message'] = 'Only Administrators and Employees can be change this home work';
            $response['error'] = true;
            $this->set(compact('response'));
            return;
        }
    }
    /**
     * Delete method
     *
     * @param string|null $id Home Working id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        // this is a return variable
        $response = [
          'message' => '',
          'error' => false
        ];
        if ($this->request->is(['put'])) {
            $homeWorking = $this->HomeWorkings->get($id);
            if ($homeWorking->user_id == $this->Auth->user('id')) {
                $homeWorking->deleted = date('Y-m-d H:i:s');
                if ($this->HomeWorkings->save($homeWorking)) {
                    $response['message'] = 'The home working has been deleted.';
                    $response['homeWorking'] = $homeWorking;
                    $this->set(compact('response'));
                    return;
                }
            }
        }
        $response['message'] = 'The home working could not be deleted. Please, try again.';
        $response['error'] = true;
        $this->set(compact('response'));
        return;
    }

    public function homeWork() { 
        $response = [
          'message' => '',
          'error' => false
        ];
        $Id = $this->Auth->user('id');
        $homeWorking = $this->HomeWorkings->getByCurrentUser($Id);
        if($homeWorking) {
            $response['message'] = 'It home workings.';
            $response['homeWorking'] = $homeWorking;
            $this->set(compact('response'));
            return;
        }
        if (!$homeWorking)  {
            $response['message'] = 'It has no home workings';
            $this->set(compact('response'));
            return;
        }
    }
}
