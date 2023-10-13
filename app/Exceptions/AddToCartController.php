<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use App\Models\AddToCart;

use Symfony\Component\HttpFoundation\Request;

class AddToCartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        //
        // return  $data = AddToCart::select('*');
           
        return view('admin.cart.index');
    }
    public function getAllData(Request $request)
    {
        if ($request->ajax()) {
            $data = AddToCart::select('*');
            return \Yajra\DataTables\DataTables::of($data)
                ->make(true);
        }
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
    public function store(StoreAddToCartRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(AddToCart $addToCart)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(AddToCart $addToCart)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAddToCartRequest $request, AddToCart $addToCart)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AddToCart $addToCart)
    {
        //
    }
}
