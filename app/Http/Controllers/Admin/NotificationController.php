<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Notification;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Request;

class NotificationController extends Controller
{
    //

    public function index()
    {

        // return  $data = Notification::all();

        return view('admin.notification.index');
    }
    public function getAllData(Request $request)
    {
        if ($request->ajax()) {
            $data =DB::table('notifications')
            ->crossJoin('users')
            ->crossJoin('products')
            ->select('notifications.*', 'users.*', 'products.*')
            ->where('users.id','=',DB::raw('notifications.userId'))
            ->where('products.id','=',DB::raw('notifications.productId'));
            
            return \Yajra\DataTables\DataTables::of($data)
                ->make(true);
        }
    }
}
