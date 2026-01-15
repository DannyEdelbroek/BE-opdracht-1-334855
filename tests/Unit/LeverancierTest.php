<?php

namespace Tests\Unit;

use App\Http\Controllers\LeverantieController;
use App\Models\LeverantieModel;
use Mockery;
use Tests\TestCase;

class LeverancierTest extends TestCase
{
    protected function tearDown(): void
    {
        Mockery::close();
        parent::tearDown();
    }

    public function test_index_leverancier_returns_correct_view_and_data()
    {
        // Arrange
        $fakeLeveranciers = [
            ['id' => 1, 'Naam' => 'Venci', 'ContactPersoon' => 'Jan Jansen', 'LeverancierNummer' => 'LS87654321'],
            ['id' => 2, 'Naam' => 'Astraw Sweets', 'ContactPersoon' => 'Piet Polder', 'LeverancierNummer' => 'LS12345678'],
        ];

        $modelMock = Mockery::mock(LeverantieModel::class);
        $modelMock->shouldReceive('sp_GetAllLeverancier')
            ->once()
            ->with(1, 4)
            ->andReturn($fakeLeveranciers);

      

        $controller = new LeverantieController($modelMock);

        // Act
        $response = $controller->indexLeverancier();

        // Assert: view name
        // Assert: view name
        $this->assertEquals(
            'leverancier.leverancierOverzicht',
            $response->name()
        );

        // Assert: view data
        $data = $response->getData();
        $this->assertEquals('Overzicht leverancier', $data['title']);
        $this->assertEquals($fakeLeveranciers, $data['leveranties']);
        $this->assertEquals(1, $data['currentPage']);
        $this->assertEquals(4, $data['pageSize']);
    }
}
