<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AvailableActivity;
use Illuminate\Http\Request;
use Inertia\Inertia;

class AvailableActivitiesController extends Controller
{
    public function index()
    {
       $AvailableActivities = AvailableActivity::all();

        return Inertia::render('Admin/Aktivity/AvailableActivities/Index')->with([
            'availableActivities' => $AvailableActivities
        ]);
   }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required','max:255','unique:available_activities,name']
        ]);

        AvailableActivity::create([
            'name' => $request->get('name')
        ]);

        return redirect()->back();
   }

    public function edit(AvailableActivity $availableActivity)
    {
        return Inertia::render('Admin/Aktivity/AvailableActivities/Show')->with([
            'availableActivity' => $availableActivity
        ]);
   }

    public function update(AvailableActivity $availableActivity, Request $request)
    {
        $request->validate([
            'name' => ['required','max:255','unique:available_activities,name']
        ]);

        $availableActivity->name = $request->get('name');
        $availableActivity->save();

        return redirect()->back();

     }

    public function destroy(AvailableActivity $availableActivity)
    {

        $availableActivity->delete();


        return redirect()->route('admin.availableActivities.index');

   }
}
