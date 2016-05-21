<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\NotePlansTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\NotePlansTable Test Case
 */
class NotePlansTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\NotePlansTable
     */
    public $NotePlans;

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
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('NotePlans') ? [] : ['className' => 'App\Model\Table\NotePlansTable'];
        $this->NotePlans = TableRegistry::get('NotePlans', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->NotePlans);

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
