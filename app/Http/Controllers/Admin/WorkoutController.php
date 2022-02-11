<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Workout;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Inertia\Inertia;

class WorkoutController extends Controller
{
    public function index()
    {
        $workouts = Workout::with('user')->today()->get();

        return Inertia::render('Admin/Aktivity/Workout/Index')->with([
            'workouts' => $workouts
        ]);
   }
}
