<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\HomeWorkingsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\HomeWorkingsTable Test Case
 */
class HomeWorkingsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\HomeWorkingsTable
     */
    public $HomeWorkings;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.home_workings',
        'app.users',
        'app.administrators',
        'app.employees',
        'app.note_employees',
        'app.plans',
        'app.items',
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
        $config = TableRegistry::exists('HomeWorkings') ? [] : ['className' => 'App\Model\Table\HomeWorkingsTable'];
        $this->HomeWorkings = TableRegistry::get('HomeWorkings', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->HomeWorkings);

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
