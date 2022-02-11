<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Activity;
use App\Models\ActivityVote;
use App\Models\Apartment;
use App\Models\AvailableActivity;
use App\Models\AvailableOuting;
use App\Models\Outing;
use App\Models\Ratting;
use App\Models\User;
use App\Models\Workout;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function index()
    {

       $availableActivities = AvailableActivity::withCount('todayVoters')->get();
       $activities  = Activity::whereDate('created_at',today())->with('availableActivity')->get();

       $rattedRooms = Ratting::whereDate('created_at', today())->where('rating','!=',null)->count();
       $roomsCount = Apartment::count();

         $outings = Outing::with('user','available_outing')
             ->whereDate('created_at', today())
             ->where('arrived', null)
             ->latest()
             ->get();

        $workouts = Workout::with('user')->today()->where('arrived',null)->latest()->get();






        return Inertia::render('Admin/Dashboard')->with([
            'rattedRooms' => $rattedRooms,
            'roomsCount' => $roomsCount,
            'outings' => $outings,
            'availableActivities' => $availableActivities,
            'activities' => $activities,
            'workouts' => $workouts
        ]);

    }
}
