<?php

namespace Tests\Api\User;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Controller\UsersController;
use App\Models\User;

class UpdateTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
    }

    /** @test */
    public function ２０４レスポンスが返ること(): void
    {
        $user = User::factory()->create();

        $params = [
            'name'     => $user->name,
            'password' => $user->password,
        ];

        $res = $this->json('PUT', "/api/users/$user->id", $params);
        $res->assertStatus(204);
    }

    /** @test */
    public function しっかり更新できていること(): void
    {
        $user = User::factory()->create();

        $name = "変更した名前";
        $params = [
            'name'     => $name,
            'password' => $user->password,
        ];

        $res = $this->json('PUT', "/api/users/$user->id", $params);
        $res->assertStatus(204);

        $updatedUser = User::find($user->id);
        $this->assertSame($name, $updatedUser->name);
    }
}
