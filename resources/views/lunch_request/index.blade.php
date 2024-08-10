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
    tr {
    cursor: pointer;
    }
</style>
@section('content')
    <div class="container">
        <div class="eateries">
            <h1>Quản lý lịch ăn</h1>
            <a href="lunch_request/create" class="btn btn-primary" role="button" aria-disabled="true">
                Thêm lịch ăn mới
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
                                    <th>Quán ăn</th>
                                    <th>Thời gian ăn</th>
                                    <th>Ghi chú</th>
                                    <th>Sửa</th>
                                    <th>Xóa</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($lunch_requests as $index => $item)
                                    <tr onclick="window.location='{{ route('lunch_request.show', $item->id) }}'">
                                        <th scope="row">
                                            {{ $index + 1 + ($lunch_requests->currentPage() - 1) * $lunch_requests->perPage() }}
                                        </th>
                                        <td>
                                            {{ $item->eatery->name }}
                                            @if ($item->status == 'open')
                                                <span class="label label-success">Open</span>
                                            @elseif($item->status == 'close')
                                                <span class="label label-danger">Close</span>
                                            @else
                                                <span class="label label-default">Unknown</span>
                                            @endif
                                        </td>
                                        <td>{{ $item->date }}</td>
                                        <td>{{ $item->note }}</td>
                                        <td>
                                            <a href="lunch_request/{{ $item->id }}/edit">
                                                <button type="button" class="btn btn-info">Sửa</button>
                                            </a>
                                        </td>
                                        <td>
                                            <form action="lunch_request/{{ $item->id }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">Xóa</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach


                            </tbody>

                        </table>
                        {{ $lunch_requests->links() }}
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
