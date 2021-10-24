<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class UserController extends Controller
{
    public function index()
    {
        //vychovavatel -> internatisti super-Admin ->vychovavatelia && internatisti

        $users = User::with('roles','apartment')->latest()->get();


        return Inertia::render('Admin/Users/Index')->with([
            'users' => $users
        ]);

    }
}
