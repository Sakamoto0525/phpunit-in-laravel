<?php

namespace Tests\Api;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;

class UsersControllerTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
    }

    /** @test */
    public function ログインしていない時、４０１レスポンスが返ること(): void
    {
        $id = factory(User::class)->create()->id;

        $res = $this->json('GET', "/api/users/$id");
        $res->assertStatus(401);
    }

    /** @test */
    public function ログインしている時、２００レスポンスが返ること(): void
    {
        $user = factory(User::class)->create();
        $this->login($user);

        $res = $this->json('GET', "/api/users/$user->id");
        $res->assertStatus(200);
    }

    /** @test */
    public function 指定したユーザーが返ること(): void
    {
        $user = factory(User::class)->create();
        $this->login($user);

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
        $user = factory(User::class)->create();
        $this->login($user);

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
        $user = factory(User::class)->create();
        $this->login($user);

        $userId = $user->id + 1;
        $res = $this->json('GET', "/api/users/$userId");
        $res->assertStatus(404);
    }
}
