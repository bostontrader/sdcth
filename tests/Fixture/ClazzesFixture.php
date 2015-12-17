<?php
namespace App\Test\Fixture;

use Cake\Datasource\ConnectionManager;
use Cake\ORM\TableRegistry;

class ClazzesFixture extends DMFixture {
    public $import = ['table' => 'clazzes'];

    // These records are injected into the db before the tests.  We need to specify the
    // id to ensure the test records are properly related.
    /*public $clazz1Record = [
        'id'=>FixtureConstants::clazz1_id,
        'section_id' => FixtureConstants::section1_id,
        'event_datetime' => '2015-10-15 00:00:00',
        'comments' => 'comment 1'
    ];

    public $clazz2Record = [
        'id'=>FixtureConstants::clazz2_id,
        'section_id' => FixtureConstants::section1_id,
        'event_datetime' => '2015-10-16 00:00:00',
        'comments' => 'comment 2'
    ];

    public $clazz3Record = [
        'id'=>FixtureConstants::clazz3_id,
        'section_id' => FixtureConstants::section2_id,
        'event_datetime' => '2015-10-17 00:00:00',
        'comments' => 'comment 3'
    ];

    public $clazz4Record = [
        'id'=>FixtureConstants::clazz4_id,
        'section_id' => FixtureConstants::section2_id,
        'event_datetime' => '2015-10-18 00:00:00',
        'comments' => 'comment 4'
    ];*/

    // This record will be added during a test.  We don't need or want to control the id here, so omit it.

    //public $newClazzRecord = [
        //'section_id' => FixtureConstants::section2_id,
        //'event_datetime' => '2015-10-16 00:00:00',
        //'comments' => 'comment new'
    //];

    public function init() {

        $connection = ConnectionManager::get('fixture');
        $clazzes = TableRegistry::get('Clazzes');
        $query=$clazzes->find();
        $query->connection($connection);

        foreach($query as $clazzRecord) {
            $newRecord['id']=$clazzRecord->id;
            $newRecord['section_id']=$clazzRecord->section_id;
            $newRecord['event_datetime']=$clazzRecord->event_datetime;
            $newRecord['comments']=$clazzRecord->comments;
            $this->records[]=$newRecord;
        }

        parent::init();
    }

    // Given a $sectionId, remove all elements in $this->records that don't have the same $sectionId.
    public function filterBySectionId($sectionId) {
        $newRecords=[];
        foreach ($this->records as $record)
            if($record['section_id']==$sectionId) array_push($newRecords,$record);
        $this->records=$newRecords;
    }

}