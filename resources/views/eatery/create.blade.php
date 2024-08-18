@extends('layouts.app')

@section('content')
    <h1>Thêm quán ăn</h1>
    <form action="/eatery" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="name">Tên quán ăn</label>
            <input type="text" class="form-control" id="name" name="name" placeholder="Nhập tên quán ăn" required>
        </div>
        <div class="form-group">
            <label for="address">Địa chỉ</label>
            <input type="text" class="form-control" id="address" name="address" placeholder="Nhập địa chỉ" required>
        </div>
        <div class="form-group">
            <label for="phone">Số điện thoại</label>
            <input type="text" class="form-control" id="phone" name="phone" placeholder="Nhập số điện thoại" required>
        </div>
        <div class="form-group">
            <label for="image">Ảnh quán ăn</label>
            <input type="file" class="form-control" id="image" name="image" accept="image/*" required>
        </div>
        <button type="submit" class="btn btn-primary">Thêm</button>
        <a href="{{ route('eatery.index') }}" class="btn btn-secondary">Hủy</a>
    </form>
@endsection
