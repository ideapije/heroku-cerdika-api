<?php

namespace Database\Seeders;

use App\Models\Choice;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ChoiceTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Choice::truncate();
        $choices = collect([
            'Ya',
            'Tidak',
            'Tidak Pernah (tidak pernah)',
            'Sesekali (1x/minggu)',
            'Kadang-kadang (2-3x/minggu)',
            'Biasanya (4-6x/minggu)',
            'Selalu (7x/minggu)'
        ]);
        $choices->each(function($choice, $key){
            Choice::updateOrCreate([
                'id' => $key + 1,
                'text' => $choice
            ]);
        });
    }
}
