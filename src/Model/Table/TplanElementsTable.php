<?php
namespace App\Model\Table;

//use App\Model\Entity\Student;
//use Cake\ORM\Query;
//use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
//use Cake\Validation\Validator;

class TplanElementsTable extends Table {

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config) {
        parent::initialize($config);

        //$this->table('students');
        //$this->displayField('fullname');
        //$this->primaryKey('id');

        $this->belongsTo('Tplans', [
            //'foreignKey' => 'major_id',
            //'joinType' => 'INNER'
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    //public function validationDefault(Validator $validator) {
        //$validator
            //->add('id', 'valid', ['rule' => 'numeric'])
            //->allowEmpty('id', 'create');

        //$validator
            //->requirePresence('sid', 'create')
            //->notEmpty('sid');

        //$validator
            //->requirePresence('fam_name', 'create')
            //->notEmpty('fam_name');

        //$validator
            //->requirePresence('giv_name', 'create')
            //->notEmpty('giv_name');

        //return $validator;
    //}
}
