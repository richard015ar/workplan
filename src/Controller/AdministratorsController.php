
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
}
