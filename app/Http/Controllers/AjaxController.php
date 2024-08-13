<?php

namespace App\Http\Controllers;

use App\Models\Food;
use Illuminate\Http\Request;
use App\Models\LunchRequest;
use App\Models\Order;

class AjaxController extends Controller
{
    public function index()
    {
        $lunch_requests = LunchRequest::all();
        // Đây là nơi bạn có thể cấu hình sự kiện cho FullCalendar
        $events = [];
        foreach ($lunch_requests as $request) {
            $events[] = [
                'title' => 'Lunch Request',
                'start' => $request->date,
                'id' => $request->id
            ];
        }
        return response()->json($events);
    }

    public function getLunchRequests(Request $request)
    {
        $date = $request->input('date');
        //lay ra thong tin cua quan an kem cac mon an cua quan do
        $lunch_request = LunchRequest::whereDate('date', $date)->get();
        //select eateries.name from eateries join lunch_requests on eateries.id = lunch_requests.eatery_id
        $eateries = LunchRequest::join('eateries', 'eateries.id', '=', 'lunch_requests.eatery_id')
            ->whereDate('date', $date)
            ->select('eateries.name', 'eateries.address')
            ->get();
        //select foods.name, foods.price from foods join eateries on foods.eatery_id = eateries join lunch_requests on eateries.id = lunch_requests.eatery_id
        //where lunch_requests.date = $date
        $foods = Food::join('eateries', 'foods.eatery_id', '=', 'eateries.id')
            ->join('lunch_requests', 'eateries.id', '=', 'lunch_requests.eatery_id')
            ->whereDate('lunch_requests.date', $date)
            ->select('foods.id', 'foods.name', 'foods.price')
            ->get();

        //select * from orders join foods on orders.food_id = foods.id join lunch_requests on orders.lunch_request_id = lunch_requests.id
        //where lunch_requests.date = $date and orders.user_id = auth()->user()->id
        $orders = Order::join('foods', 'orders.food_id', '=', 'foods.id')
            ->join('lunch_requests', 'orders.lunch_request_id', '=', 'lunch_requests.id')
            ->whereDate('lunch_requests.date', $date)
            ->where('orders.user_id', auth()->user()->id)
            ->select('orders.id', 'foods.name', 'orders.quantity', 'orders.note', 'orders.method', 'orders.status')
            ->get();
        return response()->json([
            'lunch_request' => $lunch_request,
            'eateries' => $eateries,
            'foods' => $foods,
            'orders' => $orders 
        ]);
    }



    public function saveLunchOrder(Request $request)
    {
        // Debug: Xem dữ liệu nhận được

        $order = new Order();
        $order->food_id = $request->input('foodId');
        $order->quantity = $request->input('quantity');
        $order->note = $request->input('note');
        $order->method = $request->input('orderType'); // 'takeaway' hoặc 'eat-in'
        $order->status = 'waiting';
        $order->user_id = auth()->user()->id;
        $order->lunch_request_id = $request->input('lunchRequestId');
        $order->save();

        return response()->json(['success' => true]);
    }
}
