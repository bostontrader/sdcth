<?php
namespace App\Controller;

class RolesController extends AppController {

    public function add() {
        $this->request->allowMethod(['get', 'post']);
        $role = $this->Roles->newEntity();
        if ($this->request->is('post')) {
            $role = $this->Roles->patchEntity($role, $this->request->data);
            if ($this->Roles->save($role)) {
                //$this->Flash->success(__('The role has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                //$this->Flash->error(__('The role could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('role'));
        return null;
    }

    public function delete($id = null) {
        $this->request->allowMethod(['post', 'delete']);
        $role = $this->Roles->get($id);
        if ($this->Roles->delete($role)) {
            //$this->Flash->success(__('The role has been deleted.'));
            //} else {
            //$this->Flash->error(__('The role could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }

    public function edit($id = null) {
        $this->request->allowMethod(['get', 'put']);
        $role = $this->Roles->get($id);
        if ($this->request->is(['put'])) {
            $role = $this->Roles->patchEntity($role, $this->request->data);
            if ($this->Roles->save($role)) {
                //$this->Flash->success(__('The role has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                //$this->Flash->error(__('The role could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('role'));
        return null;
    }

    public function index() {
        $this->request->allowMethod(['get']);
        $this->set('roles', $this->Roles->find('all'));
    }

    public function view($id = null) {
        $this->request->allowMethod(['get']);
        $role = $this->Roles->get($id);
        $this->set('role', $role);
    }
}
