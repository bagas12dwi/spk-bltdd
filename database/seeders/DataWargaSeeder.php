<?php

namespace Database\Seeders;

use App\Models\DataWarga;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DataWargaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DataWarga::factory()->count(50)->create();
    }
}
