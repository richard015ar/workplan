<?php
namespace App\Test\TestCase\Controller;

use App\Controller\NoteEmployeesController;
use Cake\TestSuite\IntegrationTestCase;

/**
 * App\Controller\NoteEmployeesController Test Case
 */
class NoteEmployeesControllerTest extends IntegrationTestCase
{

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.note_employees',
        'app.users',
        'app.roles',
        'app.administrators',
        'app.employees',
        'app.plans',
        'app.note_items',
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
