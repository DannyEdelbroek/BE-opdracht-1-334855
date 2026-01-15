<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class LeverantieModel extends Model
{
    public function sp_getOverzichtLeverancie()
    {
        $results = DB::select('CALL sp_getOverzichtLeverancie');

        return $results;
    }

    public static function sp_GetLeveringsInformatieById($productId)
    {
        return DB::select('CALL sp_GetLeveringsInformatie(?)', [$productId]);
    }

    public static function sp_GetAllLeverancier(
        $PageNumber,
        $PageSize
    )
    {
        $result = DB::select('CALL sp_GetAllLeverancier(?, ? )', [
            $PageNumber,
            $PageSize
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