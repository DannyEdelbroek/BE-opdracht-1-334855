<?php

namespace App\Models;

use DB;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public static function sp_GetAllProductsOverview(
        $PageNumber,
        $PageSize,
        $p_startdatum,
        $p_einddatum 
    ) {
        
    return DB::select(
            'CALL sp_GetAllProductsOverview(?, ?, ?, ?)',
            [$PageNumber, $PageSize, $p_startdatum, $p_einddatum ]
        );
    }

    public function sp_GetProductId($p_LeverancierId)
    {
        $result = DB::select('CALL sp_GetProductId(?)', [$p_LeverancierId]);

        return $result ?? null;
    }
}
