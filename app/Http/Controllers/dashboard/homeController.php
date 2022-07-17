<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Client;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class homeController extends Controller
{
    public function index()
    {

        $categories=Category::count();
        $products=Product::count();
        $clients=Client::count();
        $users=User::WhereRoleIs('admin')->count();
        // $orders=Order::count();

//         $sales_data = Order::select(
//             DB::raw('YEAR(created_at) as year'),
//             DB::raw('MONTH(created_at) as month'),
//             DB::raw('SUM(total_price) as sum')
//         )->groupBy('month')->get();


        return view('dashboard.home',compact('categories','products','clients','users'));
    }


}
