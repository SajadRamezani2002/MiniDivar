@extends('layouts.app')
@section('title', 'ویرایش آگهی')

@push('styles')
<!-- می‌توانید استایل‌های مشابه صفحه create را اینجا قرار دهید -->
<style>
    /* استایل‌های کلی صفحه */
    body { background-color: #f8f9fa; }
    .ad-creation-wrapper { padding-top: 2rem; padding-bottom: 4rem; }
    .ad-form-card { border: none; border-radius: 1rem; box-shadow: 0 8px 25px rgba(0, 0, 0, 0.08); overflow: hidden; }
    .ad-form-card .card-header { background-color: #ffffff; border-bottom: 1px solid #e9ecef; padding: 2rem 2rem 1rem 2rem; }
    .ad-form-card .card-body { padding: 1rem 2rem 2rem 2rem; }
    .form-section { padding: 1.5rem; border-radius: 0.75rem; background-color: #fff; border: 1px solid #e9ecef; margin-bottom: 1.5rem; }
    .form-section-title { font-weight: 700; color: #2c3e50; margin-bottom: 1.5rem; padding-bottom: 0.75rem; border-bottom: 2px solid #e74c3c; display: flex; align-items: center; }
    .form-section-title i { margin-left: 0.75rem; color: #e74c3c; }
    .form-control, .form-select { border-radius: 0.5rem; border: 1px solid #ced4da; padding: 0.75rem 1rem; transition: all 0.2s ease-in-out; }
    .form-control:focus, .form-select:focus { border-color: #e74c3c; box-shadow: 0 0 0 0.2rem rgba(231, 76, 60, 0.25); }
    .form-label { font-weight: 600; color: #495057; }
    .btn-submit-form { background-color: #e74c3c; border: none; padding: 0.8rem 2rem; font-size: 1.1rem; font-weight: 600; border-radius: 0.5rem; color: white; transition: all 0.3s ease; }
    .btn-submit-form:hover { background-color: #c0392b; transform: translateY(-2px); box-shadow: 0 5px 15px rgba(231, 76, 60, 0.4); color: white; }
</style>
@endpush

@section('content')
<div class="container ad-creation-wrapper">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card ad-form-card">
                <div class="card-header">
                    <h3 class="fw-bold mb-1">ویرایش آگهی</h3>
                    <p class="text-muted mb-0">اطلاعات آگهی خود را ویرایش کنید.</p>
                </div>
                <div class="card-body">
                    {{-- فرم ویرایش --}}
                    <form method="POST" action="{{ route('ads.update', $ad->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT') {{-- متد فرم برای ویرایش PUT است --}}

                        <!-- بخش ۱: اطلاعات اصلی -->
                        <div class="form-section">
                            <h6 class="form-section-title"><i class="bi bi-info-circle-fill"></i> اطلاعات اصلی آگهی</h6>
                            <div class="mb-3">
                                <label for="title" class="form-label">عنوان آگهی</label>
                                <input type="text" name="title" class="form-control" id="title" value="{{ $ad->title }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="category_id" class="form-label">دسته‌بندی</label>
                                <select name="category_id" class="form-select" id="category_id" required>
                                    <option value="" disabled>دسته‌بندی مورد نظر را انتخاب کنید</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}" {{ $category->id == $ad->category_id ? 'selected' : '' }}>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <!-- بخش ۲: جزئیات -->
                        <div class="form-section">
                            <h6 class="form-section-title"><i class="bi bi-gear-fill"></i> جزئیات و موقعیت</h6>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="price" class="form-label">قیمت (تومان)</label>
                                    <input type="number" name="price" class="form-control" id="price" value="{{ $ad->price }}" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="city" class="form-label">شهر</label>
                                    <input type="text" name="city" class="form-control" id="city" value="{{ $ad->city }}" required>
                                </div>
                                <div class="col-12 mb-3">
                                    <label for="description" class="form-label">توضیحات کامل</label>
                                    <textarea name="description" class="form-control" id="description" rows="6" required>{{ $ad->description }}</textarea>
                                </div>
                            </div>
                        </div>

                        <!-- دکمه ویرایش نهایی -->
                        <div class="text-center mt-4">
                            <button type="submit" class="btn btn-submit-form">
                                <i class="bi bi-check-circle me-2"></i> ثبت تغییرات
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
