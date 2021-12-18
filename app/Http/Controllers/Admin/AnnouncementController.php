<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAnnouncementRequest;
use App\Models\Announcement;
use App\Models\AnnouncementType;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Inertia\Inertia;
use function Sodium\add;

class AnnouncementController extends Controller
{


    public function create()
    {

        $skupiny = User::select('id','name','class')->where('class','!=',null)
            ->get()
            ->groupBy('class')
            ->sortKeys();


        $users = Collection::empty();
        foreach ($skupiny as $key => $skupina){
            $users->push(['users' => $skupiny[$key] , 'class' =>$key . ' Skupina']);
        }

       $announcements = Announcement::whereDate('visible_until','>=',today())->orWhere('visible_until',null)->latest()->get();




        return Inertia::render('Admin/Oznamenia/Create')->with([
            'users' => $users,
            'announcements' => $announcements
        ]);
    }


    public function store(StoreAnnouncementRequest $request)
    {
        $data = $request->all();
        $announcement = Announcement::create([
            'title' => $request['title'],
            'body' => $request['body'],
            'visible_until' => $request['visible_until']
            ]);

        $users = User::find(collect($data['users'])->pluck('id'));
        $announcement->users()->attach($users);

        if($request['send_email']){
            Mail::bcc($users)->send(new \App\Mail\Announcement($announcement));
        }

        return redirect()->route('admin.oznamenie.create');
    }

    public function destroy()
    {
        $a = Announcement::findOrFail(request()->all()['id']);
        $a->users()->detach();
        $a->delete();

        return redirect()->route('admin.oznamenie.create');

    }


    public function upratovanie()
    {
        $announcements = Announcement::wherehas('announcement_type', function($q){
            $q->where( 'name' ,'upratovanie');
        })
            ->whereDate('visible_until','>=',today())
            ->get();

        dd($announcements);


    }

    public function upratovanie_store()
    {
        $data = \request()->validate([
            'class' => ['required','digits_between:1,4'],
            'day' => ['required','date','after:yesterday'],
            'send_email' => ['required','boolean']
        ]);

        Announcement::create([
            'announcement_type_id' => 1,
            'visible_until' => $data['day']
        ]);

        if ($data['send_email']){
            //send email
        }
        return redirect()->route('admin.upratovanie.create');
    }
}
