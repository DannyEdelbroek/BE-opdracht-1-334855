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
        $auto = $this->autoModel->getAlleInstructeurs();

        return view('instructeur.index', compact('auto'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($Id)
    {
        // Haal instructeur-informatie op
        $instructeur = $this->autoModel->KrijgInstructeur($Id);

        // Haal vrije voertuigen op voor deze instructeur
        $voertuigen = $this->autoModel->getVrijeVoertuig() ?? [];

        return view('auto.create', [
            'instructeur' => $instructeur,
            'voertuigen' => $voertuigen,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Valideer de invoer
        $validated = $request->validate([
            'VoertuigId' => 'required|integer',
            'InstructeurId' => 'required|integer',
        ]);

        // Geef de gevalideerde data door aan het model om de SP uit te voeren
        $success = $this->autoModel->voegVoertuigToe($validated);

        if ($success) {
            return redirect()->route('auto.index')->with('success', 'Voertuig succesvol toegevoegd.');
        } else {
            return redirect()->back()->with('error', 'Er ging iets mis bij het toevoegen van het voertuig.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        // Roep de functie aan uit je model (pas 'JouwModel' aan naar de echte naam van je model)
        $data = $this->autoModel->InstructeurAuto($id);

        // Pak de instructeur (dit is altijd het eerste object in de collectie, als hij bestaat)
        $instructeur = $data->first();

        // Filter de voertuigen: we pakken alleen de objecten waar écht een VoertuigID in zit
        $voertuigen = $data->filter(function ($item) {
            return isset($item->VoertuigID) && ! is_null($item->VoertuigID);
        });

        // Stuur beide variabelen netjes apart naar je Blade view
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
    public function Auto()
    {
        $voertuigen = $this->autoModel->getAlleVoertuigen();

        return view('auto.AllAutos', compact('voertuigen'));
    }

    public function destroy($id)
    {
        if (! $id) {
            return redirect()->back()->with('error', 'Geen voertuig opgegeven.');
        }

        $status = $this->autoModel->verwijderViaSP($id);

        if ($status === 'not_found') {
            return redirect()->back()->with('error', 'Voertuig niet gevonden.');
        }

        if ($status === 'active') {
            return redirect()->back()->with('error', 'Dit voertuig is actief en kan niet verwijderd worden.');
        }

        if ($status === 'deleted') {
            return redirect()->route('auto.AllAutos')->with('success', 'Voertuig succesvol verwijderd.');
        }

        return redirect()->back()->with('error', 'Er ging iets mis bij het verwijderen van het voertuig.');
    }

    public function destroyAll($id)
    {
        // 1. Roep de methode aan die de Stored Procedure uitvoert
        // (Vervang $this->voertuigService eventueel naar hoe jij die functie aanroept)
        $result = $this->autoModel->destroyCar($id);

        // 2. Controleer of de service 'error' heeft teruggegeven
        if ($result === 'error') {
            // Stuur de gebruiker terug met een foutmelding
            return redirect()
                ->route('auto.show', ['id' => $id])
                ->with('error', 'Het voertuig kon niet worden verwijderd. Er is iets misgegaan of het voertuig bestaat niet.');
        }

        // 3. Als alles goed is gegaan, stuur terug met een succesmelding
        return redirect()
            ->route('auto.index')
            ->with('success', 'Voertuig is succesvol verwijderd!');
    }
}
