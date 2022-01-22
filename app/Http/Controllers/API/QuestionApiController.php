<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Question;
use Illuminate\Http\Request;

class QuestionApiController extends Controller
{
    public function index(Request $request, Question $questions)
    {
        $questions = $questions->where('group', $request->g ?? 'kepatuhan');
        $questions = $questions->with(['choices'])->get();
        return response()->success($questions);
    }

    public function store(Request $request)
    {
        return response()->success($request->all());
    }
}
