<?php

namespace App\Http\Controllers;

use App\Http\Requests\LogbookShow;
use App\Http\Requests\LogbookStore;
use App\Models\Question;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Modules\Membership\Member;

class LogbookController extends Controller
{
    public function index(Request $request, Member $member)
    {
        return view('logbook.index', compact('member'));
    }

    public function show(LogbookShow $request, Member $member)
    {
        setlocale(LC_TIME, 'id_ID');
        Carbon::setLocale('id');
        $dateSubmitted = Carbon::parse($request->get('d'))->isoFormat('dddd, D MMMM Y');
        $params = $request->all();
        $submissions = $member->user->submissions()->where(function ($query) use ($request) {
            $query->whereDate('created_at', $request->d)
                ->whereHas('question', function ($subQuery) use ($request) {
                    $subQuery->where('group', $request->g);
                });
        })->get();
        return view('logbook.show', compact('member', 'submissions', 'params', 'dateSubmitted'));
    }

    public function create(Request $request, Member $member)
    {
        $group = $request->g ?? 'logbook';
        $questions = Question::where('group', $group)->with(['choices'])->get();
        return view('logbook.create', compact('member', 'questions', 'group'));
    }

    public function store(LogbookStore $request, Member $member)
    {
        $isSubmitted = $member->user
            ->submissions()
            ->where(function ($query) use ($request) {
                $query
                    ->whereDate('created_at', Carbon::now())
                    ->whereHas('question', function ($subQ) use ($request) {
                        $subQ->where('group', $request->g ?? 'logbook');
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
