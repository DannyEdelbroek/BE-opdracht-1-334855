<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Models\LeverantieModel;
use Illuminate\Http\Request;

class LeverantieController extends Controller
{

    private $LeverantieModel;
    public function __construct()
    {
        $this->LeverantieModel = new LeverantieModel();
    }
    public function index()
    {

         $leveranties = $this->LeverantieModel->sp_getOverzichtLeverantie();

        return view('leverancierOverzicht.index', [
            'title' => 'Overzicht leverancier',
            'leveranties'  => $leveranties,
        ]);
    }

    public function show($productNaam)
    {
        // Haal alle leverantie-informatie op voor dit product
        $leverantie = DB::select('CALL sp_GetLeveringsInformatie(?)', [$productNaam]);

        // Controleer of er resultaten zijn
        if (empty($leverantie)) {
            return view('leverancier.index', [
                'productNaam' => $productNaam,
                'leverantie'  => [],
            ]);
        }

        // Geef het product en leverancierinfo door aan de view
        return view('leverancier.index', [
            'productNaam' => $leverantie[0]->NaamProduct,
            'leverantie'  => $leverantie,
        ]);
    }
}
