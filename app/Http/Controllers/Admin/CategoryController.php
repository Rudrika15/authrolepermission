<?php

namespace App\Http\Controllers\Admin;

use App\Exports\CategoryExport;
use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
// use Maatwebsite\Excel\Facades\Excel;

use Illuminate\Support\Facades\URL;
use Yajra\DataTables\DataTables;
use Yajra\DataTables\Facades\DataTables as FacadesDataTables;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::latest()->get();
        if ($request->ajax()) {
            $allData = DataTables::of($categories)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<a href="' . URL::route('category.edit', $row->id) . '"data-toggle="tooltip" data-original-title="Edit" class="btn btn-primary btn-sm editCategory">Edit</a>';

                    $btn = $btn . ' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Delete" class="btn btn-danger btn-sm deleteCategory">Delete</a>';

                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
            return $allData;
        }
        return view('admin.category.index');
        // try {
        // return    $categories = Category::all();
        //   // $categorys ="";
        // } catch (\Exception $e) {
        //     // return view('error.error');
        // }
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        try {
            return view('admin.category.create');
        } catch (\Exception $e) {
            // return view('error.error');
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // $this->validate($request, [
        //     'title' => 'required',
        //     'photo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        // ]);
        try {
            $imageName = time() . '.' . $request->icon->extension();
            $request->icon->move(public_path('category'), $imageName);
            $category = new Category();
            $category->title = $request->title;
            $category->icon =  $imageName;
            $category->save();
            return response()->json([
                'success' => true,
                'message' => 'Category detail saved'
            ]);
        } catch (\Exception $e) {
            // return view('error.error');
        }
    }
    public function getData(Request $request)
    {
        // $categories = Category::latest()->get();
        // if ($request->ajax()) {
        //     $allData = DataTables::of($categories)
        //         ->addIndexColumn()
        //         ->addColumn('action', function ($row) {
        //             $btn = '<a href="' . URL::route('category.edit', $row->id) . '"data-toggle="tooltip" data-original-title="Edit" class="edit btn btn-primary btn-sm editCategory">Edit</a>';

        //             $btn = $btn . ' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Delete" class="btn btn-danger btn-sm deleteCategory">Delete</a>';

        //             return $btn;
        //         })
        //         ->rawColumns(['action'])
        //         ->make(true);
        //     return $allData;
        // }
        // return view('admin.category.index');
    }

    public function edit($id)
    {
        $category = Category::find($id);
        return view('admin.category.edit', compact('category'));
    }

    public function update(Request $request)
    {
        // $this->validate($request, [
        //     'title' => 'required',
        // ]);

        $id = $request->category_id;
        $category =  Category::find($id);

        if ($request->icon) {
            $imageName = time() . '.' . $request->icon->extension();

            $request->icon->move(public_path('category'), $imageName);
            $category->icon =  $imageName;
        }
        $category->title = $request->title;
        $category->save();
        return response()->json([
            'success' => true,
            'message' => 'Category detail edited'
        ]);
    }
    public function delete($id)
    {
        Category::find($id)->delete();
    }

    // public function export()
    // {
    //     return Excel::download(new CategoryExport, 'category.xlsx');
    // }
    // public function exportcsv()
    // {
    //     return Excel::download(new CategoryExport, 'category.csv');
    // }
}
