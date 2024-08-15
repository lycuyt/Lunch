<?php

namespace App\Http\Controllers;

use App\Models\Eatery;
use Illuminate\Http\Request;
use App\Models\LunchRequest;
use Illuminate\Support\Facades\Auth;

class LunchRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // lay ra cac yeu cau an trua cua user hien tai
        $lunch_requests = LunchRequest::where('user_id', auth()->user()->id)
            ->orderBy('created_at', 'desc')  // Sắp xếp theo ngày tạo từ mới nhất đến cũ nhất
            ->paginate(7);  // Phân trang với 7 yêu cầu trên mỗi trang

        return view('lunch_request.index', compact('lunch_requests'));
    }
    public function getLunchRequestsByDate(Request $request)
    {
        $date = $request->input('date');
        $lunchRequests = LunchRequest::whereDate('start_time', $date)->get();

        return view('lunch_requests.partials.requests_modal', compact('lunchRequests'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $eateries = Eatery::all();
        return view('lunch_request.create', compact('eateries'));
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
            'notes' => 'nullable|string',
        ]);

        // Tạo một yêu cầu ăn trưa mới
        LunchRequest::create([
            'eatery_id' => $request->input('eatery_id'),
            'date' => $request->input('start_time'),
            'user_id' => auth()->user()->id,
            'note' => $request->input('notes'),
            'status' => 'open',
        ]);

        // Chuyển hướng về trang danh sách yêu cầu ăn trưa với thông báo thành công
        return redirect()->route('lunch_request.index')->with('success', 'Yêu cầu ăn trưa đã được lưu thành công.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //show the foods in the eatery
        // $lunch_request = LunchRequest::find($id);
        // $eatery = $lunch_request->eatery;
        // $foods = $lunch_request->eatery->foods;
        // return view('employee.showFoods', compact('lunch_request', 'eatery', 'foods'));

        $lunchRequest = LunchRequest::findOrFail($id);
        return view('lunch_request.show', compact('lunchRequest'));
    }
    public function updateStatus(Request $request, $id)
    {
        $lunchRequest = LunchRequest::findOrFail($id);

        // Lấy trạng thái từ request và đảo ngược nó
        $lunchRequest->status = $lunchRequest->status == 'open' ? 'close' : 'open';

        // Cập nhật trạng thái mới cho yêu cầu
        $lunchRequest->save();

        return redirect()->route('lunch_request.index')->with('success', 'Trạng thái yêu cầu đã được cập nhật.');
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $lunchRequest = LunchRequest::findOrFail($id);
        $eateries = Eatery::all(); // Lấy danh sách các quán ăn
        return view('lunch_request.edit', compact('lunchRequest', 'eateries'));
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
        // Điều chỉnh validation rule để phù hợp với định dạng của datetime-local
        $request->validate([
            'eatery_id' => 'required|exists:eateries,id',
            'start_time' => 'required|date_format:Y-m-d\TH:i', // điều chỉnh định dạng
            'notes' => 'nullable|string',
        ]);

        // Cập nhật yêu cầu ăn trong cơ sở dữ liệu
        $lunchRequest = LunchRequest::findOrFail($id);
        $lunchRequest->update([
            'eatery_id' => $request->input('eatery_id'),
            'date' => $request->input('start_time'), // Sử dụng đúng tên cột
            'note' => $request->input('notes'), // Sử dụng đúng tên cột
        ]);

        return redirect()->route('lunch_request.index')->with('success', 'Lịch ăn đã được cập nhật thành công!');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        LunchRequest::destroy($id);
        return redirect()->route('lunch_request.index')->with('success', 'Yêu cầu ăn trưa đã được xóa thành công.');
    }
}
