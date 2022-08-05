<?php

namespace Tests\Feature\Auth;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

class AuthTest extends TestCase
{
    // User A -> can search provinces and cities
    // username : adminA
    // password : A12345

    // User B -> can search provinces only
    // username : adminB
    // password : B12345

    // User C -> can search cities only
    // username : adminC
    // password : C12345

    private function deleteUser($response)
    {
        // Delete created User
        $id = $response->getData()->user->id;
        $res= User::where('id',$id)->delete();
    }

    public function test_createUserA()
    {
        $response = $this->postJson(
            '/api/auth/register',
            [
                'username'=> 'adminA',
                'password'=> 'A12345',
                'search_province' => 1,
                'search_city' => 1,
            ],
            [
                'Accept' => 'application/json'
            ]
        );

        $response
            ->assertHeader('content-type', 'application/json')
            ->assertStatus(200)
            ->assertJsonStructure([
                'message',
                'user' => [
                    'username',
                    'id',
                ],
                'authorization' => [
                    'token',
                    'type',
                ],
            ]);
    }

    public function test_createUserB()
    {
        $response = $this->postJson(
            '/api/auth/register',
            [
                'username'=> 'adminB',
                'password'=> 'B12345',
                'search_province' => 1,
            ],
            [
                'Accept' => 'application/json'
            ]
        );

        $response
            ->assertHeader('content-type', 'application/json')
            ->assertStatus(200)
            ->assertJsonStructure([
                'message',
                'user' => [
                    'username',
                    'id',
                ],
                'authorization' => [
                    'token',
                    'type',
                ],
            ]);
    }

    public function test_createUserC()
    {
        $response = $this->postJson(
            '/api/auth/register',
            [
                'username'=> 'adminC',
                'password'=> 'C12345',
                'search_city' => 1,
            ],
            [
                'Accept' => 'application/json'
            ]
        );

        $response
            ->assertHeader('content-type', 'application/json')
            ->assertStatus(200)
            ->assertJsonStructure([
                'message',
                'user' => [
                    'username',
                    'id',
                ],
                'authorization' => [
                    'token',
                    'type',
                ],
            ]);
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_cannot_create_duplicate_user_a()
    {
        $response = $this->postJson(
            '/api/auth/register',
            [
                'username'=> 'adminA',
                'password'=> 'A12345',
            ],
            [
                'Accept' => 'application/json'
            ]
        );

        $response
            ->assertHeader('content-type', 'application/json')
            ->assertStatus(400)
            ->assertExactJson([
                "username" => [
                    "The username has already been taken."
                ]
            ]);
    }

    public function test_valid_login_user_a()
    {
        $response = $this->postJson(
            '/api/auth/login',
            [
                'username'=> 'adminA',
                'password'=> 'A12345',
            ],
            [
                'Accept' => 'application/json'
            ]
        );

        $this->deleteUser($response);

        $response
            ->assertHeader('content-type', 'application/json')
            ->assertStatus(200)
            ->assertJsonStructure([
                'user' => [
                    'id',
                    'username',
                    'search_province',
                    'search_city',
                ],
                'authorization' => [
                    'token',
                    'type',
                ],
            ]);
    }

    public function test_invalid_login_user_a()
    {
        $response = $this->postJson(
            '/api/auth/login',
            [
                'username'=> 'adminA',
                'password'=> 'XXXXXX',
            ],
            [
                'Accept' => 'application/json'
            ]
        );

        $response
            ->assertHeader('content-type', 'application/json')
            ->assertStatus(403)
            ->assertExactJson([
                'message' => 'Username or password wrong'
            ]);
    }

    public function test_valid_login_user_b()
    {
        $response = $this->postJson(
            '/api/auth/login',
            [
                'username'=> 'adminB',
                'password'=> 'B12345',
            ],
            [
                'Accept' => 'application/json'
            ]
        );

        $this->deleteUser($response);

        $response
            ->assertHeader('content-type', 'application/json')
            ->assertStatus(200)
            ->assertJsonStructure([
                'user' => [
                    'id',
                    'username',
                    'search_province',
                    'search_city',
                ],
                'authorization' => [
                    'token',
                    'type',
                ],
            ]);
    }

    public function test_invalid_login_user_b()
    {
        $response = $this->postJson(
            '/api/auth/login',
            [
                'username'=> 'adminB',
                'password'=> 'XXXXXX',
            ],
            [
                'Accept' => 'application/json'
            ]
        );

        $response
            ->assertHeader('content-type', 'application/json')
            ->assertStatus(403)
            ->assertExactJson([
                'message' => 'Username or password wrong'
            ]);
    }

    public function test_valid_login_user_c()
    {
        $response = $this->postJson(
            '/api/auth/login',
            [
                'username'=> 'adminC',
                'password'=> 'C12345',
            ],
            [
                'Accept' => 'application/json'
            ]
        );

        $this->deleteUser($response);

        $response
            ->assertHeader('content-type', 'application/json')
            ->assertStatus(200)
            ->assertJsonStructure([
                'user' => [
                    'id',
                    'username',
                    'search_province',
                    'search_city',
                ],
                'authorization' => [
                    'token',
                    'type',
                ],
            ]);
    }

    public function test_invalid_login_user_C()
    {
        $response = $this->postJson(
            '/api/auth/login',
            [
                'username'=> 'adminC',
                'password'=> 'XXXXXX',
            ],
            [
                'Accept' => 'application/json'
            ]
        );

        $response
            ->assertHeader('content-type', 'application/json')
            ->assertStatus(403)
            ->assertExactJson([
                'message' => 'Username or password wrong'
            ]);
    }
}
