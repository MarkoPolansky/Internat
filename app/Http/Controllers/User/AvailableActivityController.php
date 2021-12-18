<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\ActivityVote;
use Illuminate\Http\Request;

class AvailableActivityController extends Controller
{
    public function vote(Request $request)
    {
        $data = $request->validate([
            'activityId' => ['required','exists:available_activities,id']
        ]);

        ActivityVote::where('user_id',auth()->id())
            ->whereDate('created_at',today())
            ->updateOrCreate(
                ['user_id' => auth()->id()],
                ['available_activity_id' => $data['activityId']]
            );

        return redirect()->route('dashboard');
    }
}
