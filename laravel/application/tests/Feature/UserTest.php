<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserTest extends TestCase
{
    private $__user = [
        'email' => 'testtest@gmail.com',
        'password' => 'testtest'
    ];
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testLogin()
    {
        $response = $this->withHeaders([
            'Content-Type' => 'application/json',
        ])->json('POST', '/api/auth/login', $this->__user);
        $response
            ->assertStatus(200)
            ->assertJson([
                'access_token' => true,
                'token_type' => true,
                'expires_in' => true
            ]);
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testRefresh()
    {
        $token = auth('api')->attempt($this->__user);
        $response = $this->withHeaders([
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer '. $token
        ])->json('POST', '/api/auth/refresh', []);

        $response
            ->assertStatus(200)
            ->assertJson([
                'access_token' => true,
                'token_type' => true,
                'expires_in' => true
            ]);
    }
}
