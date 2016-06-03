<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * NoteEmployees Controller
 *
 * @property \App\Model\Table\NoteEmployeesTable $NoteEmployees
 */
class NoteEmployeesController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Users', 'Employees']
        ];
        $noteEmployees = $this->paginate($this->NoteEmployees);

        $this->set(compact('noteEmployees'));
        $this->set('_serialize', ['noteEmployees']);
    }

    /**
     * View method
     *
     * @param string|null $id Note Employee id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $noteEmployee = $this->NoteEmployees->get($id, [
            'contain' => ['Users', 'Employees']
        ]);

        $this->set('noteEmployee', $noteEmployee);
        $this->set('_serialize', ['noteEmployee']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function addNoteEmployee()
    {
        $response = [
          'message' => '',
          'error' => false
        ];
        $noteEmployee = $this->NoteEmployees->newEntity();
        if ($this->request->is('post')) {
            $userId = $this->Auth->user('id');
            $noteData['user_id'] = $userId;
            $noteData['note'] = $this->request->data['note'];
            $noteData['employee_id'] = $this->request->data['employee_id'];;
            $noteEmployee = $this->NoteEmployees->patchEntity($noteEmployee, $noteData);
            if ($this->NoteEmployees->save($noteEmployee)) {
                $response['message'] = 'The note has been saved.';
                $response['noteEmployee'] = $noteEmployee;
                $this->set(compact('response'));
                return;
            }
        }
        $response['error'] = true;
        $response['message'] = 'The notecould not be saved. Please, try again.';
        $this->set(compact('response'));
        return;
    }

    /**
     * Edit method
     *
     * @param string|null $id Note Employee id.
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
            if($this->request->data['note'] && $this->request->data['employee_id']) {
                $noteEmployee = $this->NoteEmployees->get($id);
                if($noteEmployee->user_id == $this->Auth->user('id')) {
                    $noteEmployee->note = $this->request->data['note'];
                    $noteEmployee->employee_id = $this->request->data['employee_id'];
                    if ($this->NoteEmployees->save($noteEmployee)) {
                        $response['message'] = 'The note has been saved.';
                        $response['noteEmployee'] = $noteEmployee;
                        $this->set(compact('response'));
                        return;
                    }
                    $response['message'] = 'error. The note not has been saved.';
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
     * @param string|null $id Note Employee id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $response = [
          'message' => '',
          'error' => false
        ];
        $noteEmployee = $this->NoteEmployees->get($id);
        $this->request->allowMethod(['delete']);
        if($noteEmployee->user_id == $this->Auth->user('id')) {
            if ($this->NoteEmployees->delete($noteEmployee)) {
                $response['message'] = 'The note employee has been deleted.';
                $response['noteEmployee'] = $noteEmployee;
                $this->set(compact('response'));
                return;
            }
        }
        $response['error'] = true;
        $response['message'] = 'The note employee could not be deleted. Please, try again.';
        $this->set(compact('response'));
        return;
    }
}
