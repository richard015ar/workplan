<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * NoteItems Controller
 *
 * @property \App\Model\Table\NoteItemsTable $NoteItems
 */
class NoteItemsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    /**
     * View method
     *
     * @param string|null $id Note Item id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function addNoteItem()
    {
        // this is a return variable
        $response = [
          'message' => '',
          'error' => false
        ];
        // this is a return variable
        $noteItem = $this->NoteItems->newEntity();
        if ($this->request->is('post')) {
            $userId = $this->Auth->user('id');
            $noteData['user_id'] = $userId;
            $noteData['item_id'] = $this->request->data['item_id'];
            $noteData['note'] = $this->request->data['note'];
            $noteItem = $this->NoteItems->patchEntity($noteItem, $noteData);
            if ($this->NoteItems->save($noteItem)) {
                $response['message'] = 'The note has been saved.';
                $response['noteItem'] = $noteItem;
                $this->set(compact('response'));
                return;
            }
        }
        //debug($noteItem);
        $response['error'] = true;
        $response['message'] = 'The notecould not be saved. Please, try again.';
        $this->set(compact('response'));
        return;
    }

    /**
     * Edit method
     *
     * @param string|null $id Note Item id.
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
            if($this->request->data['note']) {
                $noteItem = $this->NoteItems->get($id);
                if($noteItem->user_id == $this->Auth->user('id')) {
                    $noteItem->note = $this->request->data['note'];
                    if ($this->NoteItems->save($noteItem)) {
                        $response['message'] = 'The note item has been saved.';
                        $response['noteItem'] = $noteItem;
                        $this->set(compact('response'));
                        return;
                    }
                    $response['message'] = 'error. The note item not has been saved.';
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
     * @param string|null $id Note Item id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        // this is a return variable
        $response = [
          'message' => '',
          'error' => false
        ];
        if ($this->request->is(['put'])) {
            $noteItem = $this->NoteItems->get($id);
            if($noteItem->user_id == $this->Auth->user('id')) {
                $noteItem->deleted = date('Y-m-d H:i:s');
                if ($this->NoteItems->save($noteItem)) {
                    $response['message'] = 'The note item has been deleted.';
                    $response['noteItem'] = $noteItem;
                    $this->set(compact('response'));
                    return;
                }
            }
        }
        $response['error'] = true;
        $response['message'] = 'The note item could not be deleted. Please, try again.';
        $this->set(compact('response'));
        return;
    }
}
