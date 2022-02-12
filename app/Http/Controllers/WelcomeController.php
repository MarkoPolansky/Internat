<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Inertia\Inertia;

class WelcomeController extends Controller
{
    public function welcome()
    {
        $dashboardRoute = '';
        if (auth()->check())
        auth()->user()->hasRole('internatista') ? $dashboardRoute =  'dashboard' : $dashboardRoute ='admin.dashboard';


            return Inertia::render('Welcome', [
                'dashboardRoute' => $dashboardRoute
            ]);

    }
}
