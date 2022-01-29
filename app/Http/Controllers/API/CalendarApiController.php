<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Modules\Membership\Member;

class CalendarApiController extends Controller
{
    public function index(Request $request, Member $member)
    {
        $dates = $member->user->submissions()->with(['question'])->get();
        $dates = collect($dates)->unique('created_at')->values()->map(function($item) use($member){
            return collect($item)->merge([
                'url' => route('cerdika.logbook.show', [
                    'member' => $member,
                    'd' => $item->created_at->format('Y-m-d'),
                    'g' => $item->question->group
                ]),
                'title' => $item->question->group === 'logbook' ? 'LOGBOOK KEGIATAN' : 'KEPATUHAN MINUM OBAT',
                'start' => $item->created_at->format('Y-m-d'),
                'color' => $item->question->group === 'logbook' ? 'purple' : 'green'
            ]);
        });
        return response()->json($dates);
    }
}
