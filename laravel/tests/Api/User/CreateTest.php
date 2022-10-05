<?php

namespace Tests\Api\User;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Controller\UsersController;
use App\Models\User;

class CreateTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
    }

    /** @test */
    public function ２０１レスポンスが返ること(): void
    {
        $user = User::factory()->make();

        $params = [
            'name'     => $user->name,
            'email'    => $user->email,
            'password' => $user->password, 
        ];

        $res = $this->json('POST', '/api/users', $params);
        $res->assertStatus(201);
    }

    /** @test */
    public function しっかり保存できていること(): void
    {
        // テストデータの作り方
        $user = User::factory()->make(); // make() だとDBに作成されないが、UserModelにデータが入っている
        // $user = User::factory()->create();

        $params = [
            'name'     => $user->name,
            'email'    => $user->email,
            'password' => $user->password, 
        ];

        $res = $this->json('POST', '/api/users', $params);
        $res->assertStatus(201);

        $latestUser = User::latest('id')->first(); // order by id desc
        $this->assertSame($user->email, $latestUser->email);
    }

    /**
     * @test
     * @dataProvider userCreateDataProvider
     */
    public function バリデーションエラー（レスポンス４００）が返ること($name, $email, $password): void
    {
        $user = User::factory()->make();

        $params = [
            'name'     => $name,
            'email'    => $email,
            'password' => $password, 
        ];

        $res = $this->json('POST', '/api/users', $params);
        $res->assertStatus(400);
    }

    public function userCreateDataProvider()
    {
        return [
            // 'テストタイトル' => [$name, $email, $password],
            'nameがnull' => [null, 'test@example.com', 'pass12345@'],
            'emailがnull' => ['testtaro', null, 'pass12345@'],
            'passwordがnull' => ['testtaro', 'test@example.com', null],
        ];
    }
}
