<?php

namespace Database\Seeders;

use App\Models\PromoCode;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PromoCodeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        PromoCode::create([
            'code' => 'SAVE30',
            'discount' => 30,
            'expiration_date' => '2025-11-30',
        ]);
    }
}
