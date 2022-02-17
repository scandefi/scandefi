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
}
