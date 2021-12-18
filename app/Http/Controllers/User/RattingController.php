<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Apartment;
use App\Models\AvailableOuting;
use App\Models\RatingRule;
use App\Models\Ratting;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Inertia\Inertia;
use phpDocumentor\Reflection\DocBlock\Tags\Author;

class RattingController extends Controller
{
    public function index()
    {
           $rattings =  Ratting::whereHas('apartment',function ($q){
               $q->whereHas('users',function ($q){
                   $q->where('id',auth()->id());
               });
            })->whereDate('created_at','>=',Carbon::now()->subMonth()->startOfWeek())
               ->get()
               ->groupBy(function($date) {
                   return (Carbon::parse($date->created_at)->startOfWeek()->format('d-m') . ' - ' .Carbon::parse($date->created_at)->endOfWeek()->format('d-m')); // grouping by months

//                   return (Carbon::parse($date->created_at)->format('W') . ' týždeň'); // grouping by months
               })->reverse();

//           dd($rattings);





//        $array = Collection::empty();
//        $period = CarbonPeriod::create(Carbon::now()->subWeek(3)->startOfWeek(), '1 days', today());
//
//        foreach ($period as $key => $date) {
//            $array->push($date);
//        }




        $ratingRule = RatingRule::orderByDesc('min_rating')->where('class',auth()->user()->class)->get();





            return Inertia::render('User/Hodnotenie/Index')->with([
                'rattings' => $rattings,
                'ratingRule' => $ratingRule
            ]);
    }
}
