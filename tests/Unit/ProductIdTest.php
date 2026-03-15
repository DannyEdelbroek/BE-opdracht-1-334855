<?php

namespace Tests\Unit;

use App\Http\Controllers\ProductController;
use App\Models\Product;
use Mockery;
use Tests\TestCase;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ProductIdTest extends TestCase
{
    protected function tearDown(): void
    {
        Mockery::close();
        parent::tearDown();
    }

    public function test_show_returns_correct_view_and_data()
    {
        // Fake data
        $fakeProducts = [
            (object) [
                'ProductId' => 1,
                'ProductNaam' => 'Product 1',
                'TotaalGeleverd' => 100,
                'Specificatie' => 'Allergen 1'
            ],
            (object) [
                'ProductId' => 2,
                'ProductNaam' => 'Product 2',
                'TotaalGeleverd' => 50,
                'Specificatie' => null
            ]
        ];

        // Mock model
        $modelMock = Mockery::mock(Product::class);
        $modelMock->shouldReceive('sp_GetProductId')
                  ->once()
                  ->with(1)
                  ->andReturn($fakeProducts);

        // Controller with mocked model
        $controller = new ProductController($modelMock);

        // Act
        $response = $controller->show(1);

        // Assert: correct view and data
        $this->assertEquals('products.show', $response->name());
        $data = $response->getData();
        $this->assertEquals('Specificatie geleverde Products', $data['title']);
        $this->assertEquals($fakeProducts, $data['products']);
    }

    public function test_show_throws_404_when_no_products_found()
    {
        // Mock model to return null
        $modelMock = Mockery::mock(Product::class);
        $modelMock->shouldReceive('sp_GetProductId')
                  ->once()
                  ->with(999)
                  ->andReturn(null);

        $controller = new ProductController($modelMock);

        // Act & Assert: should throw NotFoundHttpException (abort(404))
        $this->expectException(NotFoundHttpException::class);
        $controller->show(999);
    }
}
