<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Apartment;
use App\Models\AvailableOuting;
use App\Models\Outing;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Inertia\Inertia;

class OutingController extends Controller
{
    public function index()
    {
        $apartments =   Apartment::with('users','lastWeekRattings')->get();

        $ratingRules = [
                1 => [5 => '21:00',
                    0 =>'20:30'],

                2 => [5 => '21:30',
                        0 =>'21:00'],

                3 => [5=> '21:30',
                    0 =>'21:00'],

                4 => [5=> '21:30',
                    0 =>'21:00']
        ];
        foreach ($apartments as $apartment){
            $sumRatting =0;
            $avgRatting = 0;
            foreach ($apartment->rattings as $ratting){
                $sumRatting+=$ratting->rating;
            }
            if ($sumRatting == 0) continue;
                else
                $avgRatting = $sumRatting/$apartment->rattings->count();

            foreach ($apartment->users as $user) {
                foreach ($ratingRules[$user->class] as $key=>$until){
                    if ($avgRatting>= $key){
                        AvailableOuting::create([
                            'user_id' => $user->id,
                            'until' => $until
                        ]);
                        break;
                    }
                }

            }

        }


        dd($apartments);

        $outings = Outing::with('user','available_outing')
            ->whereDate('created_at', today())
            ->where('arrived', null)
            ->get();





        return Inertia::render('Admin/Vychadzky/Index')->with([
            'outings' => $outings
        ]);
    }

    public function prichod()
    {


        $outing = Outing::findOrFail(\request()->all()['outingId']);

        $outing->arrived = Carbon::now()->toTimeString();
        $outing->save();

        return redirect()->route('admin.dashboard');
    }
}
