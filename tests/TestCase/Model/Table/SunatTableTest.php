<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\SunatTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\SunatTable Test Case
 */
class SunatTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\SunatTable
     */
    public $Sunat;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.Sunat',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('Sunat') ? [] : ['className' => SunatTable::class];
        $this->Sunat = TableRegistry::getTableLocator()->get('Sunat', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Sunat);

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
}
