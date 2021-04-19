<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Umat;

class UmatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Umat::factory()
            ->count(5)
            ->create;
    }
}
