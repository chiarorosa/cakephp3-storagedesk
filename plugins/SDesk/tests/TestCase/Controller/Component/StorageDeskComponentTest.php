<?php
namespace SDesk\Test\TestCase\Controller\Component;

use Cake\Controller\ComponentRegistry;
use Cake\TestSuite\TestCase;
use SDesk\Controller\Component\StorageDeskComponent;

/**
 * SDesk\Controller\Component\StorageDeskComponent Test Case
 */
class StorageDeskComponentTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \SDesk\Controller\Component\StorageDeskComponent
     */
    public $StorageDesk;

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $registry = new ComponentRegistry();
        $this->StorageDesk = new StorageDeskComponent($registry);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->StorageDesk);

        parent::tearDown();
    }

    /**
     * Test initial setup
     *
     * @return void
     */
    public function testInitialization()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
