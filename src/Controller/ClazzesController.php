<?php
namespace App\Controller;

class ClazzesController extends AppController {

    public function add() {
        $this->request->allowMethod(['get', 'post']);
        $clazz = $this->Clazzes->newEntity();
        if ($this->request->is('post')) {
            $clazz = $this->Clazzes->patchEntity($clazz, $this->request->data);
            if ($this->Clazzes->save($clazz)) {
                //$this->Flash->success(__('The clazz has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                //$this->Flash->error(__('The clazz could not be saved. Please, try again.'));
            }
        }
        $sections = $this->Clazzes->Sections->find('list');
        $this->set(compact('clazz','sections'));
    }

    public function delete($id = null) {
        $this->request->allowMethod(['post', 'delete']);
        $clazz = $this->Clazzes->get($id);
        if ($this->Clazzes->delete($clazz)) {
            //$this->Flash->success(__('The clazz has been deleted.'));
            //} else {
            //$this->Flash->error(__('The clazz could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }

    public function edit($id = null) {
        $this->request->allowMethod(['get', 'put']);
        $clazz = $this->Clazzes->get($id);
        if ($this->request->is(['put'])) {
            $clazz = $this->Clazzes->patchEntity($clazz, $this->request->data);
            if ($this->Clazzes->save($clazz)) {
                $this->Flash->success(__('The clazz has been saved.'));
                //return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The clazz could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('clazz', 'sections'));
    }

    public function index() {
        $this->request->allowMethod(['get']);
        $this->set('clazzes', $this->Clazzes->find('all', ['contain' => ['Sections']]));
    }

    public function view($id = null) {
        $this->request->allowMethod(['get']);
        $clazz = $this->Clazzes->get($id);
        $this->set('clazz', $clazz);
    }
}
