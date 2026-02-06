<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class LeverantieModel extends Model
{
    public static function sp_GetAllAllergeenOverzicht(
        $PageNumber,
        $PageSize,
        $Allergeen = null
    ) {
        return DB::select(
            'CALL sp_GetAllAllergeenOverzicht(?, ?, ?)',
            [$PageNumber, $PageSize, $Allergeen]
        );
    }

    // Voor dropdown lijst
    public static function getAllAllergeenNamen()
    {
        return DB::select('SELECT DISTINCT Naam AS AllergeenNaam FROM Allergeen');
    }

    public static function sp_GetIdLeverancier($l_LeverancierId)
    {
        $result = DB::select('CALL sp_GetIdLeverancier(?)', [$l_LeverancierId]);

        return $result ?? null;
    }

    public static function sp_GetAllLeverancier(
        $PageNumber,
        $PageSize
    ) {
        $result = DB::select('CALL sp_GetAllLeverancier(?, ? )', [
            $PageNumber,
            $PageSize,
        ]);

        return $result;
    }

    public static function sp_getContactId($contactId)
    {
        $result = DB::select('CALL sp_getContactId(?)', [$contactId]);

        return $result[0] ?? null;
    }

    public function sp_updateLeverancier(
        $id,
        $Straat,
        $Huisnummer,
        $Postcode,
        $Stad,
        $Naam,
        $ContactPersoon,
        $LeverancierNummer,
        $Mobiel
    ) {
        // Procedure aanroepen met OUT parameter
        DB::statement(
            'CALL sp_updateLeverancier(?, ?, ?, ?, ?, ?, ?, ?, ?, @msg)',
            [
                $id,
                $Naam,
                $ContactPersoon,
                $LeverancierNummer,
                $Mobiel,
                $Straat,
                $Huisnummer,
                $Postcode,
                $Stad,
            ]
        );

        // OUT parameter ophalen
        $result = DB::selectOne('SELECT @msg AS message');

        return [
            'success' => $result->message === 'Leverancier is succesvol bijgewerkt.',
            'message' => $result->message,
        ];
    }
}
