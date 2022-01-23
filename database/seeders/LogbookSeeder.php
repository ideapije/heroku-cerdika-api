<?php

namespace Database\Seeders;

use App\Models\Question;
use Illuminate\Database\Seeder;

class LogbookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $logbookQuestions = collect([
            [
                "text" => "Apakah anda sudah menghindari rokok maupun asap rokok?",
                "group" => "logbook"
            ],
            [
                "text" => "Apakah anda sudah melakukan olahraga hari ini?",
                "group" => "logbook"
            ],
            [
                "text" => "Apakah anda makan sesuai diet yang telah dianjurkan?",
                "group" => "logbook"
            ],
            [
                "text" => "Apakah anda tidur selama 7-8 jam tadi malam?",
                "group" => "logbook"
            ],
            [
                "text" => "Apakah anda telah mengelola stress anda hari ini?",
                "group" => "logbook"
            ],
            [
                "text" => "Apakah anda sudah minum obat hari ini?",
                "group" => "logbook"
            ]
        ]);

        $logbookQuestions->each(function ($question, $index) {
            $item = Question::updateOrCreate($question);
            $item->choices()->sync([
                1 => ["score" => 1],
                2 => ["score" => 0]
            ]);
        });
    }
}
