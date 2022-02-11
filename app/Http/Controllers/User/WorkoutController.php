<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Workout;
use Illuminate\Http\Request;

class WorkoutController extends Controller
{
    public function odchod()
    {

        $workout = Workout::where('user_id', auth()->id())
            ->where('arrived',null)
            ->first();

        abort_if($workout != null,404,);



        Workout::create([
            'user_id' => auth()->id(),
        ]);

        return redirect()->route('dashboard');
    }

    public function prichod()
    {
        $workout = Workout::where('user_id', auth()->id())
            ->where('arrived',null)
            ->first();

        abort_if($workout == null,404,);


        $workout->arrived = now();
        $workout->save();


        return redirect()->route('dashboard');

    }
}
