<footer class="bg-dark text-white pt-5 pb-4 mt-5">
    <div class="container">
        <div class="row">
            <!-- ستون ۱: درباره ما -->
            <div class="col-lg-4 col-md-6 mb-4">
                <h5 class="fw-bold mb-3">
                    <i class="bi bi-shop me-2"></i>MiniDivar
                </h5>
                <p class="text-light">
                    پلتفرمی آسان، سریع و امن برای ثبت و پیدا کردن آگهی‌های مورد نظر شما در سراسر ایران. ما به شما کمک می‌کنیم تا به سادگی خرید و فروش کنید.
                </p>
                <!-- شبکه‌های اجتماعی -->
                <div class="mt-3">
                    <a href="#" class="text-white me-3"><i class="bi bi-telegram fs-5"></i></a>
                    <a href="#" class="text-white me-3"><i class="bi bi-instagram fs-5"></i></a>
                    <a href="#" class="text-white me-3"><i class="bi bi-linkedin fs-5"></i></a>
                    <a href="#" class="text-white"><i class="bi bi-twitter-x fs-5"></i></a>
                </div>
            </div>

            <!-- ستون ۲: لینک‌های سریع -->
            <div class="col-lg-2 col-md-6 mb-4">
                <h6 class="fw-bold mb-3">لینک‌های سریع</h6>
                <ul class="list-unstyled">
                    <li class="mb-2"><a href="{{ route('ads.index') }}" class="text-light text-decoration-none">صفحه اصلی</a></li>
                    {{-- <li class="mb-2"><a href="#" class="text-light text-decoration-none">درباره ما</a></li>
                    <li class="mb-2"><a href="#" class="text-light text-decoration-none">تماس با ما</a></li>
                    <li class="mb-2"><a href="#" class="text-light text-decoration-none">وبلاگ</a></li> --}}
                </ul>
            </div>

            <!-- ستون ۳: دسته‌بندی‌ها -->
            {{-- <div class="col-lg-3 col-md-6 mb-4">
                <h6 class="fw-bold mb-3">دسته‌بندی‌ها</h6>
                <ul class="list-unstyled"> --}}
                    {{-- <li class="mb-2"><a href="#" class="text-light text-decoration-none">املاک</a></li>
                    <li class="mb-2"><a href="#" class="text-light text-decoration-none">وسایل نقلیه</a></li>
                    <li class="mb-2"><a href="#" class="text-light text-decoration-none">الکترونیک</a></li>
                    <li class="mb-2"><a href="#" class="text-light text-decoration-none">خدمات</a></li> --}}
                {{-- </ul>
            </div> --}}

            <!-- ستون ۴: اطلاعات تماس -->
            <div class="col-lg-3 col-md-6 mb-4">
                <h6 class="fw-bold mb-3">تماس با ما</h6>
                <p class="text-light mb-1"><i class="bi bi-geo-alt me-2"></i> تهران، خیابان آزادی</p>
                <p class="text-light mb-1"><i class="bi bi-telephone me-2"></i> ۰۲۱-۱۲۳۴۵۶۷۸</p>
                <p class="text-light mb-1"><i class="bi bi-envelope me-2"></i> info@minidivar.com</p>
            </div>
        </div>

        <hr class="border-secondary my-4">

        <!-- کپی‌رایت -->
        <div class="text-center">
            <small class="text-light">
                © {{ date('Y') }} MiniDivar. تمام حقوق این سایت متعلق به MiniDivar می‌باشد.
            </small>
        </div>
    </div>
</footer>
