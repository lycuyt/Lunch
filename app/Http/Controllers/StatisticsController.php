<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StatisticsController extends Controller
{
    public function index() {
        // show the foods in weekly
        $startOfWeek = Carbon::now()->startOfWeek();
        $endOfWeek = Carbon::now()->endOfWeek();
        $foods_weekly = DB::table('orders')
                        ->join('foods', 'orders.food_id', '=', 'foods.id')
                        ->join('eateries', 'foods.eatery_id', '=', 'eateries.id')
                        ->select('foods.name as food_name', 'eateries.name as eatery_name', 'foods.price as food_price')
                        ->whereBetween('orders.created_at', [$startOfWeek, $endOfWeek])
                        ->distinct()
                        ->get();
        //show the eateries in weekly
        $eateries_weekly = DB::table('lunch_requests as lr')
                        ->join('eateries as e', 'e.id', '=', 'lr.eatery_id')
                        ->select('e.name as eatery_name', 'e.address as eatery_address', DB::raw('COUNT(lr.id) as visit_count'))
                        ->groupBy('e.name', 'e.address')
                        ->orderBy(DB::raw('COUNT(lr.id)'), 'desc')
                        ->whereBetween('lr.date', [$startOfWeek, $endOfWeek])
                        ->get();
                        // select u.name,sum(f.price * o.quantity) as sum_user from users u inner join orders o on
                        // u.id  = o.user_id inner join foods f on f.id = o.food_id where u.`role` ='employee' 
                        // group by u.name
                        // order by sum(f.price * o.quantity) desc
        //show the sum of user in weekly
        $sum_user_weekly = DB:: table('users as u')
                        ->join('orders as o', 'u.id', '=', 'o.user_id')
                        ->join('foods as f', 'f.id', '=', 'o.food_id')
                        ->select('u.name as user_name', DB::raw('sum(f.price * o.quantity) as sum_user'))
                        ->where('u.role', 'employee')
                        ->groupBy('u.name')
                        ->orderBy(DB::raw('sum(f.price * o.quantity)'), 'desc')
                        ->whereBetween('o.created_at', [$startOfWeek, $endOfWeek])
                        ->get();
                        // select u.name,avg(f.price * o.quantity) as sum_user from users u inner join orders o on
                        // u.id  = o.user_id inner join foods f on f.id = o.food_id where u.`role` ='employee' 
                        // group by u.name
        //show the avg of user in weekly              
        $avg_user_weekly = DB::table('users as u')
                        ->join('orders as o', 'u.id', '=', 'o.user_id')
                        ->join('foods as f', 'f.id', '=', 'o.food_id')
                        ->select('u.name as user_name', DB::raw('avg(f.price * o.quantity) as avg_user'))
                        ->where('u.role', 'employee')
                        ->groupBy('u.name')
                        ->whereBetween('o.created_at', [$startOfWeek, $endOfWeek])
                        ->get();
        // dd($foods_weekly);
        //count the number of eateries 
        $count_eateries = DB::table('eateries')->count();
        //count the number of foods
        $count_foods = DB::table('foods')->count();
        //count the request of lunch
        $count_lunch_requests = DB::table('lunch_requests')->count();
        //count the number of orders
        $count_orders = DB::table('orders')->count();

        return view('admin.index', compact('foods_weekly', 'eateries_weekly', 'sum_user_weekly', 'avg_user_weekly', 
        'count_eateries', 'count_foods', 'count_lunch_requests', 'count_orders'));
    }
    
}
