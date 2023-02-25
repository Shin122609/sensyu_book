<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('primary_categories')->insert([
            [
            'name'=>'集英社',
            'sort_order'=>1,
                ],
            [
            'name'=>'講談社',
            'sort_order'=>2,
                ],

            [
            'name'=>'小学館',
            'sort_order'=>3,
                ],
        ]);

        DB::table('secondary_categories')->insert([
            [
            'name'=>'ジャンプ',
            'sort_order'=>1,
            'primary_category_id'=>1,
                ],
            [
            'name'=>'マガジン',
            'sort_order'=>2,
            'primary_category_id'=>2,

                ],

            [
            'name'=>'サンデー',
            'sort_order'=>3,
            'primary_category_id'=>3,

                ],
            [
            'name'=>'ヤングジャンプ',
            'sort_order'=>4,
            'primary_category_id'=>1,
                ],

                
        ]);
    }
}
