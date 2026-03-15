<?php

namespace Tests\Unit;

use App\Http\Controllers\ProductController;
use App\Models\Product;
use Mockery;
use Tests\TestCase;

class ProductOverviewTest extends TestCase
{
    protected function tearDown(): void
    {
        Mockery::close();
        parent::tearDown();
    }

    public function test_index_returns_correct_view_and_data()
    {
        // Arrange: fake data
        $fakeProducts = [
            (object) [
                'ProductId' => 1,
                'LeverancierId' => 1,
                'LeverancierNaam' => 'Supplier A',
                'ContactPersoon' => 'John Doe',
                'ProductNaam' => 'Product 1',
                'TotaalGeleverd' => 100,
                'Specificatie' => 'Allergen 1, Allergen 2'
            ],
            (object) [
                'ProductId' => 2,
                'LeverancierId' => 2,
                'LeverancierNaam' => 'Supplier B',
                'ContactPersoon' => 'Jane Smith',
                'ProductNaam' => 'Product 2',
                'TotaalGeleverd' => 200,
                'Specificatie' => null
            ]
        ];

        // Mock the model
        $modelMock = Mockery::mock(Product::class);
        $modelMock->shouldReceive('sp_GetAllProductsOverview')
            ->once()
            ->with(1, 4, null, null)
            ->andReturn($fakeProducts);

        // Mock request parameters
        request()->merge([
            'page' => 1,
            'pageSize' => 4,
            'startdatum' => null,
            'einddatum' => null
        ]);

        // Instantiate controller with mocked model
        $controller = new ProductController($modelMock);

        // Act
        $response = $controller->index();

        // Assert: correct view and data
        $this->assertEquals('products.index', $response->name());
        $data = $response->getData();
        $this->assertEquals('Overzicht geleverde Products', $data['title']);
        $this->assertEquals($fakeProducts, $data['products']);
        $this->assertEquals(1, $data['currentPage']);
        $this->assertEquals(4, $data['pageSize']);
    }

    public function test_index_with_dates_filters_correctly()
    {
        // Arrange
        $fakeProducts = [
            (object) [
                'ProductId' => 1,
                'LeverancierId' => 1,
                'LeverancierNaam' => 'Supplier A',
                'ContactPersoon' => 'John Doe',
                'ProductNaam' => 'Product 1',
                'TotaalGeleverd' => 50,
                'Specificatie' => 'Allergen 1'
            ]
        ];

        $modelMock = Mockery::mock(Product::class);
        $modelMock->shouldReceive('sp_GetAllProductsOverview')
            ->once()
            ->with(1, 4, '2023-01-01', '2023-12-31')
            ->andReturn($fakeProducts);

        request()->merge([
            'page' => 1,
            'pageSize' => 4,
            'startdatum' => '2023-01-01',
            'einddatum' => '2023-12-31'
        ]);

        $controller = new ProductController($modelMock);

        // Act
        $response = $controller->index();

        // Assert
        $this->assertEquals('products.index', $response->name());
        $data = $response->getData();
        $this->assertEquals($fakeProducts, $data['products']);
    }
}
