<?php

namespace Tests\Feature\Admin\Products;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CreateProductTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_can_access_to_the_creation_route(): void
    {
        // Ejecutar el proceso que quiero probar
        $response = $this->get('/admin/products/create');

        // Hacer las validaciones
        $response->assertOk();
    }

    public function test_it_displays_a_product_creation_form(): void
    {
        // Ejecución
        $response = $this->get('/admin/products/create');

        // Validar
        $response->assertSee(trans('admin.products.titles.create'));
        $response->assertSee(trans('admin.products.fields.name'));
        $response->assertSee(trans('admin.products.fields.price'));
        $response->assertSee(trans('admin.products.fields.quantity'));
    }
}
