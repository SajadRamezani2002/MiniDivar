@extends('layouts.app')
@section('title', 'ثبت آگهی جدید')

@push('styles')
<!-- استایل‌های قبلی شما بدون تغییر -->
<style>
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
    .tips-sidebar { position: sticky; top: 100px; }
    .tips-card { background: #ffffff; border-radius: 1rem; padding: 1.5rem; box-shadow: 0 5px 15px rgba(0,0,0,0.07); border: 1px solid #e9ecef; }
    .tips-card h5 { font-weight: 700; color: #2c3e50; margin-bottom: 1rem; }
    .tips-card ul { list-style: none; padding: 0; }
    .tips-card li { padding-right: 1.5rem; position: relative; margin-bottom: 0.75rem; color: #495057; font-size: 0.9rem; }
    .tips-card li::before { content: '✔'; position: absolute; right: 0; color: #28a745; font-weight: bold; }
    .btn-submit-form { background-color: #e74c3c; border: none; padding: 0.8rem 2rem; font-size: 1.1rem; font-weight: 600; border-radius: 0.5rem; color: white; transition: all 0.3s ease; }
    .btn-submit-form:hover { background-color: #c0392b; transform: translateY(-2px); box-shadow: 0 5px 15px rgba(231, 76, 60, 0.4); color: white; }

    /* استایل‌های جدید برای بخش تصاویر */
    .image-upload-area {
        border: 2px dashed #ced4da;
        border-radius: 0.5rem;
        padding: 2rem;
        text-align: center;
        transition: all 0.3s ease;
        cursor: pointer;
    }
    .image-upload-area:hover {
        border-color: #e74c3c;
        background-color: #f8f9fa;
    }
    .image-preview-item {
        position: relative;
        margin-bottom: 1rem;
        border-radius: 0.5rem;
        overflow: hidden;
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    }
    .image-preview-item img {
        width: 100%;
        height: 200px;
        object-fit: cover;
        transition: transform 0.3s ease;
    }
    .image-preview-item:hover img {
        transform: scale(1.05);
    }
    .image-preview-actions {
        position: absolute;
        top: 10px;
        left: 10px;
        opacity: 0.8;
    }
</style>
<!-- استایل‌های کتابخانه Cropper.js -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.6.1/cropper.min.css">
@endpush

@section('content')
<div class="container ad-creation-wrapper">
    <div class="row">
        <div class="col-lg-8">
            <div class="card ad-form-card">
                <!-- هدر یکپارچه و هماهنگ با سایت -->
                <div class="card-header">
                    <h3 class="fw-bold mb-1">
                        <i class="bi bi-plus-circle-fill text-danger me-2"></i>
                        ثبت آگهی جدید
                    </h3>
                    <p class="text-muted mb-0">اطلاعات زیر را با دقت تکمیل کنید تا آگهی شما سریع‌تر منتشر شود.</p>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('ads.store') }}" enctype="multipart/form-data" id="adCreationForm">
                        @csrf

                        <!-- بخش ۱: اطلاعات اصلی -->
                        <div class="form-section">
                            <h6 class="form-section-title"><i class="bi bi-info-circle-fill"></i> اطلاعات اصلی آگهی</h6>
                            <div class="mb-3">
                                <label for="title" class="form-label">عنوان آگهی</label>
                                <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" id="title" value="{{ old('title') }}" placeholder="مثلا: iPhone 13 Pro Max 256 گیگابایت" required>
                                @error('title') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                            <div class="mb-3">
                                <label for="category_id" class="form-label">دسته‌بندی</label>
                                <select name="category_id" class="form-select @error('category_id') is-invalid @enderror" id="category_id" required>
                                    <option value="" disabled selected>دسته‌بندی مورد نظر را انتخاب کنید</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                    @endforeach
                                </select>
                                @error('category_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                        </div>

                        <!-- بخش ۲: جزئیات -->
                        <div class="form-section">
                            <h6 class="form-section-title"><i class="bi bi-geo-alt-fill"></i> جزئیات و موقعیت</h6>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="price" class="form-label">قیمت (تومان)</label>
                                    <input type="number" name="price" class="form-control @error('price') is-invalid @enderror" id="price" value="{{ old('price') }}" placeholder="مثال: 15000000" required>
                                    @error('price') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="city" class="form-label">شهر</label>
                                    <input type="text" name="city" class="form-control @error('city') is-invalid @enderror" id="city" value="{{ old('city') }}" placeholder="مثال: تهران" required>
                                    @error('city') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                                <div class="col-12 mb-3">
                                    <label for="description" class="form-label">توضیحات کامل</label>
                                    <textarea name="description" class="form-control @error('description') is-invalid @enderror" id="description" rows="6" placeholder="توضیحات کامل، وضعیت کالا، نحوه تحویل و هر اطلاعات مفید دیگری را بنویسید." required>{{ old('description') }}</textarea>
                                    @error('description') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                            </div>
                        </div>

                        <!-- بخش ۳: تصاویر  -->
                        <div class="form-section">
                            <h6 class="form-section-title"><i class="bi bi-images"></i> تصاویر آگهی</h6>
                            <div class="mb-3">
                                <label for="images" class="form-label">انتخاب تصاویر</label>
                                <div class="image-upload-area" onclick="document.getElementById('imageInput').click()">
                                    <i class="bi bi-cloud-upload" style="font-size: 3rem; color: #ced4da;"></i>
                                    <p class="mt-2 mb-0">روی این قسمت کلیک کرده یا تصاویر را بکشیدید.</p>
                                    <small class="text-muted">حداکثر 4 تصویر، هر کدام حداکثر 3 مگابایت (JPG, PNG)</small>
                                </div>
                                <input type="file" name="images[]" class="form-control @error('images.*') is-invalid @enderror" id="imageInput" accept=".jpg,.jpeg,.png" multiple style="display: none;">
                                @error('images.*') <div class="text-danger mt-2">{{ $message }}</div> @enderror
                            </div>

                            <!-- اینجا پیش‌نمایش تصاویر نمایش داده می‌شود -->
                            <div id="imagePreviewContainer" class="row">
                                <!-- تصاویر به صورت داینامیک اینجا اضافه می‌شوند -->
                            </div>
                        </div>

                        <!-- ورودی مخفی برای نگهداری داده‌های تصاویر برش‌خورده -->
                        <input type="hidden" name="cropped_images_data" id="croppedImagesData" value="[]">

                        <div class="text-center mt-4">
                            <button type="submit" class="btn btn-submit-form">
                                <i class="bi bi-check-circle me-2"></i> ثبت و انتشار آگهی
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-lg-4 d-none d-lg-block">
            <div class="tips-sidebar">
                <div class="tips-card">
                    <h5><i class="bi bi-lightbulb-fill text-warning me-2"></i> نکات کلیدی</h5>
                    <ul>
                        <li>عنوان دقیق و کامل بنویسید.</li>
                        <li>قیمت منصفانه و رقابتی تعیین کنید.</li>
                        <li>توضیحات کامل و صادقانه ارائه دهید.</li>
                        <li>از تصاویر باکیفیت و واقعی استفاده کنید.</li>
                        <li>کالای خود را در دسته‌بندی صحیح قرار دهید.</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- مودال برای ابزار برش (بدون تغییر) -->
<div class="modal fade" id="cropModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">برش تصویر</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <img id="imageToCrop" style="max-width: 100%;">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">انصراف</button>
                <button type="button" class="btn btn-primary" id="saveCropBtn">ذخیره برش</button>
            </div>
        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.6.1/cropper.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const imageInput = document.getElementById('imageInput');
    const previewContainer = document.getElementById('imagePreviewContainer');
    const croppedDataInput = document.getElementById('croppedImagesData');
    let cropper;
    let currentImageIndex = -1;
    let originalFiles = [];

    imageInput.addEventListener('change', function(event) {
        originalFiles = Array.from(event.target.files);
        previewContainer.innerHTML = '';
        croppedDataInput.value = JSON.stringify([]);

        originalFiles.forEach((file, index) => {
            const reader = new FileReader();
            reader.onload = function(e) {
                const div = document.createElement('div');
                div.className = 'col-md-6 col-lg-4 image-preview-item';
                div.innerHTML = `
                    <img src="${e.target.result}" class="img-fluid">
                    <div class="image-preview-actions">
                        <button type="button" class="btn btn-sm btn-info crop-btn" data-index="${index}">برش</button>
                    </div>
                `;
                previewContainer.appendChild(div);
            };
            reader.readAsDataURL(file);
        });
    });

    previewContainer.addEventListener('click', function(e) {
        if (e.target.classList.contains('crop-btn')) {
            currentImageIndex = e.target.dataset.index;
            const reader = new FileReader();
            reader.onload = function(e) {
                const imageToCrop = document.getElementById('imageToCrop');
                imageToCrop.src = e.target.result;
                const modal = new bootstrap.Modal(document.getElementById('cropModal'));
                modal.show();

                cropper = new Cropper(imageToCrop, {
                    aspectRatio: 4 / 3,
                    viewMode: 1,
                });
            };
            reader.readAsDataURL(originalFiles[currentImageIndex]);
        }
    });

    document.getElementById('saveCropBtn').addEventListener('click', function() {
        if (cropper) {
            const canvas = cropper.getCroppedCanvas({
                width: 800,
                height: 600
            });
            const croppedDataUrl = canvas.toDataURL('image/jpeg', 0.9);

            let croppedData = JSON.parse(croppedDataInput.value);
            croppedData[currentImageIndex] = croppedDataUrl;
            croppedDataInput.value = JSON.stringify(croppedData);

            // آیکون برش را تغییر می‌دهیم تا کاربر بداند برش ذخیره شده
            const cropButton = previewContainer.querySelector(`.crop-btn[data-index="${currentImageIndex}"]`);
            cropButton.textContent = 'برش شد';
            cropButton.classList.remove('btn-info');
            cropButton.classList.add('btn-success');
            cropButton.disabled = true;

            cropper.destroy();
            bootstrap.Modal.getInstance(document.getElementById('cropModal')).hide();
        }
    });
});
</script>
@endsection
