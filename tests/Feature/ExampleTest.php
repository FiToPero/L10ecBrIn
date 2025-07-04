<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;

use App\Models\Product;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    use RefreshDatabase;

    public function test_the_application_returns_a_successful_response(): void
    {
        $products = Product::all();

        $response = $this->get(route('welcome.index', ['products' => $products]));

        $response->assertStatus(200);
    }
}
