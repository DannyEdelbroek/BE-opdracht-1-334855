<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ProductModel extends Model
{
    public static function getAllergenenOverzichtById($productId)
    {
        return DB::select('CALL sp_GetAllergenenOverzicht(?)', [$productId]);
    }

    protected $table = 'producten'; // Optioneel: pas aan indien nodig
    public $timestamps = false;

    // Haal alle geleverde producten per leverancier op via stored procedure
    public static function sp_getGeleverdeProductenPerLeverancier($leverdeProduct)
    {
        return DB::select('CALL sp_getGeleverdeProductenPerLeverancier(?)', [$leverdeProduct]);
    }
}




