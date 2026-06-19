<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Instructeur extends Model
{
    protected $table = 'Instructeur';

    protected $primaryKey = 'Id';

    public $timestamps = false;

    protected $fillable = [
        'Voornaam',
        'Tussenvoegsel',
        'Achternaam',
        'Mobiel',
        'DatumInDienst',
        'AantalSterren',
        'Isactief',
        'Opmerking',
    ];

    public function toggleStatusInstructeur($id)
    {
        try {
            // Gebruik statement voor updates/stored procedures zonder return data
            return \DB::statement('CALL ToggleInstructeurStatus(?)', [$id]);
        } catch (\Exception $e) {
            \Log::error('Error toggling status for Instructeur ID '.$id.': '.$e->getMessage());
            throw $e;
        }
    }
}
