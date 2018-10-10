<?php

use Illuminate\Database\Seeder;

class RecordsCategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\RecordsCategory::class, 5)->create();
    }
}
