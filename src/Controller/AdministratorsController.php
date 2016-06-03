
<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Administrators Controller
 *
 * @property \App\Model\Table\AdministratorsTable $Administrators
 */
class AdministratorsController extends AppController
{
    // Paginate configuration
    public $paginate = [
        'limit' => 2,
        'order' => [
            'Administrators.created' => 'asc'
        ]
    ];
    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Users']
        ];
        $administrators = $this->paginate($this->Administrators);

        $this->set(compact('administrators'));
        $this->set('_serialize', ['administrators']);
    }
    
    public function administratorList()
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
            $administrators = $this->Administrators->getAdministratorList($startDate, $endDate, $order, $searchTerm = null);
                if (!$administrators)  {
                    $response['message'] = 'All fields must be fill';
                    $this->set(compact('response'));
                    return;
                }
                $response['error'] = false;
                $config = [
                    'limit' => $limit,
                ];
            $response['administrators'] = $this->Paginator->paginate($administrators, $config);
            $response['total'] = count($response['administrators']);
            $this->set(compact('response'));
            return;
        }
        $response['message'] = 'Invalid users';
        $this->set(compact('response'));
        return;
    }


    /**
     * View method
     *
     * @param string|null $id Administrator id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $administrator = $this->Administrators->get($id, [
            'contain' => ['Users']
        ]);

        $this->set('administrator', $administrator);
        $this->set('_serialize', ['administrator']);
    }

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
        $administrator = $this->Administrators->newEntity();
        if ($this->request->is('post')) {
            $administrator = $this->Administrators->patchEntity($administrator, $this->request->data);
            if ($this->Administrators->save($administrator)) {
                $response['message'] = 'The administrator has been saved.';
                $response['administrator'] = $administrator;
                $this->set(compact('response'));
                return;
            }
            $response['message'] = 'The administrator could not be saved. Please, try again.';
            $response['error'] = true;
            $this->set(compact('response'));
            return;
        }
    }

    /**
     * Edit method
     *
     * @param string|null $id Administrator id.
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
            $administrator = $this->Administrators->patchEntity($administrator, $this->request->data);
            if ($this->Administrators->save($administrator)) {
                $response['message'] = 'The administrator has been saved.';
                $response['administrator'] = $administrator;
                $this->set(compact('response'));
                return;
            }
            $response['message'] = 'The administrator could not be saved. Please, try again.';
            $response['error'] = true;
            $this->set(compact('response'));
            return;
        }
    }

    /**
     * Delete method
     *
     * @param string|null $id Administrator id.
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
        if ($this->Administrators->delete($administrator)) {
            $response['message'] = 'The administrator has been deleted.';
            $response['administrator'] = $administrator;
            $this->set(compact('response'));
            return;
        }
        $response['message'] = 'The administrator could not be deleted. Please, try again.';
        $response['error'] = true;
        $this->set(compact('response'));
        return;
    }
}
