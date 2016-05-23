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
    public function add()
    {
        $notePlan = $this->NotePlans->newEntity();
        if ($this->request->is('post')) {
            $notePlan = $this->NotePlans->patchEntity($notePlan, $this->request->data);
            if ($this->NotePlans->save($notePlan)) {
                $this->Flash->success(__('The note plan has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The note plan could not be saved. Please, try again.'));
            }
        }
        $users = $this->NotePlans->Users->find('list', ['limit' => 200]);
        $plans = $this->NotePlans->Plans->find('list', ['limit' => 200]);
        $this->set(compact('notePlan', 'users', 'plans'));
        $this->set('_serialize', ['notePlan']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Note Plan id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $notePlan = $this->NotePlans->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $notePlan = $this->NotePlans->patchEntity($notePlan, $this->request->data);
            if ($this->NotePlans->save($notePlan)) {
                $this->Flash->success(__('The note plan has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The note plan could not be saved. Please, try again.'));
            }
        }
        $users = $this->NotePlans->Users->find('list', ['limit' => 200]);
        $plans = $this->NotePlans->Plans->find('list', ['limit' => 200]);
        $this->set(compact('notePlan', 'users', 'plans'));
        $this->set('_serialize', ['notePlan']);
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
        $this->request->allowMethod(['post', 'delete']);
        $notePlan = $this->NotePlans->get($id);
        if ($this->NotePlans->delete($notePlan)) {
            $this->Flash->success(__('The note plan has been deleted.'));
        } else {
            $this->Flash->error(__('The note plan could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
