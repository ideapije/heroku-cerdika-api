<?php

namespace App\Http\Controllers;

use App\Http\Requests\LogbookStore;
use App\Models\Question;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Modules\Membership\Member;

class LogbookController extends Controller
{
    public function index(Request $request, Member $member)
    {
        return 'Thanks!';
    }

    public function create(Request $request, Member $member)
    {
        $questions = Question::where('group', 'logbook')->with(['choices'])->get();
        return view('logbook.create', compact('member', 'questions'));
    }

    public function store(LogbookStore $request, Member $member)
    {
        $isSubmitted = $member->user
            ->submissions()
            ->where(function ($query) {
                $query
                    ->whereDate('created_at', Carbon::now())
                    ->whereHas('question', function ($subQ) {
                        $subQ->where('group', 'logbook');
                    });
            })
            ->first();
        if ($isSubmitted) {
            return abort(403);
        } else {
            $member->user->submissions()->createMany($request->get('logbook'));
            return redirect()->route('cerdika.logbook.index', $member);
        }
    }
}
