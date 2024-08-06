@extends('layouts.app')

@section('content')
    <h1>Sửa quán ăn</h1>
    <form action="/eatery/{{$eatery->id}}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="name">Tên quán ăn</label>
            <input type="text" class="form-control" id="name" name="name" placeholder="Nhập tên quán ăn" value="{{$eatery->name}} ">
        </div>
        <div class="form-group">
            <label for="address">Địa chỉ</label>
            <input type="text" class="form-control" id="address" name="address" placeholder="Nhập địa chỉ" value="{{$eatery->address}}" >
        </div>
        <div class="form-group">
            <label for="phone">Số điện thoại</label>
            <input type="text" class="form-control" id="phone" name="phone" placeholder="Nhập số điện thoại" value="{{$eatery->phone}}" >
        </div>
        <button type="submit" class="btn btn-primary">Sửa</button>
    </form>
@endsection
