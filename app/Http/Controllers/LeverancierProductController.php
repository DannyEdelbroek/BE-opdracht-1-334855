<?php

namespace App\Http\Controllers;

use App\Models\LeverancierProduct;

class LeverancierProductController extends Controller
{
    private LeverancierProduct $LeverancierProductModel;

    public function __construct(LeverancierProduct $LeverancierProductModel)
    {
        $this->LeverancierProductModel = $LeverancierProductModel;
    }

    public function index()
    {
        $pageNumber = request()->input('page', 1);
        $pageSize = request()->input('pageSize', 4);
        $startdatum = request()->input('startdatum');
        $einddatum = request()->input('einddatum');

        $products = $this->LeverancierProductModel->GetAllProductsLeverancierOverview(
            $pageNumber,
            $pageSize,
            $startdatum,
            $einddatum
        );

        return view('LeverancierProduct.index', [
            'title' => 'Overzicht producten uit het assortiment',
            'products' => $products,
            'currentPage' => $pageNumber,
            'pageSize' => $pageSize,
        ]);
    }

    public function show($Id)
    {
        $products = $this->LeverancierProductModel->GetIdProductsLeverancier($Id);
        if (! $products) {
            abort(404);
        }

        return view('LeverancierProduct.show', [
            'title' => 'Product',
            'products' => $products,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($Id)
    {
        $result = $this->LeverancierProductModel->DeleteProduct($Id);

        if ($result->success) {
            return redirect()->route('LeverancierProduct.index')
                ->with('success', $result->message);
        } else {
            return redirect()->back()
                ->with('error', $result->message); // <- geen withErrors, gewoon error
        }
    }
}
