<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class UserController extends Controller
{
    public function index()
    {

        $users = User::with('roles','apartment')->latest()->get();

        return Inertia::render('Admin/Users/Index')->with([
            'users' => $users
        ]);

    }

    public function internatnici()
    {


        $users = User::whereHas('roles', function ($q){
            $q->where('name', 'internatista');
        })->with('roles','apartment')
            ->latest()
            ->get();

        return Inertia::render('Admin/Users/Internatnici')->with([
            'users' => $users
        ]);
    }
}
