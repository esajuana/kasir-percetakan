<?php

namespace Database\Seeders;

use App\Constants\PriceTypeCode;
use App\Models\PriceType;
use Illuminate\Database\Seeder;

class PriceTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $priceTypes = [

            [
                'code'        => PriceTypeCode::NORMAL,
                'name'        => 'Harga Normal',
                'description' => 'Harga untuk pelanggan umum.',
            ],

            [
                'code'        => PriceTypeCode::SPONSOR,
                'name'        => 'Harga Sponsor',
                'description' => 'Harga khusus sponsor.',
            ],

        ];

        foreach ($priceTypes as $priceType) {

            PriceType::updateOrCreate(
                [
                    'code' => $priceType['code'],
                ],
                [
                    'name'        => $priceType['name'],
                    'description' => $priceType['description'],
                    'status'      => true,
                ]
            );

        }
    }
}