<?php

namespace App\Http\Controllers;

use App\Models\LunchRequest;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // lay ra ra tat ca nhung lunch_request trong database
        // $lunch_requests = LunchRequest::all();
        // dd($lunch_requests);
        // return view('employee.index', compact('lunch_requests'));
        //lay ra nhung orders của ng dung dang dang nhap va sap xep theo thoi gian tao giam dan

        $orders = Order::where('user_id', auth()->user()->id)->orderBy('created_at', 'desc')->get();
        
        return view('employee.show-orders', compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $order = new Order();

        // Gán các giá trị từ request
        $order->food_id = $request->input('food_id');
        $order->quantity = $request->input('quantity');
        $order->note = $request->input('note');
        $order->user_id = auth()->user()->id; // Giả sử người dùng đã đăng nhập
        $order->lunch_request_id = $request->input('lunch_request_id'); // Lưu lunch_request_id

        // Lưu đơn đặt món
        $order->save();

        // Chuyển hướng về trang chủ với thông báo thành công
        return redirect()->route('employee')->with('success', 'Đơn đặt món đã được lưu.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
