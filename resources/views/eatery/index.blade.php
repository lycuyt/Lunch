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
            <h1>Quản lý quán ăn</h1>
            <a href="eatery/create" class="btn btn-primary"  role="button" aria-disabled="true">
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
                                    <th>Tên quán ăn</th>
                                    <th>Địa chỉ</th>
                                    <th>Số điện thoại</th>
                                    <th>Sửa</th>
                                    <th>Xóa</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($eateries as $index => $item)
                                    <tr>
                                        <th scope="row">
                                            {{ $index + 1 + ($eateries->currentPage() - 1) * $eateries->perPage() }}</th>
                                        <td>
                                            <img src="{{ asset('images/' . $item->image) }}" alt="{{ $item->name }}"
                                                style="width: 100px">
                                        </td>
                                        <td>{{ $item->name }} </td>
                                        <td>{{ $item->address }}</td>
                                        <td>{{ $item->phone }}</td>
                                        <td>
                                            <a href="eatery/{{ $item->id }}/edit">
                                                <button type="button" class="btn btn-info">Sửa</button>
                                            </a>
                                        </td>
                                        <td>
                                            <form action="eatery/{{ $item->id }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">Xóa</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach


                            </tbody>

                        </table>
                        {{ $eateries->links() }}
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
