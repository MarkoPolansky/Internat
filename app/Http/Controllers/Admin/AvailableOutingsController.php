<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AvailableOuting;
use Illuminate\Http\Request;

class AvailableOutingsController extends Controller
{
    public function store(Request $request)
    {


        $data = $request->validate([
            'is_banned' => ['required','boolean'],
            'until' => ['required_if:is_banned,==,false'],
            'user_id' => ['required','exists:users,id'],
        ]);


        if ($data['is_banned']){

            AvailableOuting::create([
                'is_banned' => true,
                'user_id' => $data['user_id'],
                'created_by' => auth()->id()
            ]);
        }
        else
            AvailableOuting::create([
                'until' =>  $data['until'],
                'user_id' => $data['user_id'],
                'created_by' => auth()->id()
            ]);



     return redirect()->route('admin.internatnici.show',$data['user_id']);

    }
}
