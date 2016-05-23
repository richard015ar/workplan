<?php
namespace App\Test\TestCase\Controller;

use App\Controller\NotePlansController;
use Cake\TestSuite\IntegrationTestCase;

/**
 * App\Controller\NotePlansController Test Case
 */
class NotePlansControllerTest extends IntegrationTestCase
{

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.note_plans',
        'app.users',
        'app.roles',
        'app.administrators',
        'app.employees',
        'app.note_employees',
        'app.plans',
        'app.note_items',
        'app.items'
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
