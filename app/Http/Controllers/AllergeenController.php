<?php

namespace App\Http\Controllers;

use App\Models\AllergeenModel;
use Illuminate\Http\Request;
use Livewire\Attributes\Validate;

class AllergeenController extends Controller
{

    private $allergeenModel;
    public function __construct()
    {
        $this->allergeenModel = new AllergeenModel();
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $allergeen = $this->allergeenModel->sp_GetAllergenen();

        return view('allergeen.index', [
            'title'     => 'Allergeen Pagina',
            'allergeen' => $allergeen,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('allergeen.create', [
            'title' => 'Allergeen Toevoegen',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'Naam' => 'required|string|max:255',
            'Omschrijving' => 'required|string|max:255',
        ]);

        // Voeg het allergeen toe, resultaat niet nodig
        $this->allergeenModel->sp_CreateAllergeen(
            $data['Naam'],
            $data['Omschrijving']
        );
    
        return redirect()->route('allergeen.index')
            ->with('success', 'Allergeen succesvol toegevoegd!');
    }

    /**
     * Display the specified resource.
     */
    public function show(AllergeenModel $allergeenModel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(AllergeenModel $allergeenModel, $id)
    {
        $allergeens = $allergeenModel->SP_GetAllAllergeenId($id);
        abort_if(!$allergeens, 404);
        return view('allergeen.edit', [
            'title' => 'Allergeen Wijzigen',
            'allergeens' => $allergeens,
            
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, AllergeenModel $allergeenModel , $id)
    {
        $Validated = $request->validate([
            'naam' => ['required', 'string', 'max:50'],
            'omschrijving' => ['required', 'string', 'max:255']
        ]);

        $affected = $allergeenModel->sp_UpdateAllergeen(
            $id,
            $Validated['naam'],
            $Validated['omschrijving'],
        );

        if ($affected === 0) {
            return back()-with('error', 'Er is niet gewijzigd of item bestaat niet.');
        }

            return redirect()->route('allergeen.index')
            ->with('success', $Validated['naam'] . " ".'succesvol gewijzigd!');
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AllergeenModel $allergeenModel, $id)
    {
        $result = $allergeenModel->sp_DeleteAllergeen($id);

        if ($result > 0) {
            return redirect()->route('allergeen.index')
                ->with('success', 'Allergeen is succesvol verwijderd');
        }

        return redirect()->route('allergeen.index')
            ->with('error', 'Allergeen is niet verwijderd');
    }
}
