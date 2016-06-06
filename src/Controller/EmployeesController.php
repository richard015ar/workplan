<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Employees Controller
 *
 * @property \App\Model\Table\EmployeesTable $Employees
 */
class EmployeesController extends AppController
{
    // Paginate configuration
    public $paginate = [
        'limit' => 2,
        'order' => [
            'Employees.created' => 'asc'
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
     * @param string|null $id Employee id.
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
     * @param string|null $id Employee id.
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
            $employee = $this->Employees->patchEntity($employee, $this->request->data);
            if ($this->Employees->save($employee)) {
                $response['message'] = 'The employee has been saved.';
                $response['employee'] = $employee;
                $this->set(compact('response'));
                return;
            }
            $response['message'] = 'The employee could not be saved. Please, try again.';
            $response['error'] = true;
            $this->set(compact('response'));
            return;
        }
    }

    /**
     * Delete method
     *
     * @param string|null $id Employee id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $response = [
          'message' => '',
          'error' => false
        ];
        $this->request->allowMethod(['delete']);
        if ($this->Employees->delete($employee)) {
            $response['message'] = 'The employee has been deleted.';
            $response['employee'] = $employee;
            $this->set(compact('response'));
            return;
        }
        $response['message'] = 'The employee could not be deleted. Please, try again.';
        $response['error'] = true;
        $this->set(compact('response'));
        return;
    }

    public function employeesList()
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
            $limit = $this->request->query('limit');
                if (!$limit) {
                    $limit = 10;
                }
            $employees = $this->Employees->getEmployeeList($startDate, $endDate, $order, $searchTerm = null);
                if (!$employees)  {
                    $response['message'] = 'All fields must be fill';
                    $this->set(compact('response'));
                    return;
                }
                $response['error'] = false;
                $config = [
                    'limit' => $limit,
                ];
            $response['employees'] = $this->Paginator->paginate($employees, $config);
            $response['total'] = count($response['employees']);
            $this->set(compact('response'));
            return;
        }
        $response['message'] = 'Invalid users';
        $this->set(compact('response'));
        return;
    }
}
