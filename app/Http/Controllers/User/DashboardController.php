<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Activity;
use App\Models\ActivityVote;
use App\Models\Announcement;
use App\Models\AvailableActivity;
use App\Models\AvailableOuting;
use App\Models\Cleaning;
use App\Models\Outing;
use App\Models\Ratting;
use App\Models\User;
use App\Models\Workout;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;
use function Symfony\Component\Translation\t;

class DashboardController extends Controller
{
    public function index()
    {


        $outing = Outing::with('available_outing')->where('user_id', auth()->id())->whereDate('created_at',today())->where('arrived',null)->first();;

        $availableActivities = AvailableActivity::with(['todayVoters'=> function($q){
            $q->where('user_id',auth()->id());
        }])->withCount('todayVoters')->get();
        $activities  = Activity::whereDate('created_at',today())->with('availableActivity')->get();

        $rattings = DB::table('rattings')
            ->select('rattings.created_at','rattings.rating')
            ->join('apartments','rattings.apartment_id','=','apartments.id')
            ->join('users','apartments.id','=','users.apartment_id')
            ->where('users.id','=',auth()->id())
            ->whereBetween('rattings.created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])
            ->get();

        $rattedDays = [
            'utorok' => 0,
            'streda' => 0,
            'štvrtok' => 0,
            'piatok' => 0,
        ];



        foreach ($rattings as $ratting){
            if (isset($rattedDays[Carbon::create($ratting->created_at)->isoformat('dddd')])){
                $rattedDays[Carbon::create($ratting->created_at)->isoformat('dddd')] = $ratting->rating*20 ;
            }
        }

        $rattings =  Ratting::whereHas('apartment',function ($q){
            $q->whereHas('users',function ($q){
                $q->where('id',auth()->id());
            });
        })->whereBetween('created_at',[Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])
            ->get();


        $rattedDays = [
            'utorok' => 0,
            'streda' => 0,
            'štvrtok' => 0,
            'piatok' => 0,
        ];

        foreach ($rattings as $ratting){
            if (isset($rattedDays[Carbon::create($ratting->created_at)->isoformat('dddd')])){
                $rattedDays[Carbon::create($ratting->created_at)->isoformat('dddd')]
                    = array('ratting' =>$ratting->rating*20 , 'message' => $ratting->message )  ;
            }
        }




        $available_outing = AvailableOuting::where('user_id', auth()->id())
            ->latest()
            ->first();

//        if ($available_outing)
//            if ($available_outing->until < Carbon::now())
//                $available_outing = null;

       $announcements = Announcement::whereHas('users',function ($q){
           $q->where('id', auth()->id());
       })->where(function ($q){
           $q->Where('visible_until',null);
           $q->orWhereDate('visible_until','>=',today());
       })->latest()
           ->get();


        $cleaning = Cleaning::where('class' ,auth()->user()->class)->whereBetween('day',[today(),today()->addDay(6)])->orderBy('day')->first();

        $isOnWorkout = Workout::where('user_id',auth()->id())
            ->where('arrived',null)
            ->latest()
            ->take(1)->count();






        return Inertia::render('User/Dashboard')->with([
            'available_outing' => $available_outing,
            'outing' => $outing,
            'cleaning' => $cleaning,
            'announcements' => $announcements,
            'availableActivities' => $availableActivities,
            'activities' => $activities,
            'rattedDays' => $rattedDays,
            'isOnWorkout' => $isOnWorkout
        ]);
    }
}
