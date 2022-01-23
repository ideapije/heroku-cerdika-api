<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\BloodMeasureStore;
use App\Models\BloodMeasure;
use Illuminate\Http\Request;

class BloodMeasureApiController extends Controller
{
    public function index(Request $request)
    {
        $measures = collect($request->user()->load([
            'membership',
            'bloodMeasures'
        ]));
        return response()->success($measures->get('blood_measures'));
    }

    public function store(BloodMeasureStore $request, BloodMeasure $measure)
    {
        $data = $request->all();
        $data['user_id'] = $request->user()->id;
        $measure = $measure->create($data);
        return response()->success($measure);
    }
}
