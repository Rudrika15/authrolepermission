<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function getCategory()
    {
        try {
            $categories = Category::all();
            return response()->json(['error' => false, 'status' => 200, 'categories' => $categories]);
        } catch (\Exception $e) {
            return response()->json(['error' => true, 'status' => 500,'message'=>'Something went to wrong...' ]);
        }
    }
}
