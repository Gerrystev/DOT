<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use \App\Models\User;

class CitySearchTest extends TestCase
{
        // User A -> can search cities and cities
    // User B -> can search cities only
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

    private function searchCityWithUser($username, $password, $search_province=0, $search_city=0, $id=1)
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
                '/api/search/cities?id=' . $id,
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
    public function test_user_a_can_search_cities()
    {
        $response = $this->searchCityWithUser('adminA', 'A12345', 1, 1);

        $response
            ->assertHeader('content-type', 'application/json')
            ->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    'city_id',
                    'province_id',
                    'province',
                    'type',
                    'city_name',
                    'postal_code',
                ],
            ]);
    }

    public function test_user_a_search_invalid_cities()
    {
        $response = $this->searchCityWithUser('adminA', 'A12345', 1, 1, 'xxxxx');

        $response
            ->assertHeader('content-type', 'application/json')
            ->assertStatus(404);
    }

    public function test_user_b_cannot_search_cities()
    {
        $response = $this->searchCityWithUser('adminB', 'B12345', 1);

        $response
            ->assertHeader('content-type', 'application/json')
            ->assertStatus(401);
    }

    public function test_user_c_can_search_cities()
    {
        $response = $this->searchCityWithUser('adminC', 'C12345', 0, 1);

        $response
            ->assertHeader('content-type', 'application/json')
            ->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    'city_id',
                    'province_id',
                    'province',
                    'type',
                    'city_name',
                    'postal_code',
                ],
            ]);
    }
}
