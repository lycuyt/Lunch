@extends('layouts.app')

@section('content')
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="/food/{{$food->id}}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="name">Tên Món Ăn</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $food->name) }}"
                required>
        </div>

        <div class="form-group">
            <label for="description">Mô Tả</label>
            <textarea class="form-control" id="description" name="description" rows="3" required>{{ old('description', $food->description) }}</textarea>
        </div>

        <div class="form-group">
            <label for="price">Giá</label>
            <input type="number" class="form-control" id="price" name="price"
                value="{{ old('price', $food->price) }}" step="0.01" min="0" required>
        </div>

        <div class="form-group">
            <label for="eatery_id">Quán Ăn</label>
            <select class="form-control" id="eatery_id" name="eatery_id" required>
                <option value="">Chọn Quán Ăn</option>
                @foreach ($eateries as $eatery)
                    <option value="{{ $eatery->id }}" {{ $food->eatery_id == $eatery->id ? 'selected' : '' }}>
                        {{ $eatery->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Lưu</button>
        <a href="{{ route('food.index') }}" class="btn btn-secondary">Hủy</a>
    </form>
@endsection
