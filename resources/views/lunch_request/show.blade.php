@extends('layouts.app')

@section('content')
    <h1>Chi tiết yêu cầu ăn</h1>
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Yêu cầu từ: {{ $lunchRequest->created_at->format('d/m/Y H:i') }}</h3>
        </div>
        <div class="panel-body">
            <p><strong>Quán ăn:</strong> {{ $lunchRequest->eatery->name }}</p>
            <p><strong>Thời gian bắt đầu:</strong> {{ $lunchRequest->start_time }}</p>
            <p><strong>Ghi chú:</strong> {{ $lunchRequest->note }}</p>
            <p><strong>Trạng thái:</strong> 
                @if($lunchRequest->status == 'open')
                    <span class="label label-success">Open</span>
                @else
                    <span class="label label-danger">Close</span>
                @endif
            </p>
        </div>
    </div>
    <form action="{{ route('lunch_request.update_status', $lunchRequest->id) }}" method="POST">
        @csrf
        @method('PUT')
        <button type="submit" class="btn btn-primary">
            {{ $lunchRequest->status == 'open' ? 'Đóng yêu cầu' : 'Mở yêu cầu' }}
        </button>
    </form>

    <a href="{{ route('lunch_request.index') }}" class="btn btn-secondary">Quay lại</a>
    <!-- Orders related to the lunch request -->
    <h2>Danh sách đặt món</h2>
    @foreach($lunchRequest->orders as $order)
        <div class="order-item" style="display: flex; align-items: center; margin-bottom: 10px; border-bottom: 1px solid #ddd; padding-bottom: 10px;">
            <img src="{{ asset('images/' . $order->food->image) }}" alt="{{ $order->food->name }}" style="width: 50px; height: 50px; margin-right: 20px;">
            <div style="flex-grow: 1;">
                <p><strong>{{ $order->food->name }}</strong></p>
                <p>Số lượng: {{ $order->quantity }}</p>
            </div>
            <div style="text-align: right;">
                <p>Thành tiền: {{ number_format($order->quantity * $order->food->price, 0, ',', '.') }} VND</p>
                <p>Thời gian đặt: {{ $order->created_at->format('d/m/Y H:i') }}</p>
            </div>
        </div>
    @endforeach

    <!-- Summary at the bottom -->
    <h2>Tổng kết</h2>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Món ăn</th>
                <th>Tổng số lượng</th>
                <th>Tổng tiền</th>
            </tr>
        </thead>
        <tbody>
            @foreach($lunchRequest->orders->groupBy('food_id') as $foodId => $orders)
                @php
                    $totalQuantity = $orders->sum('quantity');
                    $totalPrice = $totalQuantity * $orders->first()->food->price;
                @endphp
                <tr>
                    <td>{{ $orders->first()->food->name }}</td>
                    <td>{{ $totalQuantity }}</td>
                    <td>{{ number_format($totalPrice, 0, ',', '.') }} VND</td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <th colspan="2">Tổng cộng</th>
                <th>{{ number_format($lunchRequest->orders->sum(function($order) { return $order->quantity * $order->food->price; }), 0, ',', '.') }} VND</th>
            </tr>
        </tfoot>
        
    </table>

    <!-- Nút để cập nhật trạng thái -->
    
@endsection
