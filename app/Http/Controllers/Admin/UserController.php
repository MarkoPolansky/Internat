<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UpdateInternatistaRequest;
use App\Models\Apartment;
use App\Models\AvailableOuting;
use App\Models\User;
use App\Rules\CanAssignRole;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Spatie\Permission\Models\Role;

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

        $roles = Role::all();


        return Inertia::render('Admin/Users/Show')->with([
            'user' => $user,
            'roles' => $roles
        ]);

    }

    public function update(Request $request, User $user)
    {

         $request->validate([
             'name' => ['required','max:255'],
             'roles' => ['required','array'],
             'roles.*.id' => ['required','exists:roles,id']
         ]);

        $user->name = $request->get('name');

        $user->syncRoles(collect($request->get('roles'))->pluck('id'));

        $user->save();

        return redirect()->route('admin.users');

    }

    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('admin.users');
    }



}
