<?php

namespace App\Models;

use DB;
use Illuminate\Database\Eloquent\Model;
use Log;

class Auto extends Model
{
    protected $table = 'Voertuig';

    protected $primaryKey = 'Id';

    public $timestamps = false;

    protected $fillable = [
        'Kenteken',
        'Type',
        'Bouwjaar',
        'Brandstof',
        'TypeVoertuigId',
        'Isactief',
        'Opmerking',
    ];

    public function getAlleInstructeurs()
    {
        try {
            return collect(DB::select('CALL KrijgAlleAutos()') ?? []);
        } catch (\Exception $e) {
            Log::error('Fout in getAlleInstructeurs: '.$e->getMessage());

            return collect([]);
        }
    }

    public function typeVoertuig()
    {
        try {
            $instructeurs = collect(DB::select('CALL KrijgAlleAutos()') ?? []);
        } catch (\Exception $e) {
            // Handle the exception, e.g., log the error or return a default value
            Log::error('Error fetching TypeVoertuig: '.$e->getMessage());
        }

        return $instructeurs;
    }

    /**
     * Haal alle voertuigen via de stored procedure `KrijgAlleVoertuigen`.
     */
    public function getAlleVoertuigen()
    {
        try {
            return collect(DB::select('CALL KrijgAlleVoertuigen()') ?? []);
        } catch (\Exception $e) {
            Log::error('Fout in getAlleVoertuigen: '.$e->getMessage());

            return collect([]);
        }
    }

    /**
     * Roep de stored procedure `VerwijderVoertuig` aan en retourneer de status string.
     * Mogelijke resultaten: 'not_found', 'active', 'deleted'.
     */
    public function verwijderViaSP($id)
    {
        try {
            $res = DB::select('CALL VerwijderVoertuig(?)', [$id]);

            if (is_array($res) && isset($res[0]) && isset($res[0]->status)) {
                return $res[0]->status;
            }

            return 'error';
        } catch (\Exception $e) {
            Log::error('Fout in verwijderViaSP: '.$e->getMessage());

            return 'error';
        }
    }

    public function InstructeurAuto($instructeurId)
    {
        // Initialiseer als een lege collectie voor het geval de database-call faalt
        $instructeurs = collect([]);

        try {
            // Geef de $instructeurId mee aan de Stored Procedure
            $instructeurs = collect(DB::select('CALL KrijgVoertuigenVanInstructeur(?)', [$instructeurId]) ?? []);
        } catch (\Exception $e) {
            Log::error('Error fetching InstructeurAuto: '.$e->getMessage());
        }

        return $instructeurs;
    }

    public function getVoertuigWijzigGegevens($id)
    {
        try {
            $data = DB::select('CALL KrijgVoertuigWijzigGegevens(?)', [$id]);

            return collect($data)->first();
        } catch (\Exception $e) {
            Log::error('Fout in getVoertuigWijzigGegevens: '.$e->getMessage());

            return null;
        }
    }

    /**
     * Haal alle actieve voertuigtypes op.
     */
    public function getAlleTypeVoertuigen()
    {
        try {
            return collect(DB::select('SELECT Id, TypeVoertuig FROM TypeVoertuig WHERE Isactief = 1'));
        } catch (\Exception $e) {
            Log::error('Fout in getAlleTypeVoertuigen: '.$e->getMessage());

            return collect([]);
        }
    }

    /**
     * Haal alle actieve instructeurs op met samengevoegde naam.
     */
    public function getActieveInstructeurs()
    {
        try {
            return collect(DB::select("
                SELECT Id, CONCAT_WS(' ', Voornaam, Tussenvoegsel, Achternaam) AS InstructeurNaam 
                FROM Instructeur 
            "));
        } catch (\Exception $e) {
            Log::error('Fout in getActieveInstructeurs: '.$e->getMessage());

            return collect([]);
        }
    }

    public function updateVoertuigGegevens($id, array $data)
    {
        try {
            DB::statement('CALL UpdateVoertuigGegevens(?, ?, ?, ?, ?, ?, ?)', [
                $id,
                $data['InstructeurId'],
                $data['TypeVoertuigId'],
                $data['Type'],
                $data['Bouwjaar'],
                $data['Brandstof'],
                $data['Kenteken'],
            ]);

            return true;
        } catch (\Exception $e) {
            Log::error('Fout in updateVoertuigGegevens via SP: '.$e->getMessage());

            return false;
        }
    }

    public function destroyCar($id)
    {
        try {
            return DB::select('CALL DeleteCar(?)', [$id]);

        } catch (\Exception $e) {
            Log::error('Fout in destroyCar: '.$e->getMessage());

            return 'error';
        }
    }
}
