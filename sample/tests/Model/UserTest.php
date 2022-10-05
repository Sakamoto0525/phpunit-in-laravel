<?php

namespace Tests\Model;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Controller\UsersController;
use App\Models\User;

class UserTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
    }
}
