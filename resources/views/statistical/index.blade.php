@extends('layouts.app')

@section('content')
    {{-- show the foods in week --}}
    <div class="container-fulid ">
        <div class="row my-5">
            <div class="col mx-3">
                <h3 class="fs-4 mb-3">Anh em ăn những gì trong tuần</h3>
                <table class="table bg-white rounded shadow-sm  table-hover">
                    <thead>
                        <tr>
                            <th scope="col" width="50">#</th>
                            <th scope="col">Tên món</th>
                            <th scope="col">Tên quán ăn</th>
                            <th scope="col">Giá bán</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $index = 1; @endphp
                        @foreach ($foods_weekly as $item)
                            <tr>
                                <th scope="row">{{ $index++ }}</th>
                                <td>{{ $item->food_name }}</td>
                                <td>{{ $item->eatery_name }}</td>
                                <td>{{ $item->food_price }} VND</td>
                            </tr>
                        @endforeach


                    </tbody>
                </table>
            </div>
            <div class="col mx-3">
                <h3 class="fs-4 mb-3">Những quán anh em hay đi ăn</h3>
                <table class="table bg-white rounded shadow-sm  table-hover">
                    <thead>
                        <tr>
                            <th scope="col" width="50">#</th>
                            <th scope="col">Tên quán</th>
                            <th scope="col">Địa chỉ quán</th>
                            <th scope="col">Số lần đến ăn</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $index = 1; @endphp
                        @foreach ($eateries_weekly as $item)
                            <tr>
                                <th scope="row">{{ $index++ }}</th>
                                <td>{{ $item->eatery_name }}</td>
                                <td>{{ $item->eatery_address }}</td>
                                <td>{{ $item->visit_count }}</td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>

        <div class="row my-5">
            <div class="col mx-3">
                <h3 class="fs-4 mb-3">Số tiền của từng người trong tuần</h3>
                <table class="table bg-white rounded shadow-sm  table-hover">
                    <thead>
                        <tr>
                            <th scope="col" width="50">#</th>
                            <th scope="col">Tên</th>
                            <th scope="col">Tổng tiền</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $index = 1; @endphp
                        @foreach ($sum_user_weekly as $item)
                            <tr>
                                <th scope="row">{{ $index++ }}</th>
                                <td>{{ $item->user_name}}</td>
                                <td>{{ $item->sum_user }}</td>
                
                            </tr>
                        @endforeach


                    </tbody>
                </table>
            </div>
            <div class="col mx-3">
                <h3 class="fs-4 mb-3">Số tiền trung bình buổi trưa của từng người</h3>
                <table class="table bg-white rounded shadow-sm  table-hover">
                    <thead>
                        <tr>
                            <th scope="col" width="50">#</th>
                            <th scope="col">Tên</th>
                            <th scope="col">Số tiền trung bình</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $index = 1; @endphp
                        @foreach ($avg_user_weekly as $item)
                            <tr>
                                <th scope="row">{{ $index++ }}</th>
                                <td>{{ $item->user_name }}</td>
                                <td>{{ $item->avg_user }}</td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
