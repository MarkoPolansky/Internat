<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\AvailableOuting;
use App\Models\Outing;
use Carbon\Carbon;
use Illuminate\Http\Request;

class OutingController extends Controller
{
    public function odchod()
    {
        $available_outing = AvailableOuting::where('user_id', auth()->id())
            ->latest()
            ->first();



        abort_if($available_outing->until < Carbon::now(),404,);
        abort_if($available_outing->is_banned == true,404,);
      //  abort_if(404,); situacia ked existuje uz outing policies


        Outing::create([
            'user_id' => auth()->id(),
            'available_outing_id' => $available_outing->id
        ]);


        return redirect()->route('dashboard');

    }
}
