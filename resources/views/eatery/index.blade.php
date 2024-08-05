@extends('layouts.app')

@section('content')
    <div class="container-fuild">
        <div class="container d-flex justify-content-center">
            <h3>Quản lý quán ăn</h3>
        </div>
        <div class="contaier ">
            <a href="eatery/create" class="btn btn-primary"  role="button" aria-disabled="true">
                Thêm mới
            </a>
            
        </div>    
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Tên quán ăn</th>
                    <th scope="col">Địa chỉ</th>
                    <th scope="col">Số điện thoại</th>
                    <th scope="col">Sửa</th>
                    <th scope="col">Xóa</th>
                </tr>
            </thead>
            <tbody>

                @foreach ($eateries as $item)
                    <tr>
                        <th scope="row">{{ $loop->iteration }}</th>
                        <td>{{ $item->name }} </td>
                        <td>{{ $item->address }}</td>
                        <td>{{ $item->phone }}</td>
                        <td>
                            <a href="eatery/{{$item->id}}/edit">
                                <button type="button" class="btn btn-info">Sửa</button>
                            </a>
                        </td>
                        <td>
                            <form action="eatery/{{$item->id}}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Xóa</button>
                            </form>
                        </td>
                    </tr>
                @endforeach


            </tbody>
        </table>
    </div>
@endsection
