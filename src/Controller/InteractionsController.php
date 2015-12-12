<?php
namespace App\Controller;

use Cake\Datasource\ConnectionManager;
use Cake\ORM\TableRegistry;

class InteractionsController extends AppController {

    public function add() {
        $this->request->allowMethod(['get', 'post']);
        $interaction = $this->Interactions->newEntity();
        if ($this->request->is('post')) {
            $interaction = $this->Interactions->patchEntity($interaction, $this->request->data);
            if ($this->Interactions->save($interaction)) {
                //$this->Flash->success(__('The interaction has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                //$this->Flash->error(__('The interaction could not be saved. Please, try again.'));
            }
        }
        $clazzes = $this->Interactions->Clazzes->find('list');
        $students = $this->Interactions->Students->find('list');
        $itypes = $this->Interactions->Itypes->find('list');
        $this->set(compact('clazzes','interaction','itypes','students'));
        return null;
    }

    public function attend() {

        //$this->request->allowMethod(['get', 'post']);
        //$interaction = $this->Interactions->get($id);
        //if ($this->request->is(['post'])) {
            //$interaction = $this->Interactions->patchEntity($interaction, $this->request->data);
            //if ($this->Interactions->save($interaction)) {
                //$this->Flash->success(__('The interaction has been saved.'));
            //return $this->redirect(['action' => 'index']);
            //} else {
                //$this->Flash->error(__('The interaction could not be saved. Please, try again.'));
            //}
            //}
        //$clazzes = $this->Interactions->Clazzes->find('list');
        //$itypes = $this->Interactions->Itypes->find('list');
        //$students = $this->Interactions->Students->find('list');
        //$this->set(compact('clazzes','interaction','itypes','students'));
        //return null;

        if ($this->request->is(['post'])) {
            $n=$this->request->data;
        }
            // Given a clazz, who are the students? This can be found by tracing through
        // clazzes, sections, cohorts, and thence to students. I spent too much time
        // futily trying to get this to work using the ORM. Fuck it. Use a direct connection.
        //
        $connection = ConnectionManager::get('default');
        $query="select students.sid, students.giv_name, students.fam_name, cohorts.id, sections.id, clazzes.id
            from students
            left join cohorts on students.cohort_id = cohorts.id
            left join sections on sections.cohort_id = cohorts.id
            left join clazzes on clazzes.section_id = sections.id
            where clazzes.id=86";

        $studentsResults = $connection->execute($query)->fetchAll('assoc');
        $this->set('studentsResults',$studentsResults);

        $this->set('interactions', $this->Interactions->find());

    }

    public function delete($id = null) {
        $this->request->allowMethod(['post', 'delete']);
        $interaction = $this->Interactions->get($id);
        if ($this->Interactions->delete($interaction)) {
            //$this->Flash->success(__('The interaction has been deleted.'));
            //} else {
            //$this->Flash->error(__('The interaction could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }

    public function edit($id = null) {
        $this->request->allowMethod(['get', 'post']);
        $interaction = $this->Interactions->get($id);
        if ($this->request->is(['post'])) {
            $interaction = $this->Interactions->patchEntity($interaction, $this->request->data);
            if ($this->Interactions->save($interaction)) {
                //$this->Flash->success(__('The interaction has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                //$this->Flash->error(__('The interaction could not be saved. Please, try again.'));
            }
        }
        $clazzes = $this->Interactions->Clazzes->find('list');
        $itypes = $this->Interactions->Itypes->find('list');
        $students = $this->Interactions->Students->find('list');
        $this->set(compact('clazzes','interaction','itypes','students'));
        return null;
    }

    public function index() {
        $this->request->allowMethod(['get']);
        $this->set('interactions', $this->Interactions->find('all', ['contain' => ['Clazzes','Itypes','Students']]));
    }

    public function view($id = null) {
        $this->request->allowMethod(['get']);
        $interaction = $this->Interactions->get($id, ['contain' => ['Clazzes','Itypes','Students']]);
        $this->set('interaction', $interaction);
    }
}
