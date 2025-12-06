<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Ad;
use App\Models\Category;
use Illuminate\Support\Facades\Request;

class AdListing extends Component
{
    // متغیرهایی که در ویو استفاده می‌شوند
    public $ads;
    public $search;
    public $categoryId;
    public $page = 1;

    // این متد هنگام اولین بارگذاری کامپوننت اجرا می‌شود
    public function mount()
    {
        // مقادیر جستجو و فیلتر را از URL می‌خوانیم
        $this->search = request('search');
        $this->categoryId = request('category_id');

        // بارگذاری اولیه آگهی‌ها
        $this->loadAds();
    }

    // متد برای بارگذاری آگهی‌های بیشتر
    public function loadMore()
    {
        $this->page++;
        $this->loadAds();
    }

    // متد خصوصی برای دریافت آگهی‌ها از دیتابیس
    private function loadAds()
    {
        $query = Ad::with('category', 'user')
                         ->where('status', 'active');

        // منطق جستجو
        if ($this->search) {
            $query->where(function ($q) {
                $q->where('title', 'LIKE', "%{$this->search}%")
                  ->orWhere('description', 'LIKE', "%{$this->search}%");
            });
        }

        // منطق فیلتر دسته‌بندی (با متد کمکی که ساختیم)
        if ($this->categoryId) {
            $descendantIds = $this->getDescendantCategoryIds($this->categoryId);
            $query->whereIn('category_id', $descendantIds);
        }

        // بارگذاری آگهی‌های جدید و اضافه کردن به لیست فعلی
        $newAds = $query->latest()->skip(($this->page - 1) * 12)->take(12)->get();

        if ($this->page == 1) {
            $this->ads = $newAds;
        } else {
            $this->ads = $this->ads->concat($newAds);
        }
    }

    // متد کمکی برای پیدا کردن ID دسته‌های فرزند (همان متدی که در کنترلر استفاده کردیم)
    private function getDescendantCategoryIds($parentId)
    {
        $allIds = collect([$parentId]);
        $categoriesToProcess = collect([$parentId]);

        while ($categoriesToProcess->isNotEmpty()) {
            $currentIds = $categoriesToProcess->pluck('id');
            $children = Category::whereIn('parent_id', $currentIds)->get(['id']);
            $allIds = $allIds->merge($children->pluck('id'));
            $categoriesToProcess = $children;
        }

        return $allIds->unique();
    }

    // متد رندر کامپوننت
    public function render()
    {
        // ارسال لیست تمام دسته‌ها به ویو برای فیلتر
        $categories = Category::all();
        return view('livewire.ad-listing', [
            'categories' => $categories
        ]);
    }
}
