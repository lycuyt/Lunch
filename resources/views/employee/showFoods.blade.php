@extends('employee.layouts.app')

@section('content')
    <div class="container">
        <!-- Header and Lunch Request Information -->
        <div class="row mt-3">
            <div class="col">
                <h1>Yêu cầu ăn trưa lúc: {{ $lunch_request->date }} </h1>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <h2>Tên quán ăn: {{ $eatery->name }} </h2>
            </div>
        </div>

        <!-- List of Foods -->
        <div class="container">
            @foreach ($foods as $item)
                <div class="row bg-info rounded-3 mb-3 px-3 py-3 mt-3">
                    <div class="col-md-8">
                        <h3>Tên món ăn: {{ $item->name }} </h3>
                        <p>Giá: {{ $item->price }} VND </p>
                    </div>
                    <div class="col-md-4 d-flex justify-content-center align-items-center">
                        <button type="button" class="btn btn-primary order-button" data-food-id="{{ $item->id }}" data-bs-toggle="modal" data-bs-target="#orderModal">
                            Đặt món
                          </button>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Modal -->
    <!-- Modal -->
    <div class="modal fade" id="orderModal" tabindex="-1" aria-labelledby="orderModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('order.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="lunch_request_id" value="{{ $lunch_request->id }}">
                    <input type="hidden" name="eatery_id" value="{{ $eatery->id }}">
                    <input type="hidden" name="food_id" id="food_id">

                    <div class="modal-header">
                        <h5 class="modal-title" id="orderModalLabel">Đặt món</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="quantity" class="form-label">Số lượng</label>
                            <input type="number" class="form-control" id="quantity" name="quantity" required>
                        </div>
                        <div class="mb-3">
                            <label for="note" class="form-label">Ghi chú</label>
                            <select class="form-control" id="note" name="note">
                                <option value="Mua về">Mua về</option>
                                <option value="Đi ăn ngoài">Đi ăn ngoài</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                        <button type="submit" class="btn btn-primary">Đặt món</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <!-- JavaScript để hiện/ẩn form và nút -->
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Include Bootstrap JavaScript -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script>
        document.querySelectorAll('.order-button').forEach(button => {
            button.addEventListener('click', function() {
                const foodId = this.dataset.foodId;
                document.getElementById('food_id').value = foodId;
            });
        });
    </script>
@endsection
