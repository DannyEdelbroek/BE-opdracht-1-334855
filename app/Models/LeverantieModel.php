<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class LeverantieModel extends Model
{
    public function sp_getOverzichtLeverantie()
    {
        $results = DB::select('CALL sp_getOverzichtLeverantie');

        return $results;
    }

    public static function sp_GetLeveringsInformatieById($productId)
    {
        return DB::select('CALL sp_GetLeveringsInformatie(?)', [$productId]);
    }
}
