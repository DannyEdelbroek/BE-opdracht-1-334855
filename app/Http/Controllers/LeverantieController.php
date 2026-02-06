<?php

namespace App\Http\Controllers;

use App\Models\LeverantieModel;
use Exception;
use Illuminate\Http\Request;
use Log;

class LeverantieController extends Controller
{
    private LeverantieModel $LeverantieModel;

    public function __construct(LeverantieModel $LeverantieModel)
    {
        $this->LeverantieModel = $LeverantieModel;
    }

    public function index()
    {
        $pageNumber = request()->input('page', 1);
        $pageSize = request()->input('pageSize', 4);
        $allergeen = request()->input('allergeen'); // filter uit dropdown

        $Allergeens = $this->LeverantieModel->sp_GetAllAllergeenOverzicht(
            $pageNumber,
            $pageSize,
            $allergeen
        );

        $AllergeenNamen = $this->LeverantieModel->getAllAllergeenNamen();

        return view('leverancierOverzicht.index', [
            'title' => 'Overzicht Allergeen',
            'Allergeens' => $Allergeens,
            'AllergeenNamen' => $AllergeenNamen,
            'currentPage' => $pageNumber,
            'pageSize' => $pageSize,
        ]);
    }

    public function show($Id)
    {

        $leverancier = LeverantieModel::sp_GetIdLeverancier($Id);

        if (! $leverancier) {
            abort(404);
        }

        return view('leverancierOverzicht.show', [
            'title' => 'Overzicht Leverancier gegevens',
            'leverancier' => $leverancier,
        ]);
    }

    public function indexLeverancier()
    {
        $pageNumber = request()->input('page', 1);
        $pageSize = request()->input('pageSize', 4);

        $leveranties = $this->LeverantieModel->sp_GetAllLeverancier(
            $pageNumber,
            $pageSize
        );

        return view('leverancier.leverancierOverzicht', [
            'title' => 'Overzicht leverancier',
            'leveranties' => $leveranties,
            'currentPage' => $pageNumber,
            'pageSize' => $pageSize,
        ]);
    }
}
