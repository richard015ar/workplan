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

    /*
    This action add a new plan with their items.
    This action is thinking for the begining of day
    */
    public function addPlan()
    {
        // this is a return variable
        $response = [
          'message' => '',
          'error' => false
        ];
        // this is a return variable
        $plan = $this->Plans->newEntity();//add plan
        if ($this->request->is('post')) {
        $employeeId = $this->Plans->Employees->getIdByUserId($this->Auth->user('id'));
        $planData['employee_id'] = $employeeId;
        $planData['state'] = 1;
        $plan = $this->Plans->patchEntity($plan, $planData);
        if ($this->Plans->save($plan)) {//save items
                // this is a return variable
                $itemToReturn = [];
                foreach($this->request->data['items'] as $item) {
                    $itemEntity = $this->Plans->Items->newEntity();
                    $itemsData['plan_id'] = $plan->id;
                    $itemsData['state'] = 1;
                    $itemsData['description'] = $item[0]['description'];
                    $itemEntity = $this->Plans->Items->patchEntity($itemEntity, $itemsData);
                    if ($this->Plans->Items->save($itemEntity)) {
                        $itemToReturn[] = $itemEntity;
                    }
                }
                $response['plan'] = $plan;
                $response['items'] = $itemToReturn;
                $this->set(compact('response'));
                return;
            }
            $response['error'] = true;
            $response['message'] = 'error. The plan not has been saved.';
            $this->set(compact('response'));
            return;
        }
    }

    /*
    This action if for close the plan (to final of the day).
    The employee close the plan changing each state of item and he con
    add new items. This items is added because in the day he will make new tasks.
    The plan ID is by POST.

    POST = {
        'plan_id' : 144,
        "items": [
              {
                "plan_id": 12,
                "state": 2,
                "description": "Meeting with Julio",
                "created": "2016-05-25T18:23:30+0000",
                "modified": "2016-05-25T18:23:30+0000",
                "id": 15
              },
              {
                "plan_id": 12,
                "state": 1,
                "description": "New controllers for real time panel",
                "created": "2016-05-25T18:23:30+0000",
                "modified": "2016-05-25T18:23:30+0000",
                "id": 16
              }
         ],
        'newItems' : [
                {
                    description: 'Meeting with Hector',
                    state : 1
                },
                {
                    description: 'Fixing bugs in production',
                    state : 2
                },
        ]
    }
    */
    public function closePlan() {
        $response = [
            'error' => false,
            'message' => ''
        ];
        $planId = intval($this->request->data['plan_id']);
        if ($planId == 0) {
            $response['error'] = true;
            $response['message'] = 'You must send the plan_id field.';
            $this->set(compact('response'));
            return;
        }
        // Change state of plan
        $employeeId = $this->Plans->Employees->getIdByUserId($this->Auth->user('id'));
        $plan = $this->Plans->get($planId);
        if ($plan->employee_id != $employeeId) {
            $response['error'] = true;
            $response['message'] = "You don't authorized change this plan.";
            $this->set(compact('response'));
            return;
        }
        $plan->state = 2;
        $this->Plans->save($plan);
        $response['plan'] = $plan;

        // We need change each state of current items
        foreach ($this->request->data['items'] as $item) {
            $itemEntity = $this->Plans->Items->newEntity();
            $itemEntity = $this->Plans->Items->patchEntity($itemEntity, $item);
            $itemEntity->modified = date('Y-m-d H:i:s');
            $this->Plans->Items->save($itemEntity);
            $response['items'][] = $itemEntity;
        }

        // Add new items
        if (
            $this->request->data['newItems'] &&
            count($this->request->data['newItems']) > 0
        ) {
            foreach ($this->request->data['newItems'] as $newItem) {
                $itemEntity = $this->Plans->Items->newEntity();
                $itemsData['plan_id'] = $planId;
                $itemsData['state'] = $newItem['state'];
                $itemsData['description'] = $newItem['description'];
                $itemEntity = $this->Plans->Items->patchEntity($itemEntity, $itemsData);
                $this->Plans->Items->save($itemEntity);
                $response['newItems'][] = $itemEntity;
            }
        }
        $this->set(compact('response'));
        return;
    }

    /*
    This action retrieve all plans for an employee between two dates
    and with order and search term (no required)
    // ADD PARAMS HERE!
    */
    public function employeePlans() {
        $response = [
            'error' => true,
            'message' => ''
        ];
        if (!$this->request->is('get')) {
            $response['message'] = 'Invalid request';
            $this->set(compact('response'));
            return;
        }
        $startDate = $this->request->query('startDate');
        $endDate = $this->request->query('endDate');
        $searchTerm = $this->request->query('searchTerm');
        $order = $this->request->query('order');
        $employeeId = $this->Plans->Employees->getIdByUserId($this->Auth->user('id'));
        $plans = $this->Plans->getPlansByEmployeeId($startDate, $endDate, $order, $searchTerm, $employeeId);
        if (!$plans)  {
            $response['message'] = 'All fields must be fill';
            $this->set(compact('response'));
            return;
        }
        $response['error'] = false;
        $response['plans'] = $plans;
        $this->set(compact('response'));
        return;
    }
}
