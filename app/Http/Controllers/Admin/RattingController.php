<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Apartment;
use App\Models\Ratting;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Ramsey\Collection\Collection;

class RattingController extends Controller
{

    public function index()
    {

    }

    public function create()
    {
      $rooms = Apartment::with('todayRatting')->get();

      return Inertia::render('Admin/Hodnotenie/Create')->with([
          'rooms' => $rooms
      ]);
   }



    public function update()
    {


        \request()->validate([
            '*.message' => ['nullable','max:255']
        ]);

        $rooms = Apartment::with('todayRatting')->get();
        $creating = \Illuminate\Support\Collection::empty();
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
                    'message' => $room['message'],
                ]);
            }
            else{                   //creating
                $creating->push([
                    'apartment_id' => $key,
                    'rating' => $room['rating'],
                    'message' => $room['message'],
                    'updated_at' => now(),
                    'created_at' => now(),
                ]);
            }
         }

        Ratting::insert($creating->toArray());

      return redirect()->route('admin.dashboard');
   }


}
