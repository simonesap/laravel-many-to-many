<?php

use Illuminate\Database\Seeder;
use App\Models\Category;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $categories = config('categories');

        $categories = [
            ['label'=>'Finanza', 'color'=>'warning'],
            ['label'=>'Sport', 'color'=>'danger'],
            ['label'=>'Mare', 'color'=>'primary'],
            ['label'=>'Paesaggi', 'color'=>'light'],
            ['label'=>'Finanza', 'color'=>'info'],
        ];

        foreach($categories as $category )
        {
            $new_category = new Category();
            $new_category->label = $category['label'];
            $new_category->color = $category['color'];
            $new_category->save();

            // DB::table('users')->insert([
            //     'label' => Str::random(10)->$category->label,
            //     'color' => Str::random(10)->$category->color,
            // ]);
        };
    }
}
