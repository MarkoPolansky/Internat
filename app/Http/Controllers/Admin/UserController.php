<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UpdateInternatistaRequest;
use App\Models\Apartment;
use App\Models\AvailableOuting;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class UserController extends Controller
{
    public function index()
    {

        $users = User::whereHas('roles',function ($q){
            $q->where('name','!=','internatista');
        })->with('roles','apartment')->latest()->get();

        return Inertia::render('Admin/Users/Index')->with([
            'users' => $users
        ]);

    }

    public function internatnici()
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

    public function show($user_id)
    {

        $user = User::whereHas('roles', function ($q){
            $q->whereIn('name', ['vychovavatel','Super-Admin']);
        })->with('roles','apartment','available_outing')
            ->findOrfail($user_id);


        return Inertia::render('Admin/Users/Show')->with([
            'user' => $user
        ]);

    }

    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('admin.users');
    }


    public function update(UpdateInternatistaRequest $request, User $user)
    {
        $data = $request->only(['name', 'apartment','class',]);



        $user->name = $data['name'];
        $user->class = $data['class'];

        if (isset($data['apartment']['id']))
        $user->apartment_id = $data['apartment']['id'];


        $user->save();



        return redirect()->route('admin.internatnici.show',$user->id);

    }
}
