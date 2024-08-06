@extends('layouts.app')

@section('content')
    <div class="container mt-5 mb-5 d-flex justify-content-center align-items-center flex-column"
        style="width: 80%; height: 400px; border: 1px solid #ccc; border-radius: 20px;">
        <!-- Nút Lên lịch ăn trưa -->
        <button id="showFormButton" type="button" class="btn btn-info" style="height: 10%; width: 30%;">Lên lịch ăn
            trưa</button>

        <!-- Form được ẩn ban đầu -->
        <div id="lunchForm" class="container mt-3" style="display: none;">
            <div class="card">
                <div class="card-header">Tạo Yêu Cầu Ăn Trưa</div>
                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <form action="/lunch_request" method="POST">
                        @csrf

                        <div class="form-group">
                            <label for="eatery_id">Chọn Quán Ăn</label>
                            <select class="form-control" id="eatery_id" name="eatery_id" required>
                                <option value="">Chọn Quán Ăn</option>
                                @foreach ($eateries as $eatery)
                                    <option value="{{ $eatery->id }}">{{ $eatery->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="start_time">Thời Gian Bắt Đầu Ăn</label>
                            <input type="datetime-local" class="form-control" id="start_time" name="start_time" required>
                        </div>

                        <button type="submit" class="btn btn-primary">Lưu</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="container ">
        <div class="row">
            <div class="col d-flex justify-content-center align-items-center">
                <h3>Danh sách yêu cầu</h3>
            </div>

        </div>
        <div class="row">
            <div class="col px-3 py-3 mb-5 ">
                @foreach ($lunchRequests as $item)
                    <div class="row bg-info rounded-3 mb-3 px-3 py-3">
                        <div class="col-md-8">
                            <h3>Yêu cầu ăn: Quán {{ $item->eatery->name }} </h3>
                            <p>Thời gian: {{ $item->date }}</p>
                        </div>
                        <div class="col-md-4 d-flex justify-content-center align-items-center">
                            <button type="button" class="btn btn-primary">Xem chi tiết</button>
                        </div>
                    </div>  
                @endforeach
            </div>

        </div>
    </div>
    <!-- JavaScript để hiện/ẩn form và nút -->
    <script>
        document.getElementById('showFormButton').addEventListener('click', function() {
            var button = document.getElementById('showFormButton');
            var form = document.getElementById('lunchForm');

            button.style.display = 'none'; // Ẩn nút "Lên lịch ăn trưa"
            form.style.display = 'block'; // Hiện form lên
        });
    </script>
@endsection
