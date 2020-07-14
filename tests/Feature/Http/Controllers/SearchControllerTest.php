<?php

namespace Tests\Feature\Http\Controllers;

use App\Search;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\SearchController
 */
class SearchControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function index_behaves_as_expected()
    {
        $searches = factory(Search::class, 3)->create();

        $response = $this->get(route('search.index'));
    }
}
