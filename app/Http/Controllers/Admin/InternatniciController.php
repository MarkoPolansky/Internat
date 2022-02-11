<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UpdateInternatistaRequest;
use App\Models\Apartment;
use App\Models\Invite;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Psy\Util\Str;

class InternatniciController extends Controller
{
    public function index()
    {

        $users = User::whereHas('roles', function ($q){
            $q->where('name', 'internatista');
        })->with('apartment')
            ->latest()
            ->get();

        return Inertia::render('Admin/Users/Internatnici')->with([
            'users' => $users
        ]);
    }





    public function destroy(User $user)
    {
        abort_if(!$user->roles->pluck('name')->contains('internatista'),403);;

        $user->delete();

        return redirect()->route('admin.internatnici');
    }

    public function show($user_id)
    {

        $user = User::whereHas('roles', function ($q){
            $q->where('name', 'internatista');
        })->with('roles','apartment','available_outing')
            ->findOrfail($user_id);

        $apartments = Apartment::select('name','id')->get();

        return Inertia::render('Admin/Users/InternatniciShow')->with([
            'user' => $user,
            'apartments' => $apartments
        ]);
    }

    public function update(UpdateInternatistaRequest $request, User $user)
    {
        $data = $request->only(['name', 'apartment','class',]);



        $user->name = $data['name'];
        $user->class = $data['class'];

        if (isset($data['apartment']['id']))
            $user->apartment_id = $data['apartment']['id'];

        $user->save();

        return redirect()->route('admin.internatnici');

    }
}
