<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // دسته‌های اصلی
        $mainCategories = [
            'کالای دیجیتال' => ['موبایل','لپ تاپ'],
            'خانه' => ['نور و روشنایی','فرش'],
            'وسایل نقلیه' => ['ماشین','موتور'],
            'خدمات' => ['نظافت','آموزشی'],
            'سرگرمی' => ['بلیط','حیوانات'],
            'وسایل شخصی' => ['کفش','لوازم تحریر'],
            'تجهیزات' => ['ابزار','مصالح ساختمانی'],
            'اجتماعی' => ['رویداد','گم شده ها'],
        ];

        foreach ($mainCategories as $parent => $children) {
            // ایجاد دسته‌ی والد
            $parentCategory = Category::create([
                'name' => $parent,
                'parent_id' => null
            ]);

            // ایجاد زیر‌دسته‌ها
            foreach ($children as $child) {
                Category::create([
                    'name' => $child,
                    'parent_id' => $parentCategory->id
                ]);
            }
        }
    }
}
