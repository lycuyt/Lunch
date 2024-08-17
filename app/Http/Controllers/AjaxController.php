<?php

namespace App\Http\Controllers;

use App\Models\Eatery;
use App\Models\Food;
use Illuminate\Http\Request;
use App\Models\LunchRequest;
use App\Models\Order;
use Carbon\Carbon;

class AjaxController extends Controller
{
    public function index()
    {
        $lunch_requests = LunchRequest::where('status', 'open')->get();

        // Cấu hình sự kiện cho FullCalendar
        $events = [];
        foreach ($lunch_requests as $request) {
            $events[] = [
                'title' => $request->eatery->name, // Hiển thị tên quán ăn
                'start' => $request->date,
                'id' => $request->id,
                'eatery_name' => $request->eatery->name, // Đảm bảo tên quán ăn có trong dữ liệu sự kiện
            ];
        }

        return response()->json($events);
    }


    public function showOrders()
    {
        $orders = Order::where('user_id', auth()->user()->id)
            ->orderBy('created_at', 'desc')
            ->paginate(7);


        return view('employee.show-orders', compact('orders'));
    }
    public function getLunchRequests(Request $request)
    {
        $lunchRequestId = $request->input('id'); // Lấy id của lunch_request từ request

        // Tìm yêu cầu ăn uống theo ID
        $lunch_request = LunchRequest::where('id', $lunchRequestId)
            ->where('status', 'open')
            ->first();

        if (!$lunch_request) {
            return response()->json([
                'message' => 'Lunch request not found'
            ], 404);
        }

        // Tìm eatery liên quan đến yêu cầu ăn uống
        $eatery = Eatery::where('id', $lunch_request->eatery_id)
            ->select('id', 'name', 'address')
            ->first();

        // Tìm danh sách foods liên quan đến eatery
        $foods = Food::where('eatery_id', $eatery->id)
            ->select('id', 'name', 'price')
            ->get();

        // Tìm danh sách orders liên quan đến yêu cầu ăn uống và người dùng hiện tại
        $orders = Order::where('lunch_request_id', $lunchRequestId)
            ->where('user_id', auth()->user()->id)
            ->join('foods', 'orders.food_id', '=', 'foods.id')
            ->select('orders.id', 'foods.name', 'orders.quantity', 'orders.note', 'orders.method', 'orders.status')
            ->get();

        return response()->json([
            'lunch_request' => [$lunch_request],
            'eateries' => [$eatery],
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
    public function getOrder($id)
    {
        $order = Order::join('foods', 'orders.food_id', '=', 'foods.id')
            ->where('orders.id', $id)
            ->select('orders.id', 'foods.name', 'orders.quantity', 'orders.note', 'orders.method', 'orders.status', 'orders.lunch_request_id')
            ->first();

        if ($order) {
            return response()->json(['success' => true, 'order' => $order]);
        } else {
            return response()->json(['success' => false, 'message' => 'Order not found.'], 404);
        }
    }

    // 
    public function updateOrder(Request $request, $id)
    {
        $order = Order::find($id);

        if (!$order) {
            return response()->json(['success' => false, 'message' => 'Order not found.']);
        }

        $order->quantity = $request->input('quantity');
        $order->note = $request->input('note');
        $order->method = $request->input('orderType');
        $order->lunch_request_id = $request->input('lunchRequestId');
        $order->save();

        return response()->json(['success' => true]);
    }
    public function deleteOrder($id)
    {
        $order = Order::find($id);

        if ($order) {
            $order->delete();
            return response()->json(['success' => true]);
        } else {
            return response()->json(['success' => false, 'message' => 'Order not found.'], 404);
        }
    }
}
