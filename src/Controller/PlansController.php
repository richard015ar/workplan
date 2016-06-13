<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Mailer\Email;

/**
 * Plans Controller
 *
 * @property \App\Model\Table\PlansTable $Plans
 */
class PlansController extends AppController
{
    // Paginate configuration
    public $paginate = [
        'limit' => 2,
        'order' => [
            'Plans.created' => 'asc'
        ]
    ];

    /**
     * View method
     *
     * @param string|null $id Plan id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
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
        if ($this->request->is(['put'])) {
            if($this->request->data['state']) {
                $plan = $this->Plans->get($id);
                if($plan->employee_id == $this->Plans->Employees->getIdByUserId($this->Auth->user('id'))) {
                    $plan->state = $this->request->data['state'];
                    if ($this->Plans->save($plan)) {
                        $response['message'] = 'The plan has been saved.';
                        $response['plan'] = $plan;
                        $this->set(compact('response'));
                        return;
                    }
                    $response['message'] = 'error. The plan not has been saved.';
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
     * @param string|null $id Plan id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null) {
        $response = [
          'message' => '',
          'error' => false
        ];
        if ($this->request->is(['put'])) {
            $plan = $this->Plans->get($id);
            if($plan->employee_id == $this->Plans->Employees->getIdByUserId($this->Auth->user('id'))) {
                $plan->deleted = date('Y-m-d H:i:s');
                if ($this->Plans->save($plan)) {
                    $response['message'] = 'The plan has been deleted.';
                    $response['plan'] = $plan;
                    $this->set(compact('response'));
                    return;
                }
            }
        }
        $response['message'] = 'The plan could not be deleted. Please, try again.';
        $response['error'] = true;
        $this->set(compact('response'));
        return;
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
                    $itemsData['description'] = $item;
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

    public function sendReminderToEmployee() {
        // Remember close a opened Plan
        if (date('H') == 19) {
            $op = $this->Plans->$this->Plans->getPlans('2016-05-20 00:00:00', date('Y-m-d h:m:i'), 'ASC', '', 1);
            $messagePlanOpened = "Remember close the plan of today!";
            foreach ($op as $plan) {
                // $email = new Email('default');
                // $email->from(['hector@taggify.net' => 'Plainify'])
                //     ->to($plan->employee->user->email)
                //     ->subject('Close the plan of today')
                //     ->send($messagePlanOpened);
            }
        }
        if (date('H') == '00') {
            // Remember open a new Plan
            $op = $this->Plans->getPlans('2016-05-20 00:00:00', date('Y-m-d h:m:i'), 'ASC', '', 2);
            $messageNewPlan = "Remember open a new plan of today!";
            foreach ($op as $plan) {
                // $email = new Email('default');
                // $email->from(['hector@taggify.net' => 'Plainify'])
                //     ->to($plan->employee->user->email)
                //     ->subject('Open the plan of today')
                //     ->send($messageNewPlan);
            }
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
                "id": 15,
                "note" : 'This is a note for this Item'
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
            'Meeting with Hector',
            'Fixing bugs in production',
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
            if ($item['note']) { // If have note this item we need save.
                $notePlan = $item['note'];
                unset($item['note']);
                if (!$this->Plans->Items->NoteItems->existNote($item['id'], $notePlan)) {
                    $noteItemEntity = $this->Plans->Items->NoteItems->newEntity();
                    $noteItemEntity->item_id = intval($item['id']);
                    $noteItemEntity->note = $notePlan;
                    $noteItemEntity->user_id = intval($this->Auth->user('id'));
                    $this->Plans->Items->NoteItems->save($noteItemEntity);
                }
            }
            $itemEntity = $this->Plans->Items->newEntity($item);
            $itemEntity->id = intval($item['id']);
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
                $itemsData['state'] = 2;
                $itemsData['description'] = $newItem;
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
        $limit = $this->request->query('limit');
        if (!$limit) {
            $limit = 10;
        }
        $plans = $this->Plans->getPlansByEmployeeId($startDate, $endDate, $order, $searchTerm, $employeeId);
        if (!$plans)  {
            $response['message'] = 'All fields must be fill';
            $this->set(compact('response'));
            return;
        }
        $response['error'] = false;
        $config = [
            'limit' => $limit
        ];
        $response['plans'] = $this->Paginator->paginate($plans, $config);
        $response['total'] = count($response['plans']);
        $this->set(compact('response'));
        return;
    }

    public function getByEmployeeId() {
        $response = [
            'error' => true,
            'message' => ''
        ];
        if (!$this->request->is('get') || !$this->request->query('employeeId')) {
            $response['message'] = 'Invalid request';
            $this->set(compact('response'));
            return;
        }
        $startDate = $this->request->query('startDate');
        $endDate = $this->request->query('endDate');
        $searchTerm = $this->request->query('searchTerm');
        $order = $this->request->query('order');
        $employeeId = intval($this->request->query('employeeId'));
        $limit = $this->request->query('limit');
        if (!$limit) {
            $limit = 10;
        }
        $plans = $this->Plans->getPlansByEmployeeId($startDate, $endDate, $order, $searchTerm, $employeeId);
        if (!$plans)  {
            $response['message'] = 'All fields must be fill';
            $this->set(compact('response'));
            return;
        }
        $response['error'] = false;
        $config = [
            'limit' => $limit
        ];
        $response['plans'] = $this->Paginator->paginate($plans, $config);
        $response['total'] = count($response['plans']);
        $this->set(compact('response'));
        return;
    }

    public function getAllPlans()
    {
        $response = [
            'error' => true,
            'message' => ''
        ];
        if($this->Auth->user('role') == 1){
        if (!$this->request->is('get')) {
            $response['message'] = 'Invalid request';
            $this->set(compact('response'));
            return;
        }
        $startDate = $this->request->query('startDate');
        $endDate = $this->request->query('endDate');
        $searchTerm = $this->request->query('searchTerm');
        $order = $this->request->query('order');
        $state = $this->request->query('state');
        $limit = $this->request->query('limit');
        if (!$limit) {
            $limit = 10;
        }
        $plans = $this->Plans->getPlans($startDate, $endDate, $order, $searchTerm, $state);
        if (!$plans)  {
            $response['message'] = 'All fields must be fill';
            $this->set(compact('response'));
            return;
        }
        $response['error'] = false;
        $config = [
            'limit' => $limit,
        ];

        $response['plans'] = $this->Paginator->paginate($plans, $config);
        $response['total'] = count($response['plans']);
        $this->set(compact('response'));
        return;
        }
        $response['message'] = 'Invalid users';
        $this->set(compact('response'));
        return;
    }
    /*
    It function is if the user has logged plans, if you have open plans gives you a list of plans,
    if there are no open plans that is you are all closed returns a message.
    */
    public function closePlanOpen() {
        $response = [
            'error' => false,
            'message' => ''
        ];
        $employeeId = $this->Plans->Employees->getIdByUserId($this->Auth->user('id'));
        $plans = $this->Plans->getPlanOpenByEmployee($employeeId);
        if($plans) {
            $response['message'] = 'It has open plans.';
            $response['plans'] = $plans;
            $this->set(compact('response'));
            return;
        }
        if (!$plans)  {
            $response['message'] = 'It has no open plans';
            $this->set(compact('response'));
            return;
        }
    }
}
