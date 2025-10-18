<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Categories;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class dashboardController extends Controller
{
    // Fungsi untuk redirect otomatis sesuai role
    public function redirectByRole()
    {
        if (Auth::check()) {
            if (Auth::user()->role === 'admin') {
                return redirect()->route('admin.dashboard');
            } else {
                return redirect()->route('user.dashboard');
            }
        }

        return redirect()->route('login');
    }

    // Dashboard untuk user biasa
    public function index(Request $request)
    {
        // Cegah admin mengakses halaman user
        if (Auth::user()->role !== 'user') {
            return redirect()->route('admin.dashboard')
                ->with('error', 'Akses ditolak. Halaman ini khusus untuk user.');
        }

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

    // Dashboard untuk admin
    public function adminIndex()
    {
        // Cegah user biasa mengakses halaman admin
        if (Auth::user()->role !== 'admin') {
            return redirect()->route('user.dashboard')
                ->with('error', 'Akses ditolak. Halaman ini khusus untuk admin.');
        }

        $categories = Categories::all();
        $events = Event::with(['category'])->latest()->get();

        $totalEvents = Event::count();
        $latestUsers = User::latest()->take(3)->get();
        $totalUsers = User::where('role', 'user')->count();
        $totalRegistrations = DB::table('regis')->count();

        $statusCount = [
            'ongoing' => Event::where('status', 'ongoing')->count(),
            'coming_soon' => Event::where('status', 'coming_soon')->count(),
            'ended' => Event::where('status', 'ended')->count(),
            'cancelled' => Event::where('status', 'cancelled')->count(),
        ];

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
            'events',
            'categories'
        ));
    }
}
