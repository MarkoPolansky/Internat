<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Announcement;
use App\Models\Cleaning;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CleaningController extends Controller
{
    public function create()
    {
        $cleanings = Cleaning::whereDate('day' , '>=', today())->orderBy('day')->get();

        return Inertia::render('Admin/Oznamenia/UpratovanieCreate')->with([
            'cleanings' => $cleanings
        ]);
    }


    public function store()
    {
        Cleaning::create(request()->validate([
            'class' => ['required','digits_between:1,4'],
            'day' => ['required','date','after:yesterday'],
        ]));

        return redirect()->route('admin.upratovanie.create');
    }

    public function destroy()
    {

        Cleaning::findOrFail(request()->all()['id'])->delete();


        return redirect()->route('admin.upratovanie.create');
    }
}
