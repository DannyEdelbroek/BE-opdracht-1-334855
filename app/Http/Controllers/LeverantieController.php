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
        $pageSize = request()->input('pageSize', 6);
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

    public function showLeverancier($contactId)
    {
        $leverancier = LeverantieModel::sp_getContactId($contactId);

        if (! $leverancier) {
            abort(404);
        }

        $title = 'Detail pagina Contact/leverancier';

        return view('leverancier.show', compact('leverancier', 'title'));
    }

    public function edit($contactId)
    {
        $leverancier = LeverantieModel::sp_getContactId($contactId);

        if (! $leverancier) {
            abort(404);
        }

        $title = 'Edit pagina';

        return view('leverancier.edit', compact('leverancier', 'title'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'ContactId' => 'integer',
            'Naam' => 'required|max:50',
            'ContactPersoon' => 'required|min:5|max:100',
            'LeverancierNummer' => 'required|min:8|max:20',
            'Mobiel' => 'required|min:11|max:20',
            'Straat' => 'required|max:100',
            'Huisnummer' => 'required|numeric|gte:1',
            'Postcode' => 'required|min:5|max:15',
            'Stad' => 'required|min:5|max:100',
        ]);

        try {
            $result = $this->LeverantieModel->sp_updateLeverancier(
                $id,
                $validatedData['Straat'],
                $validatedData['Huisnummer'],
                $validatedData['Postcode'],
                $validatedData['Stad'],
                $validatedData['Naam'],
                $validatedData['ContactPersoon'],
                $validatedData['LeverancierNummer'],
                $validatedData['Mobiel'],
            );

            if ($result['success']) {
                return redirect()->route('leverancier.edit', $id)
                    ->with('success', $result['message']);

            } else {
                return redirect()->route('leverancier.edit', $id)
                    ->with('warning', $result['message']);

            }

        } catch (Exception $e) {
            Log::warning('Leverancier wijzigen mislukt: '.$e->getMessage());
        }
    }
}
