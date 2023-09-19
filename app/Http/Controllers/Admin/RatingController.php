<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Rating;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Request;

class RatingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return view('admin.rating.index');
    }
    public function getAllData(Request $request)
    {
        if ($request->ajax()) {
            $data = DB::table('ratings')
            ->crossJoin('users')
            ->crossJoin('products')
            ->select('ratings.*', 'users.name', 'users.email', 'products.title')
            ->where('ratings.productId','=',DB::raw('products.id'))
            ->where('ratings.userId','=',DB::raw('users.id'));
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
    public function store(StoreRatingRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Rating $rating)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Rating $rating)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRatingRequest $request, Rating $rating)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Rating $rating)
    {
        //
    }
}
