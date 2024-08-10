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

    <!-- Nút để cập nhật trạng thái -->
    <form action="{{ route('lunch_request.update_status', $lunchRequest->id) }}" method="POST">
        @csrf
        @method('PUT') <!-- Đây là cách để giả lập PUT method -->
    
        <!-- Input ẩn để lưu trạng thái hiện tại -->
        <input type="hidden" name="status" value="{{ $lunchRequest->status }}">
    
        <!-- Nút để gửi form -->
        <button type="submit" class="btn btn-primary">
            {{ $lunchRequest->status == 'open' ? 'Đóng yêu cầu' : 'Mở yêu cầu' }}
        </button>
    </form>

    <a href="{{ route('lunch_request.index') }}" class="btn btn-secondary">Quay lại</a>
@endsection
