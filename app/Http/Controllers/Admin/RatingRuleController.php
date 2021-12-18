<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\RatingRule;
use Illuminate\Http\Request;
use Inertia\Inertia;

class RatingRuleController extends Controller
{
    public function store()
    {
        $data = \request()->validate([
            'min_rating' => ['required','numeric','min:0','max:100'],
            'until' => ['required','date_format:H:i'],
            'class' => ['required','min:1','max:4','numeric']
        ]);
        $data['min_rating'] =  $data['min_rating']/20;

        RatingRule::create($data);

        return redirect()->back();
    }

    public function show(RatingRule $ratingRule)
    {
        return Inertia::render('Admin/Hodnotenie/RattingRuleShow')->with([
            'ratingRule' => $ratingRule
        ]);
    }

    public function update(RatingRule $ratingRule)
    {
        $data = \request()->validate([
            'min_rating' => ['required','numeric','min:0','max:100'],
            'until' => ['required','date_format:H:i'],
            'class' => ['required','min:1','max:4','numeric']
        ]);
        $data['min_rating'] =  $data['min_rating']/20;

        $ratingRule->update($data);

        return redirect()->back();

    }

    public function destroy(RatingRule $ratingRule)
    {

        $ratingRule->delete();

        return redirect()->route('admin.vychadzky');

    }
}
