<?php

namespace Database\Seeders;


use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // デフォルトのカテゴリーを作成
        $categories = ['食費', '交通費', '娯楽', '光熱費', '日用品', 'その他'];
        $categories2 = ['給料', 'お小遣い', '副業', 'その他'];

        foreach ($categories as $categoryName) {
            Category::create(['name' => $categoryName, 'type' => 'expense']);
        }
        
        foreach ($categories2 as $categoryName) {
            Category::create(['name' => $categoryName, 'type' => 'income']);
        }
    }
}
