<?php
namespace App\Test\TestCase\Controller;

use App\Test\Fixture\FixtureConstants;
use App\Test\Fixture\TplanElementsFixture;
use Cake\ORM\TableRegistry;

class TplanElementsControllerTest extends DMIntegrationTestCase {

    public $fixtures = [
        'app.roles',
        'app.roles_users',
        'app.tplan_elements',
        'app.users'
    ];

    /* @var \App\Model\Table\TplanElementsTable */
    private $tplan_elements;

    private $tplan_elementsFixture;

    public function setUp() {
        parent::setUp();
        $this->tplan_elements = TableRegistry::get('TplanElements');
        $this->tplan_elementsFixture = new TplanElementsFixture();
    }

    // Test that unauthenticated users, when submitting a request to
    // an action, will get redirected to the login url.
    public function testUnauthenticatedActionsAndUsers() {
        $this->tstUnauthenticatedActionsAndUsers('tplan_elements');
    }

    // Test that users who do not have correct roles, when submitting a request to
    // an action, will get redirected to the home page.
    public function testUnauthorizedActionsAndUsers() {
        $this->tstUnauthorizedActionsAndUsers('tplan_elements');
    }

    public function testAddGET() {

        // 1. Simulate login, submit request, examine response.
        $this->fakeLogin(FixtureConstants::userAndyAdminId);
        $this->get('/tplan-elements/add');
        $this->assertResponseOk(); // 2xx
        $this->assertNoRedirect();

        // 2. Parse the html from the response
        $html = str_get_html($this->_response->body());

        // 3. Ensure that the correct form exists
        $this->form = $html->find('form#TplanElementAddForm',0);
        $this->assertNotNull($this->form);

        // 4. Now inspect the fields on the form.  We want to know that:
        // A. The correct fields are there and no other fields.
        // B. The fields have correct values. This includes verifying that select
        //    lists contain options.
        //
        //  The actual order that the fields are listed on the form is hereby deemed unimportant.

        // 4.1 These are counts of the select and input fields on the form.  They
        // are presently unaccounted for.
        $unknownSelectCnt = count($this->form->find('select'));
        $unknownInputCnt = count($this->form->find('input'));

        // 4.2 Look for the hidden POST input
        if($this->lookForHiddenInput($this->form)) $unknownInputCnt--;

        if($this->inputCheckerA($this->form,'input#TplanElementCol1')) $unknownInputCnt--;
        if($this->inputCheckerA($this->form,'input#TplanElementCol2')) $unknownInputCnt--;

        // 4.9 Have all the input and select fields been accounted for?  Are there
        // any extras?
        $this->assertEquals(0, $unknownInputCnt);
        $this->assertEquals(0, $unknownSelectCnt);

        // 5. Examine the <A> tags on this page.  There should be zero links.
        $this->content = $html->find('div#TplanElementsAdd',0);
        $this->assertNotNull($this->content);
        $links = $this->content->find('a');
        $this->assertEquals(0,count($links));
    }

    public function testAddPOST() {

        $this->fakeLogin(FixtureConstants::userAndyAdminId);
        $this->post('/tplan_elements/add', $this->tplan_elementsFixture->newTplanElementRecord);
        $this->assertResponseSuccess(); // 2xx, 3xx
        $this->assertRedirect( '/tplan-elements' );

        // Now verify what we think just got written
        $new_id = count($this->tplan_elementsFixture->records) + 1;
        $query = $this->tplan_elements->find()->where(['id' => $new_id]);
        $this->assertEquals(1, $query->count());

        // Now retrieve that 1 record and compare to what we expect
        $new_tplan_element = $this->tplan_elements->get($new_id);
        $this->assertEquals($new_tplan_element['col1'],$this->tplan_elementsFixture->newTplanElementRecord['col1']);
        $this->assertEquals($new_tplan_element['col2'],$this->tplan_elementsFixture->newTplanElementRecord['col2']);
    }

    public function testDeletePOST() {

        $this->fakeLogin(FixtureConstants::userAndyAdminId);
        $tplan_element_id = $this->tplan_elementsFixture->tplan_element1Record['id'];
        $this->post('/tplan-elements/delete/' . $tplan_element_id);
        $this->assertResponseSuccess(); // 2xx, 3xx
        $this->assertRedirect( '/tplan-elements' );

        // Now verify that the record no longer exists
        $query = $this->tplan_elements->find()->where(['id' => $tplan_element_id]);
        $this->assertEquals(0, $query->count());
    }

    public function testEditGET() {

        // 1. Simulate login, submit request, examine response.
        $this->fakeLogin(FixtureConstants::userAndyAdminId);
        $this->get('/tplan-elements/edit/' . $this->tplan_elementsFixture->tplan_element1Record['id']);
        $this->assertResponseOk(); // 2xx
        $this->assertNoRedirect();

        // 2. Parse the html from the response
        $html = str_get_html($this->_response->body());

        // 3. Ensure that the correct form exists
        $this->form = $html->find('form#TplanElementEditForm',0);
        $this->assertNotNull($this->form);

        // 4. Now inspect the fields on the form.  We want to know that:
        // A. The correct fields are there and no other fields.
        // B. The fields have correct values. This includes verifying that select
        //    lists contain options.
        //
        //  The actual order that the fields are listed on the form is hereby deemed unimportant.

        // 4.1 These are counts of the select and input fields on the form.  They
        // are presently unaccounted for.
        $unknownSelectCnt = count($this->form->find('select'));
        $unknownInputCnt = count($this->form->find('input'));

        // 4.2 Look for the hidden POST input
        if($this->lookForHiddenInput($this->form,'_method','PUT')) $unknownInputCnt--;

        // 4.3 col1
        if($this->inputCheckerA($this->form,'input#TplanElementCol1',
            $this->tplan_elementsFixture->tplan_element1Record['col1'])) $unknownInputCnt--;

        // 4.4 col2
        if($this->inputCheckerA($this->form,'input#TplanElementCol2',
            $this->tplan_elementsFixture->tplan_element1Record['col2'])) $unknownInputCnt--;

        // 4.9 Have all the input and select fields been accounted for?  Are there
        // any extras?
        $this->assertEquals(0, $unknownInputCnt);
        $this->assertEquals(0, $unknownSelectCnt);

        // 5. Examine the <A> tags on this page.  There should be zero links.
        $this->content = $html->find('div#TplanElementsEdit',0);
        $this->assertNotNull($this->content);
        $links = $this->content->find('a');
        $this->assertEquals(0,count($links));
    }

    public function testEditPOST() {

        $this->fakeLogin(FixtureConstants::userAndyAdminId);
        $tplan_element_id = $this->tplan_elementsFixture->tplan_element1Record['id'];
        $this->put('/tplan_elements/edit/' . $tplan_element_id, $this->tplan_elementsFixture->newTplanElementRecord);
        $this->assertResponseSuccess(); // 2xx, 3xx
        $this->assertRedirect('/tplan-elements');

        // Now verify what we think just got written
        $query = $this->tplan_elements->find()->where(['id' => $tplan_element_id]);
        $this->assertEquals(1, $query->count());

        // Now retrieve that 1 record and compare to what we expect
        $tplan_element = $this->tplan_elements->get($tplan_element_id);
        $this->assertEquals($tplan_element['col1'],$this->tplan_elementsFixture->newTplanElementRecord['col1']);
        $this->assertEquals($tplan_element['col2'],$this->tplan_elementsFixture->newTplanElementRecord['col2']);
    }

    public function testIndexGET() {

        // 1. Simulate login, submit request, examine response.
        $this->fakeLogin(FixtureConstants::userAndyAdminId);
        $this->get('/tplan-elements/index');
        $this->assertResponseOk(); // 2xx
        $this->assertNoRedirect();

        // 2. Parse the html from the response
        $html = str_get_html($this->_response->body());

        // 3. Get a the count of all <A> tags that are presently unaccounted for.
        $this->content = $html->find('div#TplanElementsIndex',0);
        $this->assertNotNull($this->content);
        $unknownATag = count($this->content->find('a'));

        // 4. Look for the create new tplan_element link
        $this->assertEquals(1, count($html->find('a#TplanElementAdd')));
        $unknownATag--;

        // 5. Ensure that there is a suitably named table to display the results.
        $this->table = $html->find('table#TplanElementsTable',0);
        $this->assertNotNull($this->table);

        // 6. Ensure that said table's thead element contains the correct
        //    headings, in the correct order, and nothing else.
        $this->thead = $this->table->find('thead',0);
        $thead_ths = $this->thead->find('tr th');

        $this->assertEquals($thead_ths[0]->id, 'col1');
        $this->assertEquals($thead_ths[1]->id, 'col2');
        $this->assertEquals($thead_ths[2]->id, 'actions');
        $column_count = count($thead_ths);
        $this->assertEquals($column_count,3); // no other columns

        // 7. Ensure that the tbody section has the same
        //    quantity of rows as the count of tplan_elements records in the fixture.
        $this->tbody = $this->table->find('tbody',0);
        $tbody_rows = $this->tbody->find('tr');
        $this->assertEquals(count($tbody_rows), count($this->tplan_elementsFixture->records));

        // 8. Ensure that the values displayed in each row, match the values from
        //    the fixture.  The values should be presented in a particular order
        //    with nothing else thereafter.
        $iterator = new \MultipleIterator();
        $iterator->attachIterator(new \ArrayIterator($this->tplan_elementsFixture->records));
        $iterator->attachIterator(new \ArrayIterator($tbody_rows));

        foreach ($iterator as $values) {
            $fixtureRecord = $values[0];
            $this->htmlRow = $values[1];
            $htmlColumns = $this->htmlRow->find('td');

            // 8.0 col1
            $this->assertEquals($fixtureRecord['col1'],  $htmlColumns[0]->plaintext);

            // 8.1 col2
            $this->assertEquals($fixtureRecord['col2'],  $htmlColumns[1]->plaintext);

            // 8.2 Now examine the action links
            $this->td = $htmlColumns[2];
            $actionLinks = $this->td->find('a');
            $this->assertEquals('TplanElementView', $actionLinks[0]->name);
            $unknownATag--;
            $this->assertEquals('TplanElementEdit', $actionLinks[1]->name);
            $unknownATag--;
            $this->assertEquals('TplanElementDelete', $actionLinks[2]->name);
            $unknownATag--;

            // 8.9 No other columns
            $this->assertEquals(count($htmlColumns),$column_count);
        }

        // 9. Ensure that all the <A> tags have been accounted for
        $this->assertEquals(0, $unknownATag);
    }

    public function testViewGET() {
        $this->fakeLogin(FixtureConstants::userAndyAdminId);
        $fixtureRecord=$this->tplan_elementsFixture->tplan_element1Record;
        $this->get('/tplan-elements/view/' . $fixtureRecord['id']);
        $this->assertResponseOk(); // 2xx
        $this->assertNoRedirect();

        // Parse the html from the response
        $html = str_get_html($this->_response->body());

        // 1.  Look for the table that contains the view fields.
        $this->table = $html->find('table#TplanElementViewTable',0);
        $this->assertNotNull($this->table);

        // 2. Now inspect the fields in the table.  We want to know that:
        // A. The correct fields are there and no other fields.
        // B. The fields have correct values.
        //
        //  The actual order that the fields are listed is hereby deemed unimportant.

        // This is the count of the table rows that are presently unaccounted for.
        $unknownRowCnt = count($this->table->find('tr'));

        // 2.1 col1
        $field = $html->find('tr#col1 td',0);
        $this->assertEquals($fixtureRecord['col1'], $field->plaintext);
        $unknownRowCnt--;

        // 2.2 col2
        $field = $html->find('tr#col2 td',0);
        $this->assertEquals($fixtureRecord['col2'], $field->plaintext);
        $unknownRowCnt--;

        // 2.9 Have all the rows been accounted for?  Are there any extras?
        $this->assertEquals(0, $unknownRowCnt);

        // 3. Examine the <A> tags on this page.  There should be zero links.
        $this->content = $html->find('div#TplanElementsView',0);
        $this->assertNotNull($this->content);
        $links = $this->content->find('a');
        $this->assertEquals(0,count($links));
    }
}