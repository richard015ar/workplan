<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * NotePlans Controller
 *
 * @property \App\Model\Table\NotePlansTable $NotePlans
 */
class NotePlansController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Users', 'Plans']
        ];
        $notePlans = $this->paginate($this->NotePlans);

        $this->set(compact('notePlans'));
        $this->set('_serialize', ['notePlans']);
    }

    /**
     * View method
     *
     * @param string|null $id Note Plan id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $notePlan = $this->NotePlans->get($id, [
            'contain' => ['Users', 'Plans']
        ]);

        $this->set('notePlan', $notePlan);
        $this->set('_serialize', ['notePlan']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    /**
     * Edit method
     *
     * @param string|null $id Note Plan id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $response = [
          'message' => '',
          'error' => false
        ];
        if ($this->request->is(['put'])) {
            if($this->request->data['note']) {
                $notePlan = $this->NotePlans->get($id);
                if($notePlan->user_id == $this->Auth->user('id')) {
                    $notePlan->note = $this->request->data['note'];
                    if ($this->NotePlans->save($notePlan)) {
                        $response['message'] = 'The note plan has been saved.';
                        $response['notePlan'] = $notePlan;
                        $this->set(compact('response'));
                        return;
                    }
                    $response['message'] = 'error. The note plan not has been saved.';
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
        }
    }

    /**
     * Delete method
     *
     * @param string|null $id Note Plan id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $response = [
          'message' => '',
          'error' => false
        ];
        $notePlan = $this->NotePlans->get($id);
        $this->request->allowMethod(['delete']);
        if($notePlan->user_id == $this->Auth->user('id')) {
            if ($this->NotePlans->delete($notePlan)) {
                $response['message'] = 'The note plan has been deleted.';
                $response['notePlan'] = $notePlan;
                $this->set(compact('response'));
                return;
            }
        }
        $response['error'] = true;
        $response['message'] = 'The note plan could not deleted. Please, try again.';
        $this->set(compact('response'));
        return;
    }

    public function addNote()
    {
        $response = [
          'message' => '',
          'error' => false
        ];
        $notePlan = $this->NotePlans->newEntity();
        if ($this->request->is('post')) {
            $userId = $this->Auth->user('id');
            $noteData['user_id'] = $userId;
            $noteData['plan_id'] = $this->request->data['plan_id'];
            $noteData['note'] = $this->request->data['note'];
            $notePlan = $this->NotePlans->patchEntity($notePlan, $noteData);
            if ($this->NotePlans->save($notePlan)) {
                $response['message'] = 'The note plan has been saved.';
                $response['notePlan'] = $notePlan;
                $this->set(compact('response'));
                return;
            }
        }
        $response['error'] = true;
        $response['message'] = 'The note plan could not be saved. Please, try again.';
        $this->set(compact('response'));
        return;
    }
}
