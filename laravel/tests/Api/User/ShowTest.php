<?php

namespace Tests\Api\User;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Controller\UsersController;
use App\Models\User;

class ShowTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
    }

    /** @test */
    public function ２００レスポンスが返ること(): void
    {
        $id = User::factory()->create()->id;

        $res = $this->json('GET', "/api/users/$id");
        $res->assertStatus(200);
    }

    /** @test */
    public function 指定したユーザーが返ること(): void
    {
        $user = User::factory()->create();

        $res = $this->json('GET', "/api/users/$user->id");
        $res->assertStatus(200)
            ->assertJsonFragment([
                'id'         => $user->id,
                'name'       => $user->name,
                'email'      => $user->email,
                'created_at' => $user->created_at,
                'updated_at' => $user->updated_at,
            ]);
    }

    /** @test */
    public function 必要なパラメータが含まれること(): void
    {
        $user = User::factory()->create();

        $res = $this->json('GET', "/api/users/$user->id");
        $res->assertStatus(200)
            ->assertJsonFragment([
                'id'         => $user->id,
                'name'       => $user->name,
                'email'      => $user->email,
                'created_at' => $user->created_at,
                'updated_at' => $user->updated_at,
            ]);
    }

    /** @test */
    public function ユーザーが存在しない場合、４０４レスポンスが返ること(): void
    {
        $count = User::count();
        $this->assertSame(0, $count);

        $res = $this->json('GET', "/api/users/99999");
        $res->assertStatus(404);
    }
}
