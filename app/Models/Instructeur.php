<?php

namespace App\Models;

use DB;
use Illuminate\Database\Eloquent\Model;
use Log;

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
            return DB::statement('CALL ToggleInstructeurStatus(?)', [$id]);
        } catch (\Exception $e) {
            Log::error('Error toggling status for Instructeur ID '.$id.': '.$e->getMessage());
            throw $e;
        }
    }

    public function verwijderInstructeur($id)
    {
        try {
            $res = DB::select('CALL deleteInstructeur(?)', [$id]);

            if (is_array($res) && isset($res[0]) && isset($res[0]->status)) {
                return $res[0]->status;
            }

            return 'error';
        } catch (\Exception $e) {
            Log::error('Fout in verwijderViaSP: '.$e->getMessage());

            return 'error';
        }
    }
}
