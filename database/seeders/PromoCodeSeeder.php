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
            'code' => 'DISCOUNT50',
            'discount' => 50,
            'expiration_date' => '2024-12-31',
        ]);

        PromoCode::create([
            'code' => 'SAVE20',
            'discount' => 20,
            'expiration_date' => '2024-10-31',
        ]);
    }
}
