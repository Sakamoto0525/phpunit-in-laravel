<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use App\Models\User;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    public function login(User $user): void
    {
        if (!$token = auth('api')->login($user)) {
            throw new Exception('faild to login', 500);
        }
        $this->withHeaders(['Authorization' => 'Bearer ' . $token]);
    }
}
