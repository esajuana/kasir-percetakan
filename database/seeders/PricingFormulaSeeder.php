<?php

namespace Database\Seeders;

use App\Constants\PricingFormulaCode;
use App\Models\PricingFormula;
use Illuminate\Database\Seeder;

class PricingFormulaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $formulas = [

            [
                'code'        => PricingFormulaCode::AREA,
                'name'        => 'Area',
                'description' => 'Menghitung harga berdasarkan luas (lebar × tinggi).',
            ],

            [
                'code'        => PricingFormulaCode::ROLL_WIDTH,
                'name'        => 'Roll Width',
                'description' => 'Menggunakan lebar bahan (roll width).',
            ],

            [
                'code'        => PricingFormulaCode::LOOKUP_WIDTH,
                'name'        => 'Lookup Width',
                'description' => 'Harga berdasarkan lookup lebar bahan.',
            ],

            [
                'code'        => PricingFormulaCode::PERIMETER,
                'name'        => 'Perimeter',
                'description' => 'Menghitung berdasarkan keliling.',
            ],

            [
                'code'        => PricingFormulaCode::MANUAL,
                'name'        => 'Manual',
                'description' => 'Harga diinput manual oleh kasir.',
            ],

        ];

        foreach ($formulas as $formula) {

            PricingFormula::updateOrCreate(
                [
                    'code' => $formula['code'],
                ],
                [
                    'name'        => $formula['name'],
                    'description' => $formula['description'],
                    'status'      => true,
                ]
            );

        }
    }
}