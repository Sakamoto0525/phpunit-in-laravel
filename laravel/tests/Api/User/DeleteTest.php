<?php

namespace Tests\Api\User;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Controller\UsersController;
use App\Models\User;

class DeleteTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
    }

    /** @test */
    public function ２０４レスポンスが返ること(): void
    {
        $id = User::factory()->create()->id;

        $res = $this->json('DELETE', "/api/users/$id");
        $res->assertStatus(204);
    }

    /** @test */
    public function 指定したユーザーが削除されていること(): void
    {
        $user = User::factory()->create();

        $this->json('DELETE', "/api/users/$user->id");

        $deletedUser = User::find($user->id);
        $this->assertNull($deletedUser);
    }
}
