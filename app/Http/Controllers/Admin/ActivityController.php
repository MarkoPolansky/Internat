<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreActivityRequest;
use App\Mail\ActivitySelected;
use App\Models\Activity;
use App\Models\AvailableActivity;
use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Inertia\Inertia;


class ActivityController extends Controller
{
    public function index()
    {

        $availableActivities = AvailableActivity::with(['todayVoters' => function($q){
            $q->with('user');
        }])->get();

        $activities  = Activity::whereDate('created_at',today())->with('availableActivity')->get();


       return Inertia::render('Admin/Aktivity/Index')->with([
           'activities' => $activities,
           'availableActivities' => $availableActivities
       ]);
    }

    public function store(StoreActivityRequest $request)
    {

        $activities = $request->only(['availableActivities','starts_at','ends_at','send_email']);




        $creating = \Illuminate\Support\Collection::empty();
        foreach ($activities['availableActivities'] as $activity){
            $creating->push([
                'available_activity_id' => $activity['id'],
                'starts_at' => $activities['starts_at'],
                'ends_at' => $activities['ends_at'],
                'send_email' => $activities['send_email'],
                'updated_at' => now(),
                'created_at' => now(),
            ]);
        }

        Activity::insert($creating->toArray());



        if($request['send_email']){
            $users = User::whereHas('todayVote')->with('todayVote')->get();
            Mail::bcc($users)->send(new ActivitySelected($activities));
        }

       return redirect()->back();
    }


//    public function update(StoreActivityRequest $request)
//    {
//
//        $activities = $request->only(['availableActivities','starts_at','ends_at','send_email']);
//
//        foreach ($activities['availableActivities'] as $activity){
//            Activity::todayActivities()->firstOrCreate(
//                ['available_activity_id' => $activity['id']],
//                ['available_activity_id' => $activity['id']],
//                ['starts_at' => $activities['starts_at'],
//                    'ends_at' => $activities['ends_at'],
//                    'send_email' => $activities['send_email']]
//            );
//        };
//
//        return redirect()->back();
//    }

    public function edit($activityId)
    {
        $activity = Activity::with('availableActivity:id,name')->where('id',$activityId)->firstOrFail();

        return Inertia::render('Admin/Aktivity/Edit')->with([
            'activity' => $activity
        ]);
    }

    public function update(Request $request,Activity $activity )
    {

        $data = $request->validate([
            'starts_at' =>['required','date_format:H:i'],
            'ends_at' =>['required','date_format:H:i','after:starts_at'],
        ]);


        $activity->starts_at = $data['starts_at'];
        $activity->ends_at = $data['ends_at'];
        $activity->save();

        return redirect()->back();
    }

    public function destroy(Activity $activity)
    {
        $activity->delete();

        return redirect()->route('admin.activity.index');
    }

}
