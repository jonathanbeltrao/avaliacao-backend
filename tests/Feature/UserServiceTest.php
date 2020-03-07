<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Services\UserService;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserServiceTest extends TestCase
{
    use RefreshDatabase;

    public function testCreate()
    {
        $userService = new UserService();

        $userService->create([
            'name' => 'Jonathan Beltrão',
            'email' => 'jonathanbeltrao@gmail.com',
            'password' => '123456',
        ]);

        $this->assertDatabaseHas('users', [
            'email' => 'jonathanbeltrao@gmail.com',
        ]);
    }
}
