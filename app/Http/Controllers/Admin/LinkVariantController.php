<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
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
    public function create()
    {
        //
        
        $optionGroups =  Optiongroup::all();
        $options =  Option::all();
        return view('Admin.LinkProduct.create', compact('optionGroups', 'options'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $id =  str::uuid();

        for ($i = 0; $i < count($request->optiongroup); $i++) {
            $opt = $request->optiongroup[$i];
            $title  = $request->title[$i];

            $linkVariant = new LinkVariant();
            $linkVariant->productGroup = $id;
            $linkVariant->optionGroup = $opt;
            $linkVariant->option = $title;
            $linkVariant->save();
                    
        }
        return redirect()->route('link.index');
          
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
