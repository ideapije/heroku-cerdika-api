<?php

namespace Database\Seeders;

use App\Models\Question;
use Illuminate\Database\Seeder;

class QuestionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $kepatuhanQuestions = collect([
            [
                "text" => "Pernahkah anda lupa minum obat?",
                "group" => "kepatuhan"
            ],
            [
                "text" => "Dalam 2 minggu terakhir, apakah anda pernah tidak minum obat?",
                "group" => "kepatuhan"
            ],
            [
                "text" => "Pernahkah anda mengurangi atau berhenti minum obat tanpa sepengetahuan dokter karena merasa obat yang diberikan membuat keadaan menjadi lebih buruk?",
                "group" => "kepatuhan"
            ],
            [
                "text" => "Pernahkah anda lupa membawa obat ketika bepergian?",
                "group" => "kepatuhan"
            ],
            [
                "text" => "Apakah anda masih minum obat anda kemarin?",
                "group" => "kepatuhan"
            ],
            [
                "text" => "Apakah anda berhenti minum obat ketika Anda merasa gejala yang dialami telah teratasi?",
                "group" => "kepatuhan"
            ],
            [
                "text" => "Apakah Anda merasa terganggu harus minum obat setiap hari?",
                "group" => "kepatuhan"
            ],
            [
                "text" => "Berapa sering anda lupa minum obat?",
                "group" => "kepatuhan"
            ]
        ]);

        $kepatuhanQuestions->each(function ($question, $index) {
            $item = Question::updateOrCreate($question);

            if ($index === 7) {
                $item->choices()->sync([
                    3 => ["score" => 1],
                    4 => ["score" => 1],
                    5 => ["score" => 1],
                    6 => ["score" => 1],
                    7 => ["score" => 0]
                ]);
            } else {
                $item->choices()->sync([
                    1 => ["score" => $index == 4 ? 1 : 0],
                    2 => ["score" => $index == 4 ? 0 : 1]
                ]);
            }
        });
    }
}
