<?php

namespace Tests\Api\User;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Controller\UsersController;
use App\Models\User;

class IndexTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
    }

    /** @test */
    public function ２００レスポンスが返ること(): void
    {
        User::factory()->create();

        $res = $this->json('GET', '/api/users');
        $res->assertStatus(200);
    }

    /** @test */
    public function 全ユーザーが返ること(): void
    {
        User::factory(10)->create();

        $res = $this->json('GET', '/api/users');
        $res->assertStatus(200)
            ->assertJsonCount(User::count());
    }

    /** @test */
    public function 必要なパラメータが含まれること(): void
    {
        User::factory()->create();

        $res = $this->json('GET', '/api/users');
        $res->assertStatus(200)
            ->assertJsonCount(User::count());
    }

    /** @test */
    public function ユーザーが存在しない場合、４０４レスポンスが返ること(): void
    {
        $count = User::count();
        $this->assertSame(0, $count);

        $res = $this->json('GET', '/api/users');
        $res->assertStatus(404);
    }
}
