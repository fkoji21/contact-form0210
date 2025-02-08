<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Contact; 

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run(): void
    {
        // Categoriesのシードを実行
        $this->call(CategoriesTableSeeder::class);

        // Contactsのダミーデータを 35 件作成
        Contact::factory()->count(35)->create();
    }
}
