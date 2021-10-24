<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Apartment;
use App\Models\AvailableOuting;
use App\Models\Outing;
use App\Models\Ratting;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function index()
    {




       $rattedRooms = Ratting::whereDate('created_at', today())->where('rating','!=',null)->count();
       $roomsCount = Apartment::count();
       $outingsCount = Outing::whereDate('created_at', today())->where('arrived', null)->count();

         $outings = Outing::with('user','available_outing')
             ->whereDate('created_at', today())
             ->where('arrived', null)
             ->get();




        return Inertia::render('Admin/Dashboard')->with([
            'rattedRooms' => $rattedRooms,
            'roomsCount' => $roomsCount,
            'outingsCount' => $outingsCount,
            'outings' => $outings

        ]);

    }
}
