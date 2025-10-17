<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class AllergeenModel extends Model
{
    public function sp_GetAllergenen()
    {
        // stored procedure aanroepen
        $result = DB::select('CALL Sp_GetAllAllergenen()');

        // result altijd teruggeven
        return $result;
    }

    public function sp_CreateAllergeen($naam, $omschrijving)
    {
        $row = DB::selectOne(
            'CALL SP_CreateAllergeen(:name, :description)',
            [
                'name' => $naam,
                'description' => $omschrijving
            ]
        );

        return $row->new_id;
    }

    public function sp_DeleteAllergeen($id)
    {
        $result = DB::selectOne('CALL sp_DeleteAllergeen(:id)', [
            'id' => $id

        ]);
        return $result->affected;
    }

    public function SP_GetAllAllergeenId($id)
    {
        return DB::selectOne(
            'CALL SP_GetAllAllergeenId(:id)',
            [
                'id' => $id
            ]
        );
    }

    public function sp_UpdateAllergeen($id, $name, $description)
    {
        $row = DB::selectOne(
            'CALL sp_UpdateAllergeen(:id, :name, :description)',
            [
                'id' => $id,
                'name' => $name,
                'description' => $description,
            ]
        );

        return $row->affected ?? 0;
    }
}
