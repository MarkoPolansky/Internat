<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\AvailableOuting;
use App\Models\Outing;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function index()
    {


        $outing = Outing::with('available_outing')->where('user_id', auth()->id())->whereDate('created_at',today())->where('arrived',null)->first();;



        $available_outing = AvailableOuting::where('user_id', auth()->id())
            ->latest()
            ->first();

        if ($available_outing)
        if ($available_outing->until < Carbon::now()->toTimeString())
            $available_outing = null;



        return Inertia::render('User/Dashboard')->with([
            'available_outing' => $available_outing,
            'outing' => $outing
        ]);
    }
}
