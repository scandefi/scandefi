<?php

namespace Tests\Unit\Http\Controllers;

use Tests\TestCase;
use Illuminate\Testing\Fluent\AssertableJson;

class ApiControllerTest extends TestCase
{
    /**
     * Search a token in the black list by name.
     *
     * @return void
     */
    public function test_search_a_token_in_the_black_list_by_name()
    {
        $search = 'SHIBA TRON';  // SHIBA TRON

        $response = $this->get('/api/tokens/search/' . $search);

        $response
            ->assertOk()
            ->assertJson(
                fn (AssertableJson $json) =>
                $json
                    ->has(
                        1,
                        fn ($json) =>
                        $json
                            ->where('name', 'SHIBA TRON')
                            ->where('fullname', 'SHIBA TRON (SHIBT)')
                            ->where('symbol', 'SHIBT')
                            ->where('address', '0x0487fe9ee79bb9312373aed2901dce58d76bd48a')
                            ->etc()
                    )
            );
    }
}
