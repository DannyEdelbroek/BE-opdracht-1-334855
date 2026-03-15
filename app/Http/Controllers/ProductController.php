<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    private Product $ProductModel;

    public function __construct(Product $ProductModel)
    {
        $this->ProductModel = $ProductModel;
    }

    public function index()
    {
        $pageNumber = request()->input('page', 1);
        $pageSize = request()->input('pageSize', 4);
        $startdatum = request()->input('startdatum');
        $einddatum = request()->input('einddatum');

        $products = $this->ProductModel->sp_GetAllProductsOverview(
            $pageNumber,
            $pageSize,
            $startdatum,
            $einddatum
        );

        return view('products.index', [
            'title' => 'Overzicht geleverde Products',
            'products' => $products,
            'currentPage' => $pageNumber,
            'pageSize' => $pageSize,
        ]);
    }

    public function show($Id)
    {
        $products = $this->ProductModel->sp_GetProductId($Id);
        if (! $products) {
            abort(404);
        }

        return view('products.show', [
            'title' => 'Specificatie geleverde Products',
            'products' => $products,
        ]);
    }
}
