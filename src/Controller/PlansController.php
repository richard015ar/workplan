<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Plans Controller
 *
 * @property \App\Model\Table\PlansTable $Plans
 */
class PlansController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Employees']
        ];
        $plans = $this->paginate($this->Plans);

        $this->set(compact('plans'));
        $this->set('_serialize', ['plans']);
    }

    /**
     * View method
     *
     * @param string|null $id Plan id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $plan = $this->Plans->get($id, [
            'contain' => ['Employees', 'Items', 'NotePlans']
        ]);

        $this->set('plan', $plan);
        $this->set('_serialize', ['plan']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $plan = $this->Plans->newEntity();
        if ($this->request->is('post')) {
            $plan = $this->Plans->patchEntity($plan, $this->request->data);
            if ($this->Plans->save($plan)) {
                $this->Flash->success(__('The plan has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The plan could not be saved. Please, try again.'));
            }
        }
        $employees = $this->Plans->Employees->find('list', ['limit' => 200]);
        $this->set(compact('plan', 'employees'));
        $this->set('_serialize', ['plan']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Plan id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $plan = $this->Plans->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $plan = $this->Plans->patchEntity($plan, $this->request->data);
            if ($this->Plans->save($plan)) {
                $this->Flash->success(__('The plan has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The plan could not be saved. Please, try again.'));
            }
        }
        $employees = $this->Plans->Employees->find('list', ['limit' => 200]);
        $this->set(compact('plan', 'employees'));
        $this->set('_serialize', ['plan']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Plan id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $plan = $this->Plans->get($id);
        if ($this->Plans->delete($plan)) {
            $this->Flash->success(__('The plan has been deleted.'));
        } else {
            $this->Flash->error(__('The plan could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
