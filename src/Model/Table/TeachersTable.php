<?php
namespace App\Model\Table;

//use App\Model\Entity\Teacher;
//use Cake\ORM\Query;
//use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
//use Cake\Validation\Validator;

/**
 * Teachers Model
 *
 */
class TeachersTable extends Table {

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config) {
        parent::initialize($config);

        //$this->table('teachers');
        $this->displayField('fam_name');
        //$this->primaryKey('id');

        $this->hasMany('Sections', [
            //'foreignKey' => 'section_id'
        ]);

        $this->hasOne('Users', [
            'foreignKey' => 'id',
            'bindingKey' => 'user_id'
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
            //->requirePresence('giv_name', 'create')
            //->notEmpty('giv_name');

        //return $validator;
    //}
}
