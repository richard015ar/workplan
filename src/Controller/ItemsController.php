<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Items Controller
 *
 * @property \App\Model\Table\ItemsTable $Items
 */
class ItemsController extends AppController
{
    // Paginate configuration
    public $paginate = [
        'limit' => 2,
        'order' => [
            'Items.created' => 'asc'
        ]
    ];

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    /**
     * View method
     *
     * @param string|null $id Item id.
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
        $response = [
          'message' => '',
          'error' => false
        ];
        $item = $this->Items->newEntity();
        if ($this->request->is('post')) {
            $itemData['plan_id'] = $this->request->data['plan_id'];
            $itemData['state'] = $this->request->data['state'];
            $itemData['description'] = $this->request->data['description'];
            $item = $this->Items->patchEntity($item, $itemData);
            if ($this->Items->save($item)) {
                $response['message'] = 'The item has been saved.';
                $response['item'] = $item;
                $this->set(compact('response'));
                return;
            }
        }
        $response['message'] = 'The item could not be saved. Please, try again.';
        $response['error'] = true;
        $this->set(compact('response'));
        return;
    }

    /**
     * Edit method
     *
     * @param string|null $id Item id.
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
            if($this->request->data['state'] && $this->request->data['description']) {
                $item = $this->Items->get($id);
                    $item->state = $this->request->data['state'];
                    $item->description = $this->request->data['description'];
                    if ($this->Items->save($item)) {
                        $response['message'] = 'The item has been saved.';
                        $response['item'] = $item;
                        $this->set(compact('response'));
                        return;
                    }
                    $response['message'] = 'error. The item not has been saved.';
                    $response['error'] = true;
                    $this->set(compact('response'));
                    return;
            }
        }
    }

    /**
     * Delete method
     *
     * @param string|null $id Item id.
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
            $item = $this->Items->get($id);
            $item->deleted = date('Y-m-d H:i:s');
            if ($this->Items->save($item)) {
                $response['message'] = 'The item has been deleted.';
                $response['item'] = $item;
                $this->set(compact('response'));
                return;
            }
        }
        $response['message'] = 'The item could not be deleted. Please, try again.';
        $response['error'] = true;
        $this->set(compact('response'));
        return;
    }

    /*
    This action retrieve all items for an employee between two dates
    and with order and search term (no required) and state of item (no required)
    // ADD PARAMS HERE!
    */
    public function employeeItems() {
        $response = [
            'error' => true,
            'message' => ''
        ];
        if (!$this->request->is('get')) {
            $response['message'] = 'Invalid request';
            $this->set(compact('response'));
            return;
        }
        $deleted = $this->request->query('deleted');
        $startDate = $this->request->query('startDate');
        $endDate = $this->request->query('endDate');
        $searchTerm = $this->request->query('searchTerm');
        $order = $this->request->query('order');
        $stateItem = $this->request->query('state');
        $employeeId = $this->Items->Plans->Employees->getIdByUserId($this->Auth->user('id'));
        $limit = $this->request->query('limit');
        if (!$limit) {
            $limit = 10;
        }
        $items = $this->Items->getItemsByEmployeeId($startDate, $endDate, $order, $stateItem, $searchTerm, $employeeId, $deleted);
        if (!$items)  {
            $response['message'] = 'All fields must be fill';
            $this->set(compact('response'));
            return;
        }
        $response['error'] = false;
        $config = [
            'limit' => $limit,
        ];
        $response['items'] = $this->Paginator->paginate($items, $config);
        $response['total'] = count($response['items']);
        $this->set(compact('response'));
        return;
    }
}
