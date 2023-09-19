<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Whishlist;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Request;


class WhishlistController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return view ('admin.whishlist.index');
    }

    public function getAllData(Request $request)
    {
        if ($request->ajax()) {
            $data = DB::table('whishlists')
                ->crossJoin('users')
                ->crossJoin('products')
                ->select('whishlists.*', 'users.name', 'users.email', 'products.title')
                ->where('whishlists.productId', '=', DB::raw('products.id'))
                ->where('whishlists.userId', '=', DB::raw('users.id'));

            return \Yajra\DataTables\DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {

                    $btn = '<a href="javascript:void(0)" class=" btn btn-primary btn-sm">View</a>';
                    $btn = $btn . '<a href="javascript:void(0)" class=" btn btn-danger btn-sm">Delete</a>';

                    return  $btn;
                })
                ->rawColumns(['action'])
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
    public function store(StoreWhishlistRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Whishlist $whishlist)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Whishlist $whishlist)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateWhishlistRequest $request, Whishlist $whishlist)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Whishlist $whishlist)
    {
        //
    }
}
