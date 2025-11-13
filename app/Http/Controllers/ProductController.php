<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Models\ProductModel;

class ProductController extends Controller
{

    private $ProductModel;
    public function __construct()
    {
        $this->ProductModel = new ProductModel();
    }

    public function show($naam)
    {
        $allergenen = DB::select('CALL sp_GetAllergenenOverzicht(?)', [$naam]);

        return view('producten.index', [
            'productNaam' => $allergenen[0]->NaamProduct ?? $naam,
            'allergenen'  => $allergenen
        ]);
    }

    public function shows($leverdeProduct)
    {
        $leverantie = $this->ProductModel->sp_getGeleverdeProductenPerLeverancier($leverdeProduct);

        if (empty($leverantie)) {
            return view('leverdeProducten.index', [
                'productNaam' => $leverdeProduct,
                'leverantie'  => [],
            ]);
        }

        return view('leverdeProducten.index', [
            'productNaam' => $leverantie[0]->ProductNaam, // gebruik de property van SP
            'leverantie'  => $leverantie,
        ]);
    }
}
