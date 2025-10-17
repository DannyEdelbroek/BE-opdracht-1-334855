<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class MagazijnModel extends Model
{
    public function sp_GetAllProducts()
    {
        $results = DB::select('CALL sp_GetAllProducts');

        return $results;
}   
}
