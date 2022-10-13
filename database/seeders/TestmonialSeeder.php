<?php

namespace Database\Seeders;

use App\Models\Testmonial;
use Illuminate\Database\Seeder;

class TestmonialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Testmonial::factory()->count(10)->create();
    }
}
