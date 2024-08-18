@extends('layouts.app')

@section('content')
    <h1>Sửa quán ăn</h1>
    <form action="/eatery/{{$eatery->id}}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="name">Tên quán ăn</label>
            <input type="text" class="form-control" id="name" name="name" placeholder="Nhập tên quán ăn" value="{{$eatery->name}}" required>
        </div>
        <div class="form-group">
            <label for="address">Địa chỉ</label>
            <input type="text" class="form-control" id="address" name="address" placeholder="Nhập địa chỉ" value="{{$eatery->address}}" required>
        </div>
        <div class="form-group">
            <label for="phone">Số điện thoại</label>
            <input type="text" class="form-control" id="phone" name="phone" placeholder="Nhập số điện thoại" value="{{$eatery->phone}}" required>
        </div>
        <div class="form-group">
            <label for="image">Ảnh quán ăn</label>
            <input type="file" class="form-control" id="image" name="image" accept="image/*">
            @if ($eatery->image)
                <div class="mt-2">
                    <img src="{{ asset('images/' . $eatery->image) }}" alt="Current Image" style="max-width: 200px;">
                </div>
            @endif
        </div>
        <button type="submit" class="btn btn-primary">Sửa</button>
        <a href="{{ route('eatery.index') }}" class="btn btn-secondary">Hủy</a>
    </form>
@endsection
