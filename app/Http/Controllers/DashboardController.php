<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            // User is authenticated, return the dashboard view
            return view('dashboard');
        } else {
            // User is not authenticated, redirect to the login page
            return redirect()->route('login');
        }
    }
}
