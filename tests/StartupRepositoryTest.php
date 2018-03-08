<?php

use App\Startup;
use App\Repositories\StartupRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class StartupRepositoryTest extends TestCase
{
    use MakeStartupTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var StartupRepository
     */
    protected $startupRepo;

    public function setUp()
    {
        parent::setUp();
        $this->startupRepo = App::make(StartupRepository::class);
    }

    /**
     * @test create
     */
    public function testCreateStartup()
    {
        $startup = $this->fakeStartupData();
        $createdStartup = $this->startupRepo->create($startup);
        $createdStartup = $createdStartup->toArray();
        $this->assertArrayHasKey('id', $createdStartup);
        $this->assertNotNull($createdStartup['id'], 'Created Startup must have id specified');
        $this->assertNotNull(Startup::find($createdStartup['id']), 'Startup with given id must be in DB');
        $this->assertModelData($startup, $createdStartup);
    }

    /**
     * @test read
     */
    public function testReadStartup()
    {
        $startup = $this->makeStartup();
        $dbStartup = $this->startupRepo->find($startup->id);
        $dbStartup = $dbStartup->toArray();
        $this->assertModelData($startup->toArray(), $dbStartup);
    }

    /**
     * @test update
     */
    public function testUpdateStartup()
    {
        $startup = $this->makeStartup();
        $fakeStartup = $this->fakeStartupData();
        $updatedStartup = $this->startupRepo->update($fakeStartup, $startup->id);
        $this->assertModelData($fakeStartup, $updatedStartup->toArray());
        $dbStartup = $this->startupRepo->find($startup->id);
        $this->assertModelData($fakeStartup, $dbStartup->toArray());
    }

    /**
     * @test delete
     */
    public function testDeleteStartup()
    {
        $startup = $this->makeStartup();
        $resp = $this->startupRepo->delete($startup->id);
        $this->assertTrue($resp);
        $this->assertNull(Startup::find($startup->id), 'Startup should not exist in DB');
    }
}
