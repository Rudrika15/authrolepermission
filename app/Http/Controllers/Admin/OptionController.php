<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use App\Models\Option;
use App\Models\Optiongroup;
use Symfony\Component\HttpFoundation\Request;

class OptionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return  view('admin.option.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $optionGroup= Optiongroup::all();
      
        return  view('admin.option.create',compact('optionGroup'));
    }
    public function getAllData(Request $request)
    { {
            if ($request->ajax()) {
                $data = Option::with('optiongroup')->select('*');
                return \Yajra\DataTables\DataTables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function ($row) {
                        $btn = '<a href="' . URL::route('option.edit', $row->id) . '"data-toggle="tooltip" data-original-title="Edit" class="btn btn-primary btn-sm editOption">Edit</a>';
                        $btn = '<a href="javascript:void(0)" data-id="' . $row->id . '" class="deleteOpt btn btn-danger btn-sm">Delete</a>';

                        return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
            }
        }
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $option =  new Option();
        $option->optionGroupId = $request->optionGroupId;
        $option->option = $request->option;
        $option->save();
        return response()->json([
			'status' => 200,
            $option
		]);
    }
    /**
     * Display the specified resource.
     */

     public function getOption($id = 0)
     {
         $optionGroupID = $id;
         $option = Option::where('optionGroupId', '=', $optionGroupID)->get();
         print "<select class='form-control'  name='optionIds'>";
         print  " <option selected disble>Select Option</option>";
 
         foreach ($option as $option) {
             // print "option->option";
             echo "<option value=" . $option->id . ">" . $option->option . "</option>";
         }
 
         print "</select>";
         return response()->json([
             'status' => 200,
             'Option' => $option
         ]);
     }

    public function show(Option $option)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Option $option)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete($id)
    {
         Option::find($id)->delete();
       
    }
}
