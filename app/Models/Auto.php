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

    /**
     * Haal alle voertuigen via de stored procedure `KrijgAlleVoertuigen`.
     */
    public function getAlleVoertuigen()
    {
        try {
            return collect(DB::select('CALL KrijgAlleVoertuigen()') ?? []);
        } catch (\Exception $e) {
            Log::error('Fout in getAlleVoertuigen: '.$e->getMessage());
        }

        return collect([]);
    }

    public function voegVoertuigToe(array $data)
    {
        try {
            $result = DB::select('CALL VoegVoertuigToe(?, ?)', [
                $data['VoertuigId'],
                $data['InstructeurId'],
            ]);

            return $result;
        } catch (\Exception $e) {
            Log::error('Fout in voegVoertuigToe via SP: '.$e->getMessage());
        }

        return false;
    }

    public function KrijgInstructeur($InstructeurId)
    {
        try {
            $results = DB::select('CALL KrijgInstructeur(?)', [$InstructeurId]);

            return collect($results)->first();
        } catch (\Exception $e) {
            Log::error('Fout in KrijgInstructeur: '.$e->getMessage());
        }
    }

    public function getVrijeVoertuig()
    {
        try {
            $vrijeVoertuigen = DB::select('CALL KrijgAlleVrijeVoertuigen()') ?? [];
        } catch (\Exception $e) {
            Log::error('Fout in KrijgAlleVrijeVoertuigen: '.$e->getMessage());
        }

        return $vrijeVoertuigen;
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
        try {
            // 1. Haal de resultaten op uit de Stored Procedure
            $resultaten = DB::select('CALL KrijgVoertuigenVanInstructeur(?)', [$instructeurId]);

            // Als de database wat teruggeeft én het eerste resultaat heeft een echt VoertuigID...
            if (! empty($resultaten) && ! is_null($resultaten[0]->VoertuigID)) {
                return collect($resultaten);
            }

            // 2. Als de SP niks teruggeeft (of een lege rij), halen we alleen de basisgegevens van de instructeur op
            $instructeur = DB::select(
                'SELECT Id AS InstructeurID, Voornaam, Tussenvoegsel, Achternaam, DatumInDienst, AantalSterren, IsActief 
             FROM Instructeur WHERE Id = ?',
                [$instructeurId]
            );

            if (! empty($instructeur)) {
                // We returnen één object in een collectie, maar ZONDER de lege voertuig-velden
                return collect([$instructeur[0]]);
            }

        } catch (\Exception $e) {
            Log::error('Error fetching InstructeurAuto: '.$e->getMessage());
        }

        return collect([]);
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
