<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Apartment;
use App\Models\AvailableOuting;
use App\Models\Outing;
use App\Models\RatingRule;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Inertia\Inertia;

class OutingController extends Controller
{
    public function index()
    {


        $outings = Outing::with('user','available_outing')
            ->whereDate('created_at', today())
            ->where('arrived', null)
            ->get();


        $arrivedOutings = Outing::with('user','available_outing')
            ->whereDate('created_at', today())
            ->where('arrived','!=', null)
            ->orderByDesc('arrived')
            ->get();




        $ratingRules = RatingRule::orderByDesc('min_rating')->get()->groupBy(function ($class){
            return ($class->class . ' Skupina');
        })->sort();


        return Inertia::render('Admin/Vychadzky/Index')->with([
            'outings' => $outings,
            'arrivedOutings' => $arrivedOutings,
            'ratingRules' => $ratingRules
        ]);
    }

    public function prichod()
    {

        $outing = Outing::findOrFail(\request()->all()['outingId']);

        $outing->arrived = Carbon::now()->toTimeString();
        $outing->save();

        return redirect()->back();


        return redirect()->route('admin.dashboard');
    }
}
