<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use App\Models\ProductGallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.product.index');
    }
    public function getAllData(Request $request)    
    {
        if ($request->ajax()) {
            $data = Product::with('category')->select('*');
            return \Yajra\DataTables\DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {

                    $btn = '<a href="' . URL::route('product.edit', $row->id) . '"data-toggle="tooltip" data-original-title="Edit" class="btn btn-primary btn-sm editProduct">Edit</a>';
                    $btn = $btn . '<a href="javascript:void(0)"  data-id="' . $row->id . '" class="deleteProduct ms-2 btn btn-danger btn-sm">Delete</a>';

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
        $category = Category::all();
        return view('admin.product.create', compact('category'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
        // $photoName = time() . '.' . $request->photo->extension();
        // $request->photo->move(public_path('product'), $photoName);
        $product = new Product();
        $product->title = $request->title;
        $product->catId = $request->catId;
        $product->photo ="abc";
        $product->detail = $request->detail;
        $product->tag = $request->tag;
        if (isset($request->startDate))
            $product->startDate = $request->startDate;
        else
            $product->startDate = NULL;
        if (isset($request->endDate))

            $product->endDate = $request->endDate;
        else
            $product->endDate = NULL;
        if (isset($request->discount))
            $product->discount = $request->discount;
        else
            $product->discount = null;

        if ($request->isTrending == 'isTrending')
            $product->isTrending = 1;
        else
            $product->isTrending = 0;
        if ($request->isRecommend == 'isRecommend')
            $product->isRecommend = 1;
        else
            $product->isRecommend = 0;

        // $productId = $product->id;

        // if ($request->hasFile('gallery')) {
        //     foreach ($request->file('gallery') as $file) {
        //         $fileName = time() . '_' . $file->getClientOriginalName();
        //         $file->storeAs('public/gallery', $fileName);

        //         $productGallery = new ProductGallery();
        //         $productGallery->productId = $productId;
        //         $productGallery->photo = $fileName;
        //         $productGallery->save();
        //     }
        // }
        if ($product->save()) {
            return response()->json([
                'status' => 200,
            ]);
        } else {
            // Handle the case where saving the product failed
            return response()->json([
                'status' => 500, // You can use an appropriate status code for failure
                'message' => 'Failed to save the product.',
            ]);

        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $product = Product::find($id);
        $category = Category::all();
        return view('admin.product.edit', compact('product', 'category'));
    }

    /**
     * Update the specified resource in storage.
     */
    /**
 * Update the specified resource in storage.
 */
public function update(Request $request)
{
    // Find the existing product by ID
    $id = $request->product_id;
    $product = Product::find($id);

    

    // Update the product properties
    $product->title = $request->title;
    $product->catId = $request->catId;
    $product->photo = "abc"; // Update this with your photo logic
    $product->detail = $request->detail;
    $product->tag = $request->tag;
    // ...
    $product->save();
    // Save the updated product
    if ($product) {
        return response()->json([
            'status' => 200,
            'message' => 'Product updated successfully.',
        ]);
    } else {
        // Handle the case where updating the product failed
        return response()->json([
            'status' => 500,
            'message' => 'Failed to update the product.',
        ]);
    }
}

    /**
     * Remove the specified resource from storage.
     */
    public function delete($id)
    {
        Product::find($id)->delete();
    }
}
