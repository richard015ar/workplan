<?php
namespace App\Test\TestCase\Controller;

use App\Controller\NoteItemsController;
use Cake\TestSuite\IntegrationTestCase;

/**
 * App\Controller\NoteItemsController Test Case
 */
class NoteItemsControllerTest extends IntegrationTestCase
{

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.note_items',
        'app.items',
        'app.plans',
        'app.users',
        'app.roles',
        'app.administrators',
        'app.employees',
        'app.note_employees',
        'app.note_plans'
    ];

    /**
     * Test index method
     *
     * @return void
     */
    public function testIndex()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test view method
     *
     * @return void
     */
    public function testView()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test add method
     *
     * @return void
     */
    public function testAdd()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test edit method
     *
     * @return void
     */
    public function testEdit()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test delete method
     *
     * @return void
     */
    public function testDelete()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
