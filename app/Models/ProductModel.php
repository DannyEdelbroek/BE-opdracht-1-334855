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
}
