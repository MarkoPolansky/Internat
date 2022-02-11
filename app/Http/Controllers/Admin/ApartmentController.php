<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Apartment;
use App\Models\Ratting;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ApartmentController extends Controller
{
    public function index()
    {
        $apartments = Apartment::with('todayRatting')->withCount('users')->get();

       return Inertia::render('Admin/Izby/Index')->with([
            'apartments' => $apartments
        ]);
    }

    public function edit($apartmentId)
    {
       $apartment = Apartment::with('lastMonthRattings','users')->where('id', $apartmentId)->firstOrFail();

       $rattingByWeeks = $apartment->lastMonthRattings->groupBy(function($date) {
           return (Carbon::parse($date->created_at)->startOfWeek()->format('d-m') . ' - ' .Carbon::parse($date->created_at)->endOfWeek()->format('d-m')); // grouping by months
       })->reverse();

       return Inertia::render('Admin/Izby/Show')->with([
           'apartment' => $apartment,
           'rattingByWeeks' => $rattingByWeeks
       ]);
    }
}
