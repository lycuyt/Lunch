@extends('layouts.app')
<style>
    .eateries {
        overflow: hidden;
        /* Đảm bảo các phần tử không bị tràn */
        margin-bottom: 20px;
        /* Khoảng cách dưới tiêu đề */
    }

    .eateries a {
        float: right;
        /* Đặt nút ở bên trái */
    }

    .eateries h1 {
        float: left;
        /* Đặt tiêu đề ở bên phải */
        margin: 0;
        /* Xóa khoảng cách xung quanh tiêu đề */
    }
</style>
@section('content')
    
@endsection
