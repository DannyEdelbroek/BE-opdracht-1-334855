<?php

namespace App\Http\Controllers;

use App\Models\Instructeur;
use Illuminate\Http\Request;

class InstructeurController extends Controller
{
    protected $InstructeurModel;

    public function __construct(Instructeur $InstructeurModel)
    {
        $this->InstructeurModel = $InstructeurModel;
    }

    public function index()
    {
        //
    }

    public function toggleStatus($id)
    {
        try {
            $this->InstructeurModel->toggleStatusInstructeur($id);

            return redirect()
                ->route('auto.index')
                ->with('success', 'Instructeur status succesvol gewijzigd.');

        } catch (\Exception $e) {
            // Vang de fout op (bijv. "Instructeur niet gevonden") en toon deze aan de gebruiker
            return redirect()
                ->route('auto.index')
                ->with('error', 'Fout bij wijzigen status: '.$e->getMessage());
        }
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
    public function show(Instructeur $intructeur)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Instructeur $intructeur)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Instructeur $intructeur)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Instructeur $intructeur)
    {
        //
    }
}
