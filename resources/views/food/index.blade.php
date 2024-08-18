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
    <div class="container">
        <div class="eateries">
            <h1>Quản lý món ăn</h1>
            <a href="food/create" class="btn btn-primary" role="button" aria-disabled="true">
                Thêm mới quán ăn
            </a>
        </div>
    </div>


    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Hover Data Table</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <table id="example2" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Ảnh</th>
                                    <th>Tên món ăn</th>
                                    <th>Giá</th>
                                    <th>Quán ăn</th>
                                    <th>Sửa</th>
                                    <th>Xóa</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($foods as $index => $item)
                                    <tr>
                                        <th scope="row">
                                            {{ $index + 1 + ($foods->currentPage() - 1) * $foods->perPage() }}</th>
                                        <td>
                                            <img src="{{ asset('images/' . $item->image) }}" alt="{{ $item->name }}"
                                                style="width: 100px">
                                        </td>
                                        <td>{{ $item->name }} </td>
                                        <td>{{ number_format($item->price, 2) }} VND</td>
                                        <td>{{ $item->eatery->name }}</td>
                                        <td>
                                            <a href="food/{{ $item->id }}/edit">
                                                <button type="button" class="btn btn-info">Sửa</button>
                                            </a>
                                        </td>
                                        <td>
                                            <form action="food/{{ $item->id }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">Xóa</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach


                            </tbody>

                        </table>
                        {{ $foods->links() }}
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </section>
    <!-- DataTables -->
@endsection
