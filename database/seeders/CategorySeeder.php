<?php

namespace Database\Seeders;
use Illuminate\Support\Str;
use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $demo_category = [
            'Honey',
            'Natural Oil',
            'Nuts',
            'Coconut',
            'Butter',
        ];

        foreach($demo_category as $value){
            Category::create([
                'title'=>$value,
                'slug'=>str::slug($value),

            ]);
        }
    }
}
