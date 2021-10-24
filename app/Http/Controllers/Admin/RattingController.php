<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Apartment;
use App\Models\Ratting;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Inertia\Inertia;

class RattingController extends Controller
{
    public function create()
    {
      $rooms = Apartment::with('todayRatting')->get();


      return Inertia::render('Admin/Hodnotenie/Create')->with([
          'rooms' => $rooms
      ]);
   }

    public function update()
    {


        $rooms = Apartment::with('todayRatting')->get();




        foreach (request()->all() as $key=>$room){
            $a = $rooms->find($key);
            if (!$a){
                abort(404);
            }

            if ($a->todayRatting){ //updating
                if ($a->todayRatting->id !=  $room['ratingId'])
                    abort(404);


                $a->todayRatting->update([
                    'rating' => $room['rating'],
                    'user_id' => auth()->id()
                ]);
            }
            else{                   //creating
                Ratting::create([
                    'user_id' => auth()->id(),
                    'apartment_id' => $key,
                    'rating' => $room['rating']
                ]);
            }

         }

      return redirect()->route('admin.dashboard');
   }
}
