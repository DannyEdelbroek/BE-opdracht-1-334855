<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

class ProductLeverancierIdTest extends TestCase
{
    private Product $productModel;

    protected function setUp(): void
    {
        parent::setUp();
        $this->productModel = new Product();
    }

    /**
     * Test that all products can be retrieved with pagination
     * (simulating the index functionality)
     */
    public function test_get_all_products_overview_with_pagination(): void
    {
        // Arrange
        $pageNumber = 1;
        $pageSize = 4;
        $startdatum = '2024-01-01';
        $einddatum = '2024-12-31';

        $mockResult = [
            (object)[
                'id' => 1,
                'naam' => 'Product 1',
                'beschrijving' => 'Test Product 1',
                'leverancierId' => 1
            ],
            (object)[
                'id' => 2,
                'naam' => 'Product 2',
                'beschrijving' => 'Test Product 2',
                'leverancierId' => 2
            ],
        ];

        // Mock the database call
        DB::shouldReceive('select')
            ->with(
                'CALL sp_GetAllProductsOverview(?, ?, ?, ?)',
                [$pageNumber, $pageSize, $startdatum, $einddatum]
            )
            ->once()
            ->andReturnUsing(function () use ($mockResult) {
                return $mockResult;
            });

        // Act
        $result = Product::sp_GetAllProductsOverview(
            $pageNumber,
            $pageSize,
            $startdatum,
            $einddatum
        );

        // Assert
        $this->assertIsArray($result);
        $this->assertCount(2, $result);
        $this->assertEquals('Product 1', $result[0]->naam);
        $this->assertEquals('Product 2', $result[1]->naam);
    }

    /**
     * Test that a specific product can be retrieved by ID
     * (simulating the show functionality)
     */
    public function test_get_product_by_id(): void
    {
        // Arrange
        $leverancierId = 1;

        $mockResult = [
            (object)[
                'id' => 1,
                'naam' => 'Product Detail',
                'beschrijving' => 'Detailed description of product',
                'leverancierId' => $leverancierId,
                'prijs' => 99.99,
                'stock' => 50
            ]
        ];

        DB::shouldReceive('select')
            ->with('CALL sp_GetProductId(?)', [$leverancierId])
            ->once()
            ->andReturnUsing(function () use ($mockResult) {
                return $mockResult;
            });

        // Act
        $result = $this->productModel->sp_GetProductId($leverancierId);

        // Assert
        $this->assertIsArray($result);
        $this->assertCount(1, $result);
        $this->assertEquals('Product Detail', $result[0]->naam);
        $this->assertEquals($leverancierId, $result[0]->leverancierId);
        $this->assertEquals(99.99, $result[0]->prijs);
    }

}
