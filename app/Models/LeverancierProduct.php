<?php

namespace App\Models;

use DB;
use Illuminate\Database\Eloquent\Model;

class LeverancierProduct extends Model
{
    public static function GetAllProductsLeverancierOverview(
        $PageNumber,
        $PageSize,
        $p_startdatum,
        $p_einddatum
    ) {

        return DB::select(
            'CALL sp_GetAllProductsLeverancierOverview(?, ?, ?, ?)',
            [$PageNumber, $PageSize, $p_startdatum, $p_einddatum]
        );
    }

    public function GetIdProductsLeverancier($p_ProductId)
    {
        $result = DB::select('CALL sp_GetIdProductsLeverancier(?)', [$p_ProductId]);

        return $result ?? null;
    }

    public function DeleteProduct($p_id)
    {
        // DB::select geeft altijd een array terug
        $result = DB::select('CALL sp_deleteProduct(?)', [$p_id]);

        // Pak het eerste element
        return $result[0] ?? null;
    }   
}
