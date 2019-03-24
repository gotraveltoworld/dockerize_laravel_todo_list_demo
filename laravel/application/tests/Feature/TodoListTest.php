<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TodoListTest extends TestCase
{
    private $__user = [
        'email' => 'testtest@gmail.com',
        'password' => 'testtest'
    ];

    private function getAuth(array $headers = [])
    {
        $token = auth('api')->attempt($this->__user);
        return $this->withHeaders(
            array_merge([
                'Authorization' => 'Bearer '. $token
            ], $headers)
        );
    }
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testGet($id = 1)
    {
        $response = $this->getAuth()->json('GET', "/api/todolist/{$id}");
        $response->assertStatus(200);
    }
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testGetAll()
    {
        $response = $this->getAuth()->json('GET', '/api/todolist');
        $response->assertStatus(200);
    }
}
