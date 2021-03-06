<?php
namespace App\Model\Table;

//use App\Model\Entity\Interaction;
//use Cake\ORM\Query;
//use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
//use Cake\Validation\Validator;

/**
 * Interactions Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Classes
 * @property \Cake\ORM\Association\BelongsTo $Students
 */
class InteractionsTable extends Table {

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config) {
        parent::initialize($config);

        //$this->table('interactions');
        //$this->displayField('id');
        //$this->primaryKey('id');

        $this->belongsTo('Clazzes', [
            //'foreignKey' => 'class_id',
            //'joinType' => 'INNER'
        ]);

        $this->belongsTo('Itypes', [
            //'foreignKey' => 'student_id',
            //'joinType' => 'INNER'
        ]);

        $this->belongsTo('Students', [
            //'foreignKey' => 'student_id',
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
        //return $validator;
    //}

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    //public function buildRules(RulesChecker $rules) {
        //$rules->add($rules->existsIn(['class_id'], 'Classes'));
        //$rules->add($rules->existsIn(['student_id'], 'Students'));
        //return $rules;
    //}
}
