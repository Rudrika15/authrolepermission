<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\LinkVariant;
use App\Models\Option;
use App\Models\Optiongroup;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
class LinkVariantController extends Controller
{
    public function index()
    {
        $productGroups =LinkVariant::groupBy('productGroup')
        ->get('productGroup');
        
        $data = [];
        foreach($productGroups as $product){
            $productOptions = LinkVariant::where('productGroup','=',$product->productGroup)->get();
            $newdata = [];
            $newdata['group'] = $product;
            $newdata['options'] = $productOptions;
            array_push($data,$newdata);
        }
 
        return view('Admin.LinkProduct.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        
        $category=Category::all();
        $categoryData=Category::all();
        $optionGroups =  Optiongroup::all();
        $options =  Option::all();
        return view('Admin.LinkProduct.create', compact('categoryData','optionGroups', 'options','category'));
    }

    /**
     * Store a newly created resource in storage.
     */
    // public function store(Request $request)
    // {
    //     $id =  str::uuid();
    //     $categoryId=$request->categoryId;
    //     for ($i = 0; $i < count($request->optiongroup); $i++) {
    //         $opt = $request->optiongroup[$i];
    //         $title  = $request->title[$i];
            

    //         $linkVariant = new LinkVariant();
    //         $linkVariant->productGroup = $id;
    //         $linkVariant->optionGroup = $opt;
    //         $linkVariant->option = $title;
    //         $linkVariant->categoryId=$categoryId;
    //         $linkVariant->save();
                    
    //     }
    //     return redirect()->route('link.index');
          
    // }
    public function store(Request $request)
{
    $id = Str::uuid();
    $categoryId = $request->categoryId;

    // Check if the inputs are present in the request
    if ($request->filled('optiongroup')  && $request->title) {
        $optionGroups = $request->input('optiongroup');
        $titles = $request->input('title');
        return response()->json([
            'data'=>[$optionGroups, $titles]
        ]);
        // Ensure that the option groups and titles have the same count
        if (count($optionGroups) !== count($titles)) {
            return response()->json([
                'messgae'=>"First Error"
            ]);
        }

        foreach ($optionGroups as $index => $opt) {
            // Create a new LinkVariant for each selected option
            $linkVariant = new LinkVariant();
            $linkVariant->productGroup = $id;
            $linkVariant->optionGroup = $opt;
            $linkVariant->option = $titles[$index]; // Assign the selected option
            $linkVariant->categoryId = $categoryId;
            $linkVariant->save();
        }
        return response()->json([
            'messgae'=>"Created"
        ]);
    } else {
        return response()->json([
            'messgae'=>"Last Error"
        ]);    
    }
}

    /**
     * Display the specified resource.
     */
    public function show(LinkVariant $linkVariant)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(LinkVariant $linkVariant)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, LinkVariant $linkVariant)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete($id)
    {
        // return $id;
        $linkVariantIds =  LinkVariant::where('productGroup','=',$id)->get();
        foreach($linkVariantIds as $linkVariantId)
        {
            $ids= $linkVariantId->id;
            $linkVariantDelete =  LinkVariant::find($ids)->delete();
        }
    return redirect()->back()->with("success", "Deleted Successfully");
    }
}
