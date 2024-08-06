<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LunchRequest;
class LunchRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $request->validate([
            'eatery_id' => 'required|exists:eateries,id',
            'start_time' => 'required|date',
        ]);

        // Tạo một yêu cầu ăn trưa mới
        LunchRequest::create([
            'eatery_id' => $request->input('eatery_id'),
            'date' => $request->input('start_time'),
            'user_id' => auth()->user()->id,
        ]);

        // Chuyển hướng về trang danh sách yêu cầu ăn trưa với thông báo thành công
        return redirect()->route('admin')->with('success', 'Yêu cầu ăn trưa đã được lưu thành công.');
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
