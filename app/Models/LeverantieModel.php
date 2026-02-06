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

    public function sp_GetIdLeverancier($l_LeverancierId)
    {
        $result = DB::select('CALL sp_GetIdLeverancier(?)', [$l_LeverancierId]);

        return $result ?? null;
    }
}
