<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
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

    // Toon geleverde producten van een leverancier
    public function shows($leverancierId)
    {
        // Haal alle geleverde producten op via stored procedure
        $leverantie = ProductModel::sp_getGeleverdeProductenPerLeverancier($leverancierId);

        return view('leverdeProducten.index', [
            'productNaam' => $leverantie[0]->LeverancierNaam ?? 'Onbekend',
            'leverantie' => $leverantie,
            'leverancierId' => $leverancierId,
        ]);
    }

    // Toon formulier voor nieuwe levering
    public function create($leverancierId, $productId)
{
    // Haal product info op
    $productNaam = DB::table('Product')->where('Id', $productId)->value('Naam');

    // Haal leverancier info op
    $leverantie = DB::table('Leverancier')->where('Id', $leverancierId)->get();

    return view('leverdeProducten.create', [
        'leverancierId' => $leverancierId,
        'productId' => $productId,
        'productNaam' => $productNaam,
        'leverantie' => $leverantie,
    ]);
}

    // Opslaan van nieuwe levering
    public function store(Request $request)
    {
        // 1️⃣ Valideer de input
        $request->validate([
            'LeverancierId' => 'required|integer',
            'ProductId' => 'required|integer',
            'AantalProductHeden' => 'required|integer|min:1',
            'DatumEerstvolgendeLevering' => 'required|date',
        ]);

        // 2️⃣ Opslaan in DB via stored procedure
        DB::statement('CALL sp_CreateLeveringProduct(?, ?, ?, ?)', [
            $request->LeverancierId,
            $request->ProductId,
            $request->AantalProductHeden,
            $request->DatumEerstvolgendeLevering
        ]);

        // 3️⃣ Redirect naar de pagina van de leverancier
        return redirect()->route('leverdeProducten.index', [
            'leverdeProduct' => $request->LeverancierId
        ])->with('success', 'Product is succesvol toegevoegd!');
    }
}
