<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Categories;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class dashboardController extends Controller
{
    public function index(Request $request)
    {
        $query = Event::query();

        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }

        if ($request->filled('search')) {
            $query->where('title', 'ILIKE', '%' . $request->search . '%');
        }

        $events = $query->latest()->get();
        $categories = Categories::all();

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
        $latestUsers = User::latest()->take(3)->get();
        // Get total users (excluding admins)
        $totalUsers = User::where('role', 'user')->count();

        // Get total registrations
        $totalRegistrations = DB::table('regis')->count();
        $statusCount = [
            'ongoing' => Event::where('status', 'ongoing')->count(),
            'coming_soon' => Event::where('status', 'coming_soon')->count(),
            'ended' => Event::where('status', 'ended')->count(),
            'cancelled' => Event::where('status', 'cancelled')->count(),
        ];
        // Get latest events with relationships
        $events = Event::with(['creator', 'category'])
            ->latest()
            ->take(5)
            ->get();

        return view('admin.dashboard', compact(
            'totalEvents',
            'totalUsers',
            'statusCount',
            'totalRegistrations',
            'latestUsers',
            'events'
        ));

        return view('admin.dashboard', compact('categories', 'events'));
    }
}
