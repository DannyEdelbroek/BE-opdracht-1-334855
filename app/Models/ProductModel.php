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
    public static function sp_getGeleverdeProductenPerLeverancier($leverancierId)
    {
        return DB::select('CALL sp_getGeleverdeProductenPerLeverancier(?)', [$leverancierId]);
    }

    public static function sp_getLeveringProdcuct($leverancierId)
    {
        return DB::select('CALL sp_getLeveringProdcuct(?)', [$leverancierId]);
    }

    public function sp_CreateLeveringProduct($leverancierId, $productId, $aantal, $datumEerstVolgendeLevering)
{
    $row = DB::selectOne(
        'CALL sp_CreateLeveringProduct(:leverancierId, :productId, :aantal, :datumEerstVolgendeLevering)',
        [
            'leverancierId' => $leverancierId,
            'productId' => $productId,
            'aantal' => $aantal,
            'datumEerstVolgendeLevering' => $datumEerstVolgendeLevering
        ]
    );

    return $row->new_id;
}
}
