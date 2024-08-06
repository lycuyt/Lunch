<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Food;
use App\Models\Eatery;

class FoodController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $foods = Food::all();
        // dd($foods);
        return view('food.index', compact('foods'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $eateries = Eatery::all(); 
        return view('food.create', compact('eateries'));
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
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'eatery_id' => 'required|exists:eateries,id',
        ]);

        // Tạo mới món ăn
        Food::create([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'price' => $request->input('price'),
            'eatery_id' => $request->input('eatery_id'),
        ]);

        // Chuyển hướng về trang danh sách món ăn với thông báo thành công
        return redirect()->route('food.index')
                         ->with('success', 'Món ăn đã được thêm thành công.');
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
        // Lấy món ăn cần chỉnh sửa
        $food = Food::findOrFail($id);
        // Lấy danh sách quán ăn
        $eateries = Eatery::all();
        // Truyền dữ liệu đến view
        return view('food.edit', compact('food', 'eateries'));
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
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'eatery_id' => 'required|exists:eateries,id',
        ]);

        // Cập nhật món ăn
        $food = Food::findOrFail($id);
        $food->update([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'price' => $request->input('price'),
            'eatery_id' => $request->input('eatery_id'),
        ]);

        // Chuyển hướng về trang danh sách món ăn với thông báo thành công
        return redirect()->route('food.index')
                         ->with('success', 'Món ăn đã được cập nhật thành công.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $food = Food::find($id);
        $food->delete();
        return redirect()->route('food.index')
                         ->with('success', 'Món ăn đã được xóa thành công.');
    }
}
