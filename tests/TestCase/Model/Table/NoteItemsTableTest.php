<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\NoteItemsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\NoteItemsTable Test Case
 */
class NoteItemsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\NoteItemsTable
     */
    public $NoteItems;

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
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('NoteItems') ? [] : ['className' => 'App\Model\Table\NoteItemsTable'];
        $this->NoteItems = TableRegistry::get('NoteItems', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->NoteItems);

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
