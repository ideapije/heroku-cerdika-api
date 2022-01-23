<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\ChoiceStore;
use App\Models\MemberSubmission;
use App\Models\Question;
use Carbon\Carbon;
use Illuminate\Http\Request;

class QuestionApiController extends Controller
{
    public function index(Request $request, Question $questions)
    {
        $questions = $questions->where('group', $request->g ?? 'kepatuhan');
        $questions = $questions->with(['choices'])->get();
        return response()->success($questions);
    }

    public function show(Request $request)
    {
        $submissions = $request->user()->load([
            'submissions.question.choices',
            'submissions.question' => function($query) use($request) {
                $query->where('group', $request->g ?? 'kepatuhan' );
            }
        ]);
        $submissions = collect($submissions['submissions'])->map(function($submission){
            if ($submission->question) {
                $score = $submission->question->choices()->where('choice_id', $submission->choice_id)->first();
                return collect($submission->question)->merge($score->pivot);
            }
            return null;
        })->filter(function($submission){
            return ($submission);
        });
        return response()->success($submissions);
    }

    public function store(ChoiceStore $request)
    {
        $submission = $request->user()
            ->submissions()
            ->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])
            ->get();

        if ($submission->count()) {
            return response()->json([
                "message" => "The given data was invalid.",
                "errors" => [
                    "Sorry, you already submitted"
                ]
            ], 400);
        } else {
            $request->user()->submissions()->createMany($request->all());
            return response()->success($request->user()->load([
                'submissions'
            ]));
        }
    }
}
