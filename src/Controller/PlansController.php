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
    public function index($id = null)
    {
        $plan = $this->Plans->getEmployeeByPlans($id);

        $plans = $this->paginate($this->Plans);

        $this->set(compact('plans', 'plan'));
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
        // this is a return variable
        $response = [
          'message' => '',
          'error' => false
        ];
        $plan = $this->Plans->newEntity();
        if ($this->request->is('post')) {
            $plan = $this->Plans->patchEntity($plan, $this->request->data);
            if ($this->Plans->save($plan)) {
                $response['message'] = 'The plan has been saved.';
                $response['plan'] = $plan;
                $this->set(compact('response'));
                return;
            } else {
                $response['message'] = 'error. The plan not has been saved.';
                $response['error'] = true;
                $this->set(compact('response'));
                return;
            }
        }
        $this->set('response');
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
        // this is a return variable
        $response = [
          'message' => '',
          'error' => false
        ];
        $plan = $this->Plans->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $plan = $this->Plans->patchEntity($plan, $this->request->data);
            if ($this->Plans->save($plan)) {
                $response['message'] = 'The plan has been saved.';
                $response['plan'] = $plan;
                $this->set(compact('response'));
                return;
            } else {
                $response['message'] = 'error. The plan not has been saved.';
                $response['error'] = true;
                $this->set(compact('response'));
                return;
            }
        }
        $this->set('response');
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
        $response = [
          'message' => '',
          'error' => false
        ];
        $this->request->allowMethod(['post', 'delete']);
        $plan = $this->Plans->get($id);
        if ($this->Plans->delete($plan)) {
            $response['message'] = 'The plan has been deleted.';
            $response['plan'] = $plan;
            $this->set(compact('response'));
            return;
        } else {
            $response['message'] = 'The plan could not be deleted. Please, try again.';
            $response['error'] = true;
            $this->set(compact('response'));
            return;
        }
        $this->set('response');
    }
}
