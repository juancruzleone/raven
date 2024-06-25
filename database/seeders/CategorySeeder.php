<?php

namespace Database\Seeders;

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    public function run()
    {
        $categories = [
            ['name' => 'Criptomonedas', 'slug' => 'criptomonedas'],
            ['name' => 'Trading', 'slug' => 'trading'],
            ['name' => 'Educación Crypto', 'slug' => 'educacion-crypto'],
        ];

        DB::table('crypto_categories')->insert($categories);
    }
}
