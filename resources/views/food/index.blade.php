@extends('layouts.app')

@section('content')
    <div class="container-fuild">
        <div class="container d-flex justify-content-center">
            <h3>Quản lý món ăn</h3>
        </div>
        <div class="contaier ">
            <a href="food/create" class="btn btn-primary" role="button" aria-disabled="true">
                Thêm mới
            </a>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Tên Món Ăn</th>
                        <th>Mô Tả</th>
                        <th>Giá</th>
                        <th>Quán Ăn</th>
                        <th scope="col">Sửa</th>
                        <th scope="col">Xóa</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($foods as $food)
                        <tr>
                            <td>{{ $food->id }}</td>
                            <td>{{ $food->name }}</td>
                            <td>{{ $food->description }}</td>
                            <td>{{ number_format($food->price, 2) }} VND</td>
                            <td>{{ $food->eatery->name }}</td>
                            {{-- <td>
                                <!-- Nút Chỉnh Sửa và Xóa -->
                                <a href="{{ route('food.edit', $food->id) }}" class="btn btn-warning btn-sm">Sửa</a>
                                <form action="{{ route('food.destroy', $food->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Bạn có chắc chắn muốn xóa món ăn này?')">Xóa</button>
                                </form>
                            </td> --}}
                            <td>
                                <a href="food/{{$food->id}}/edit">
                                    <button type="button" class="btn btn-info">Sửa</button>
                                </a>
                            </td>
                            <td>
                                <form action="food/{{$food->id}}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Xóa</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center">Không có món ăn nào.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
