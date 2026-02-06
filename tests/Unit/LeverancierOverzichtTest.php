<?php

namespace Tests\Unit;

use App\Http\Controllers\LeverantieController;
use App\Models\LeverantieModel;
use Mockery;
use Tests\TestCase;

class LeverancierOverzichtTest extends TestCase
{
    protected function tearDown(): void
    {
        Mockery::close();
        parent::tearDown();
    }

    public function test_index_LeverancierOverzichtTest_returns_correct_view_and_data()
    {
        // Arrange: fake data
        $fakeAllergeenOverzicht = [
            ['id' => 1, 'Munt' => 'Sweet', 4 => 'Dit is geweldig'],
            ['id' => 2, 'mintje' => 'zoet', 4 => 'Dit is niet goed'],
        ];

        $fakeAllergeenNamen = [
            'Lactose',
            'Soja',
            'Gluten'
        ];

        // Mock het model
        $modelMock = Mockery::mock(LeverantieModel::class);
        $modelMock->shouldReceive('sp_GetAllAllergeenOverzicht')
            ->once()
            ->with(1, 4, null) // derde argument is null, zoals in de controller
            ->andReturn($fakeAllergeenOverzicht);

        $modelMock->shouldReceive('getAllAllergeenNamen')
            ->once()
            ->andReturn($fakeAllergeenNamen);

        // Mock de request parameters (optioneel)
        request()->merge([
            'page' => 1,
            'pageSize' => 4,
            'allergeen' => null
        ]);

        // Controller instantiëren met het gemockte model
        $controller = new LeverantieController($modelMock);

        // Act: call de index methode
        $response = $controller->index();

        // Assert: controleer view name
        $this->assertEquals(
            'leverancierOverzicht.index',
            $response->name()
        );

        // Assert: controleer view data
        $data = $response->getData();
        $this->assertEquals('Overzicht Allergeen', $data['title']);
        $this->assertEquals($fakeAllergeenOverzicht, $data['Allergeens']);
        $this->assertEquals($fakeAllergeenNamen, $data['AllergeenNamen']);
        $this->assertEquals(1, $data['currentPage']);
        $this->assertEquals(4, $data['pageSize']);
    }
}
