<?php

namespace App\Http\Controllers;

use App\Models\Auto;
use Illuminate\Http\Request;

class AutoController extends Controller
{
    protected $autoModel;

    public function __construct(Auto $autoModel)
    {
        $this->autoModel = $autoModel;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $auto = $this->autoModel->typeVoertuig();

        return view('auto.index', compact('auto'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        // 1. Haal de data van de specifieke instructeur op via het model
        $data = $this->autoModel->InstructeurAuto($id);

        // 2. Splits de data op voor de Blade view (net als in het vorige voorbeeld)
        $instructeur = $data->first();
        $voertuigen = $data;

        // 3. Stuur beide variabelen netjes mee naar de view
        return view('auto.show', compact('instructeur', 'voertuigen'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        // 1. Vraag het model om de specifieke voertuigdata
        $voertuig = $this->autoModel->getVoertuigWijzigGegevens($id);

        if (! $voertuig) {
            return redirect()->back()->with('error', 'Voertuig niet gevonden.');
        }

        // 2. Vraag het model om de dropdown data
        $types = $this->autoModel->getAlleTypeVoertuigen();
        $instructeurs = $this->autoModel->getActieveInstructeurs();

        return view('auto.edit', compact('voertuig', 'types', 'instructeurs'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Valideer de invoer
        $validated = $request->validate([
            'InstructeurId' => 'required|integer',
            'TypeVoertuigId' => 'required|integer',
            'Type' => 'required|string|max:50',
            'Bouwjaar' => 'required|date',
            'Brandstof' => 'required|string|in:Diesel,Benzine,Elektrisch',
            'Kenteken' => 'required|string|max:10',
        ]);

        // Geef de gevalideerde data door aan het model om de SP uit te voeren
        $success = $this->autoModel->updateVoertuigGegevens($id, $validated);

        if ($success) {
            return redirect()->route('auto.index')->with('success', 'Voertuiggegevens succesvol bijgewerkt.');
        } else {
            return redirect()->back()->with('error', 'Er ging iets mis bij het bijwerken van de voertuiggegevens.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Auto $auto)
    {
        //
    }
}
