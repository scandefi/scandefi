<?php

namespace Tests\Unit\Http\Controllers;

use Tests\TestCase;
use Illuminate\Testing\Fluent\AssertableJson;


class TokenControllerTest extends TestCase
{
    /**
     * test_loading_blacklist_from_database
     *
     *
     * @return void
     */
    public function test_loading_blacklist_from_database()
    {
        $current = 3;
        $perpage = 20;
        $sort_order = 'desc';
        $sort_field = 'lastreport';

        $response = $this->post('/api/tokens/blacklist?page=' . $current, [
            'filters' => [
                'perpage' => $perpage,
                'sort_order' => $sort_order,
                'sort_field' => $sort_field
            ],
            'with_count' => 'reports,comments'
        ]);

        $response
            ->assertOk()
            ->assertJson(
                fn (AssertableJson $json) =>
                $json->where('current_page', 3)
                    ->has('data')
                    ->etc()
            );
    }

    /**
     * test_get_a_token_in_the_blacklist
     *
     * @return void
     */
    public function test_get_a_token_in_the_blacklist()
    {
        $token = '0x0487fe9ee79bb9312373aed2901dce58d76bd48a';  // SHIBA TRON

        $response = $this->get('/api/tokens/' . $token . '/scanner');

        $response
            ->assertOk()
            ->assertJson(
                fn (AssertableJson $json) =>
                $json
                    ->has('token', 17)  // If token is, its length is 17
                    ->has('reports')

            );
    }
}
