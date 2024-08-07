{{-- show lunchRequest --}}
@extends('employee.layouts.app')
@section('content')
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
                        <a href="employee/showFoods/{{$item->id}} ">
                            <button type="button" class="btn btn-primary">Đặt món</button>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>

    </div>
</div>
@endsection
