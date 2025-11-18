<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\CategoryUser;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategoryUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $number_of_users = User::all()->count();
        $number_of_categories = Category::all()->count();
        for($i = 1; $i <= $number_of_users; $i++){
            $categories = Category::all()->shuffle();
            $number_of_user_categories = rand(3,$number_of_categories);
            for($j = 1; $j <= $number_of_user_categories; $j++){
                $category_id = $categories->pop()->id;
                CategoryUser::create([
                    'category_id' => $category_id,
                    'user_id' => $i
                ]);
            }
        }
    }
}
