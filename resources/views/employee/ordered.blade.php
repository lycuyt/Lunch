{{-- resources/views/user/orders.blade.php --}}
@extends('employee.layouts.app')

@section('content')
<div class="container mt-5">
    <h1 class="mb-4">Danh sách đơn hàng của bạn</h1>

    @foreach ($orders as $order)
        @php
            $lunchRequest = $lunchRequests->firstWhere('id', $order->lunch_request_id);
            $eatery = $lunchRequest ? $lunchRequest->eatery : null;
            $formattedDate = $lunchRequest ? \Carbon\Carbon::parse($lunchRequest->date)->format('d/m/Y H:i') : 'Chưa xác định';
        @endphp

        <div class="card mb-3">
            <div class="card-header">
                <h5 class="mb-0">{{ $eatery ? $eatery->name : 'Quán ăn không xác định' }}</h5>
            </div>
            <div class="card-body">
                <p><strong>Thời gian bắt đầu:</strong> {{ $formattedDate }}</p>

                <h6>Món ăn đã đặt:</h6>
                <ul>
                    <li>
                        <strong>Tên món:</strong> {{ $order->food->name }}<br>
                        <strong>Số lượng:</strong> {{ $order->quantity }}<br>
                        <strong>Giá:</strong> {{ number_format($order->food->price * $order->quantity, 2) }} VND<br>
                        <strong>Ghi chú:</strong> {{ $order->note }}
                    </li>
                </ul>
            </div>
        </div>
    @endforeach
</div>
@endsection
