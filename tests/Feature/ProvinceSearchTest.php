<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use \App\Models\User;

class ProvinceSearchTest extends TestCase
{
    // User A -> can search provinces and cities
    // User B -> can search provinces only
    // User C -> can search cities only

    private function getAuthorization($data)
    {
        $response = $this->postJson(
            '/api/auth/login',
            $data,
            [
                'Accept' => 'application/json',
            ]
        );

        return $response->getData()->authorization->type . ' ' . $response->getData()->authorization->token;
    }

    private function searchProvinceWithUser($username, $password, $search_province=0, $search_city=0, $id=1)
    {
        $user = User::factory()->create([
            'username' => $username,
            'password' => bcrypt($password),
            'search_province' => $search_province,
            'search_city' => $search_city,
        ])->make();

        $auth = $this->getAuthorization([
            'username' => $username,
            'password' => $password,
        ]);

        $response = $this->getJson(
                '/api/search/provinces?id=' . $id,
                [
                    'Accept' => 'application/json',
                    'Authorization' => $auth,
                ]
        );

        $res= User::where('username', $username)->delete();

        return $response;
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_user_a_can_search_provinces()
    {
        $response = $this->searchProvinceWithUser('adminA', 'A12345', 1, 1);

        $response
            ->assertHeader('content-type', 'application/json')
            ->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    'province_id',
                    'province',
                ],
            ]);
    }

    public function test_user_a_search_invalid_provinces()
    {
        $response = $this->searchProvinceWithUser('adminA', 'A12345', 1, 1, 'xxxxx');

        $response
            ->assertHeader('content-type', 'application/json')
            ->assertStatus(404);
    }

    public function test_user_b_can_search_provinces()
    {
        $response = $this->searchProvinceWithUser('adminB', 'B12345', 1);

        $response
            ->assertHeader('content-type', 'application/json')
            ->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    'province_id',
                    'province',
                ],
            ]);
    }

    public function test_user_c_cannot_search_provinces()
    {
        $response = $this->searchProvinceWithUser('adminC', 'C12345', 0, 1);

        $response
            ->assertHeader('content-type', 'application/json')
            ->assertStatus(401);
    }
}
