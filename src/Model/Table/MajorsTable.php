<?php
namespace App\Model\Table;

use App\Model\Entity\Major;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Majors Model
 *
 * @property \Cake\ORM\Association\HasMany $Herds
 */
class MajorsTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->table('majors');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->hasMany('Herds', [
            'foreignKey' => 'major_id'
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->add('id', 'valid', ['rule' => 'numeric'])
            ->allowEmpty('id', 'create');

        $validator
            ->requirePresence('desc', 'create')
            ->notEmpty('desc');

        $validator
            ->requirePresence('sdesc', 'create')
            ->notEmpty('sdesc');

        return $validator;
    }
}
