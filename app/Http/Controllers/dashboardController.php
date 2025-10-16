<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Categories;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class dashboardController extends Controller
{
    public function index()
    {
        $categories = Categories::all();
        $events = Event::with(['category'])->latest()->get();

        return view('user.dashboard', compact('categories', 'events'));
    }

    public function adminIndex()
    {
        $categories = Categories::all();
        $events = Event::with(['category'])->latest()->get();
        // $totalEvents = Event::count();
        // $totalUsers = \App\Models\User::where('role', 'user')->count();
        // $totalRegistrations = DB::table('regis')->count();

        $totalEvents = Event::count();

        // Get total users (excluding admins)
        $totalUsers = User::where('role', 'user')->count();

        // Get total registrations
        $totalRegistrations = DB::table('regis')->count();

        // Get latest events with relationships
        $events = Event::with(['creator', 'category'])
            ->latest()
            ->take(5)
            ->get();

        return view('admin.dashboard', compact(
            'totalEvents',
            'totalUsers',
            'totalRegistrations',
            'events'
        ));

        return view('admin.dashboard', compact('categories', 'events'));
    }
}
