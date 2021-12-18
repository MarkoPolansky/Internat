<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Apartment;
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

    public function show($apartmentId)
    {
       $apartment = Apartment::with('lastMonthRattings','users')->where('id', $apartmentId)->firstOrFail();

       $rattingByWeeks = $apartment->lastMonthRattings->groupBy(function($date) {
           return (Carbon::parse($date->created_at)->format('W') . ' týždeň'); // grouping by months
       })->reverse();

       return Inertia::render('Admin/Izby/Show')->with([
           'apartment' => $apartment,
           'rattingByWeeks' => $rattingByWeeks
       ]);
    }
}
