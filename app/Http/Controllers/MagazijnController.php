<?php

namespace App\Http\Controllers;

use App\Models\MagazijnModel;
use Illuminate\Http\Request;

class MagazijnController extends Controller
{
    private $magazijnModel;
    public function __construct()
    {
        $this->magazijnModel = new MagazijnModel();
    }

    
    public function index()
    {
         $products = $this->magazijnModel->sp_GetAllProducts();

        return view('magazijn.index', [
            'title'     => 'Overzicht Magazijn Jamin',
            'products' => $products,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(MagazijnModel $magazijnModel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(MagazijnModel $magazijnModel)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, MagazijnModel $magazijnModel)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MagazijnModel $magazijnModel)
    {
        //
    }
}
