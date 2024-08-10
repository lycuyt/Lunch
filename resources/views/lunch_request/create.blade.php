@extends('layouts.app')

@section('content')
    <h1>Thêm lịch ăn mới</h1>
    <form action="/lunch_request" method="POST">
        @csrf
        <div class="form-group">
            <label for="eatery">Chọn quán ăn</label>
            <select class="form-control" id="eatery" name="eatery_id">
                <option value="">Chọn quán ăn</option>
                @foreach ($eateries as $eatery)
                    <option value="{{ $eatery->id }}">{{ $eatery->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="start_time">Thời Gian Bắt Đầu Ăn</label>
            <input type="datetime-local" class="form-control" id="start_time" name="start_time" required>
        </div>
        <div class="form-group">
            <label for="notes">Ghi chú</label>
            <textarea class="form-control" id="notes" name="notes" rows="3" placeholder="Nhập ghi chú"></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Thêm</button>
        <a href="{{ route('lunch_request.index') }}" class="btn btn-secondary">Hủy</a>
    </form> 
@endsection
