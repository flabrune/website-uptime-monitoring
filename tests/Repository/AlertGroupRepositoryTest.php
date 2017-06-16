<?php

namespace Tests\Repository;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use App\Repositories\AlertGroupsRepository;
use App\Models\User;
use App\Models\AlertGroup;

class AlertGroupRepositoryTest extends TestCase
{
    use DatabaseMigrations;
    use DatabaseTransactions;

    /**
     * Test create alert group successfully
     */
    public function testCreateAlertGroupRepositorySuccessfully()
    {
        factory(User::class, 1)->create();
        $user = User::all()->first();
        $data = [
            'name' => 'Group1',
            'user_id' => $user->id,
        ];
        $result = app(AlertGroupsRepository::class)->create($data);
        $this->assertEquals($data['name'], $result->name);
    }

    /**
     * Test update alert group failed
     */
    public function testUpdateAlertGroupRepositoryFailed()
    {
        factory(AlertGroup::class, 1)->create();
        $alertGroup = AlertGroup::all()->first();
        $id = $alertGroup->id;
        $data = [];
        $result = app(AlertGroupsRepository::class)->update($data, $id);
        $this->assertEquals($alertGroup->name, $result->name);
    }

    /**
     * Test update alert group successfully
     */
    public function testUpdateGroupRepositorySuccessfully()
    {
        factory(AlertGroup::class, 1)->create();
        $alertGroup = AlertGroup::all()->first();
        $id = $alertGroup->id;
        $data = [
            'name' => 'Group2'
        ];
        $result = app(AlertGroupsRepository::class)->update($data, $id);
        $this->assertEquals($data['name'], $result->name);
    }

    /**
     * Test delete alert group failed
     */
    public function testDeleteGroupRepositoryFailed()
    {
        $id = null;
        $result = app(AlertGroupsRepository::class)->delete($id);
        $this->assertEquals(0, $result);
    }

    /**
     * Test delete alert group successfully
     */
    public function testDeleteGroupRepositorySuccessfully()
    {
        factory(AlertGroup::class, 1)->create();
        $alertGroup = AlertGroup::all()->first();
        $id = $alertGroup->id;
        $result = app(AlertGroupsRepository::class)->delete($id);
        $this->assertEquals(1, $result);
    }

    /**
     * Test function findAllBy failed
     */
    public function testFindAllByAlertGroupFailed()
    {
        factory(AlertGroup::class, 1)->create();
        $attribute = 'name';
        $data = '';
        $result = app(AlertGroupsRepository::class)->findAllBy($attribute, $data);
        $this->assertEmpty($result);
    }

    /**
     * Test function findAllBy successfully
     */
    public function testFindAllByAlertGroupSuccessfully()
    {
        factory(AlertGroup::class, 1)->create();
        $alertGroup = AlertGroup::all()->first();
        $attribute = 'name';
        $data = $alertGroup->name;
        $result = app(AlertGroupsRepository::class)->findAllBy($attribute, $data);
        foreach ($result as $alertGroup) {
            $this->assertEquals($data, $alertGroup->name);
        }
    }

    /**
     * Test function all Alert Group failed
     */
    public function testAllAlertGroupFailed()
    {
        $result = app(AlertGroupsRepository::class)->all();
        $this->assertEmpty($result);
    }

    /**
     * Test function all Alert Group successfully
     */
    public function testAllAlertGroupSuccessfully()
    {
        factory(AlertGroup::class, 5)->create();
        $result = app(AlertGroupsRepository::class)->all();
        $this->assertNotEmpty($result);
    }

    /**
     * Test function find alert group
     */
    public function testFindAlertGroup()
    {
        factory(AlertGroup::class, 1)->create();
        $alertGroup = AlertGroup::all()->first();
        $id = $alertGroup->id;
        $result = app(AlertGroupsRepository::class)->find($id);
        $this->assertEquals($id, $result->id);
    }
}
