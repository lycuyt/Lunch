@extends('layouts.app')
<style>
    #foodsWeeklyChart {
        width: 400px;
        /* Thay đổi kích thước phù hợp */
        height: 300px;
        /* Thay đổi kích thước phù hợp */
    }

    .chart-size {
        width: 500px;
        /* Thay đổi kích thước theo nhu cầu */
        height: 400px;
        /* Thay đổi kích thước theo nhu cầu */
    }

    #totalMoneyPerUserChart, #averageMoneyPerUserChart {
        width: 100% !important;
        /* Đảm bảo biểu đồ sử dụng toàn bộ chiều rộng của cột */
        height: 300px !important;
        /* Điều chỉnh chiều cao theo nhu cầu */
        max-width: 100%;
        /* Đảm bảo biểu đồ không vượt quá chiều rộng của cột */
    }
</style>
@section('content')
    {{-- Thống kê chung  --}}
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-aqua">
                    <div class="inner">
                        <h3>{{ $count_eateries }} </h3>
                        <p>Quán ăn</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-bag"></i>
                    </div>
                    <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-green">
                    <div class="inner">
                        <h3>{{ $count_foods }} </h3>

                        <p>Món ăn</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-stats-bars"></i>
                    </div>
                    <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-yellow">
                    <div class="inner">
                        <h3>{{ $count_lunch_requests }} </h3>

                        <p>Yêu cầu ăn</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-person-add"></i>
                    </div>
                    <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-red">
                    <div class="inner">
                        <h3>{{ $count_orders }} </h3>

                        <p>Đặt món</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-pie-graph"></i>
                    </div>
                    <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
        </div>
    </div>
    {{-- Món ăn --}}
    <div class="container-fulid ">
        <div class="row my-5">
            <div class="col">
                <h3 class="fs-4 mb-3">Anh em ăn những gì trong tuần</h3>
                {{-- <table class="table table-bordered table-hover">
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
                </table> --}}
                <div class="col">
                    <canvas id="foodsWeeklyChart" width="100" height="200"></canvas>
                </div>
            </div>
            <div class="col mx-3">
                <h3 class="fs-4 mb-3">Những quán anh em hay đi ăn</h3>
                {{-- <table class="table bg-white rounded shadow-sm  table-hover">
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
                </table> --}}
                <div class="col mx-3">
                    {{-- <h3 class="fs-4 mb-3">Những quán anh em hay đi ăn</h3> --}}
                    <canvas id="eateriesWeeklyChart" class="chart-size"></canvas>
                </div>

            </div>
        </div>

        <div class="row my-5">
            <div class="col-md-6">
                <h3 class="fs-4 mb-3">Số tiền của từng người trong tuần</h3>
                <canvas id="totalMoneyPerUserChart"></canvas>
            </div>
            <div class="col-md-6">
                <h3 class="fs-4 mb-3">Số tiền trung bình buổi trưa của từng người</h3>
                <canvas id="averageMoneyPerUserChart"></canvas>
            </div>
        </div>


    </div>
    <script>
        var ctx = document.getElementById('foodsWeeklyChart').getContext('2d');

        var foodsWeeklyChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: @json($foods_weekly->pluck('food_name')),
                datasets: [{
                    label: 'Giá bán',
                    data: @json($foods_weekly->pluck('food_price')),
                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false, // Để biểu đồ không giữ tỉ lệ
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });


        var ctx = document.getElementById('eateriesWeeklyChart').getContext('2d');

        // Thiết lập kích thước của phần tử canvas
        document.getElementById('eateriesWeeklyChart').width = 300; // Thay đổi kích thước theo nhu cầu
        document.getElementById('eateriesWeeklyChart').height = 200; // Thay đổi kích thước theo nhu cầu

        var eateriesWeeklyChart = new Chart(ctx, {
            type: 'pie', // Hoặc loại biểu đồ khác bạn muốn sử dụng
            data: {
                labels: @json($eateries_weekly->pluck('eatery_name')),
                datasets: [{
                    label: 'Số lần đến ăn',
                    data: @json($eateries_weekly->pluck('visit_count')),
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false // Để biểu đồ không giữ tỉ lệ
            }
        });


        var ctx1 = document.getElementById('totalMoneyPerUserChart').getContext('2d');
        var totalMoneyPerUserChart = new Chart(ctx1, {
            type: 'bar',
            data: {
                labels: @json($sum_user_weekly->pluck('user_name')),
                datasets: [{
                    label: 'Tổng tiền',
                    data: @json($sum_user_weekly->pluck('sum_user')),
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });


        var ctx2 = document.getElementById('averageMoneyPerUserChart').getContext('2d');
        var averageMoneyPerUserChart = new Chart(ctx2, {
            type: 'bar',
            data: {
                labels: @json($avg_user_weekly->pluck('user_name')),
                datasets: [{
                    label: 'Số tiền trung bình',
                    data: @json($avg_user_weekly->pluck('avg_user')),
                    backgroundColor: 'rgba(153, 102, 255, 0.2)',
                    borderColor: 'rgba(153, 102, 255, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
@endsection
