<?php

namespace Tests\Unit;

use App\Http\Controllers\LeverantieController;
use App\Models\LeverantieModel;
use Mockery;
use Tests\TestCase;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class LeverancierIdTest extends TestCase
{
    protected function tearDown(): void
    {
        Mockery::close();
        parent::tearDown();
    }

    public function test_show_Leverancier_returns_correct_view_and_data()
    {
        // Fake data
        $fakeLeverancier = [
            'Id' => 1,
            'LeverancierNaam' => 'Venci',
            'ContactPersoon' => 'Jan Jansen',
            'Mobiel' => '0612345678',
            'Straat' => 'Dorpsstraat',
            'Huisnummer' => '12A',
            'Stad' => 'Amsterdam',
        ];

        // Mock model
        $modelMock = Mockery::mock(LeverantieModel::class);
        $modelMock->shouldReceive('sp_GetIdLeverancier')
                  ->once()
                  ->with(1)
                  ->andReturn($fakeLeverancier);

        // Controller met gemockt model
        $controller = new LeverantieController($modelMock);

        // Act
        $response = $controller->show(1);

        // Assert: juiste view en data
        $this->assertEquals('leverancierOverzicht.show', $response->name());
        $data = $response->getData();
        $this->assertEquals('Overzicht Leverancier gegevens', $data['title']);
        $this->assertEquals($fakeLeverancier, $data['leverancier']);
    }

    public function test_show_Leverancier_returns_404_when_not_found()
    {
        // Mock dat er geen leverancier is
        $modelMock = Mockery::mock(LeverantieModel::class);
        $modelMock->shouldReceive('sp_GetIdLeverancier')
                  ->once()
                  ->with(999)
                  ->andReturn(null);

        $controller = new LeverantieController($modelMock);

        // Verwacht NotFoundHttpException
        $this->expectException(NotFoundHttpException::class);

        // Act
        $controller->show(999);
    }
}
