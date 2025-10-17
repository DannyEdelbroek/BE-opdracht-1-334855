<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Models\ProductModel;

class ProductController extends Controller
{

    public function show($naam)
    {
        $allergenen = DB::select('CALL sp_GetAllergenenOverzicht(?)', [$naam]);

        return view('producten.index', [
            'productNaam' => $allergenen[0]->NaamProduct ?? $naam,
            'allergenen'  => $allergenen
        ]);
    }
}
