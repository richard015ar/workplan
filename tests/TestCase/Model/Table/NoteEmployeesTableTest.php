<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\NoteEmployeesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\NoteEmployeesTable Test Case
 */
class NoteEmployeesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\NoteEmployeesTable
     */
    public $NoteEmployees;

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
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('NoteEmployees') ? [] : ['className' => 'App\Model\Table\NoteEmployeesTable'];
        $this->NoteEmployees = TableRegistry::get('NoteEmployees', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->NoteEmployees);

        parent::tearDown();
    }

    /**
     * Test initialize method
     *
     * @return void
     */
    public function testInitialize()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test validationDefault method
     *
     * @return void
     */
    public function testValidationDefault()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     */
    public function testBuildRules()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
