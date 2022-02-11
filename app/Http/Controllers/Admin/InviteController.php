<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\InviteInternatnikMail;
use App\Mail\InviteUser;
use App\Models\AvailableOuting;
use App\Models\Invite;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use App\Rules\CanAssignRole;
use Carbon\Carbon;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Inertia\Inertia;
use Illuminate\Validation\Rules;
use Spatie\Permission\Models\Role;

class InviteController extends Controller
{
    public function create()
    {
        $myRoles = auth()->user()->roles()->pluck('name') ;
        $invited = [];
        $roles = [];


        if ($myRoles->contains('Super-Admin')){
            $roles = Role::all();
            $invited = Invite::with('roles')->latest()->get();

        }
        elseif ($myRoles->contains('vychovavatel')){
            $roles = Role::where('name','internatista')->get();
            $invited = Invite::whereHas('roles',function ($q){
                $q->where('name','internatista');
            })->with('roles')->latest()->get();
        }


        return Inertia::render('Admin/Users/Invite')->with([
            'invited' => $invited,
            'roles' => $roles
        ]);
    }

    public function invite(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users|unique:invites',
            'role' => ['required',new CanAssignRole()]
        ]);



        do {
            $token = \Illuminate\Support\Str::random(32);
        }
        while(Invite::where('token',$token)->first());

        $invite = Invite::create([
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'token' => $token,
            'expires_at' => Carbon::now()->addMonth()
        ]);

        $invite->assignRole($request->get('role')['id']);

        Mail::to($invite->email)->send(new InviteUser($invite));

        return redirect()->back();

    }

    public function processing($token)
    {

        $invite = Invite::where('token', $token)->whereDate('expires_at','>=',now())->firstOrfail();

        return Inertia::render('Auth/InternatniciCreate')->with([
            'invite' => $invite
        ]);

    }

    public function accept($token, Request $request)
    {
        $invite = Invite::where('token', $token)->whereDate('expires_at','>=',now())->firstOrfail();

        $request->validate([
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name' => $invite->name,
            'email' => $invite->email,
            'password' => Hash::make($request->password),
        ]);

        $user->assignRole($invite->roles()->get());

        $invite->delete();

        event(new Registered($user));

        Auth::login($user);

        AvailableOuting::create([
            'user_id' => $user->id,
            'until' => '21:30'
        ]);

        if (\auth()->user()->hasRole('internatista'))
            return redirect()->route('dashboard');
        else return redirect()->route('admin.dashboard');



    }

    public function destroy($id)
    {
        $invite = Invite::where('id',$id)->with('roles')->firstOrFail();


        if (\auth()->user()->hasRole('Super-Admin')){

            $invite->forceDelete();
        }
        elseif (\auth()->user()->hasRole('vychovavatel')){
            if ($invite->roles->pluck('name')->contains('internatista'))
            $invite->forceDelete();
        }

        return redirect()->back();
    }

}
