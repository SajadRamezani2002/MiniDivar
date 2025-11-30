@extends('layouts.app')
@section('title', 'ثبت آگهی جدید')

@section('content')
<div class="container py-4">
    <h3 class="fw-bold text-danger mb-4">ثبت آگهی جدید</h3>

    {{-- نمایش خطاها --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ __($error) }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('ads.store') }}" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label class="form-label">عنوان آگهی</label>
            <input type="text" name="title" class="form-control" value="{{ old('title') }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">دسته‌بندی</label>
            <select name="category_id" class="form-control" required>
                <option value="">انتخاب کنید</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">قیمت (تومان)</label>
            <input type="number" name="price" class="form-control" value="{{ old('price') }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">شهر</label>
            <input type="text" name="city" class="form-control" value="{{ old('city') }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">توضیحات</label>
            <textarea name="description" class="form-control" rows="5" required>{{ old('description') }}</textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">تصاویر آگهی (حداکثر 4 عکس)</label>
            <input type="file" name="images[]" class="form-control" accept=".jpg,.jpeg,.png" multiple>
        </div>

        <button type="submit" class="btn btn-danger w-100">ثبت آگهی</button>
    </form>
</div>
@endsection
