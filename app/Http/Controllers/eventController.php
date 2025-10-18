<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Event;
use App\Models\Categories;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\StreamedResponse;

class eventController extends Controller
{
    /**
     * Display a listing of events (user boleh lihat)
     */
    public function index()
    {
        try {
            $events = Event::with(['category'])->latest()->get();
            return view('events', compact('events'));
        } catch (\Exception $e) {
            Log::error('Event Index Error: ' . $e->getMessage());
            return back()->with('error', 'Unable to load events. Please try again later.');
        }
    }

    /**
     * Show the form for creating a new event (admin only)
     */
    public function create()
    {
        if (Auth::user()->role !== 'admin') {
            abort(403, 'Unauthorized');
        }

        $categories = Categories::all();
        return view('admin.event-create', compact('categories'));
    }

    /**
     * Admin index (admin only)
     */
    public function adminIndex(Request $request)
    {
        if (Auth::user()->role !== 'admin') {
            abort(403, 'Unauthorized');
        }

        try {
            $categories = Categories::all();

            $totalEvents = Event::count();
            $totalUsers = User::where('role', 'user')->count();
            $totalRegistrations = DB::table('regis')->count();

            $query = Event::with(['creator', 'category']);

            if ($request->filled('search')) {
                $query->where(function ($q) use ($request) {
                    $q->where('title', 'ILIKE', '%' . $request->search . '%')
                        ->orWhere('location', 'ILIKE', '%' . $request->search . '%');
                });
            }

            if ($request->filled('category')) {
                $query->where('category_id', $request->category);
            }

            if ($request->filled('status')) {
                $query->where('status', $request->status);
            }

            $events = $query->latest()->paginate(10);

            return view('admin.event-management', compact(
                'totalEvents',
                'totalUsers',
                'totalRegistrations',
                'events',
                'categories'
            ));
        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    /**
     * Store a newly created event (admin only)
     */
    public function store(Request $request)
    {
        if (Auth::user()->role !== 'admin') {
            abort(403, 'Unauthorized');
        }

        try {
            $validated = $request->validate([
                'title' => 'required|max:255',
                'description' => 'nullable',
                'status' => 'required|string',
                'category_id' => 'required|exists:categories,id',
                'start_date' => 'required|date',
                'end_date' => 'nullable|date|after:start_date',
                'location' => 'required|max:255',
                'longitude' => 'required|numeric',
                'latitude' => 'required|numeric',
                'poster' => 'required|image|max:2048',
                'organizer' => 'required|max:255'
            ]);

            if ($request->hasFile('poster')) {
                $posterPath = $request->file('poster')->store('poster', 'public');
                $validated['poster'] = $posterPath;
            }

            $validated['created_by'] = Auth::id();
            $validated['slug'] = Str::slug($validated['title']);

            Event::create($validated);

            return redirect()->route('events.index')
                ->with('success', 'Event created successfully');
        } catch (\Exception $e) {
            return back()->with('error', 'Failed to create event');
        }
    }

    /**
     * Display the specified event (user boleh lihat)
     */
    public function show(Event $event)
    {
        try {
            $longitude = $event->longitude;
            $latitude = $event->latitude;

            return view('event-detail', compact('event', 'longitude', 'latitude'));
        } catch (\Exception $e) {
            return response()->view('errors.404', [], 404);
        }
    }

    /**
     * Show the form for editing the specified event (admin only)
     */
    public function edit(Event $event)
    {
        if (Auth::user()->role !== 'admin') {
            abort(403, 'Unauthorized');
        }

        try {
            $categories = Categories::all();
            $id = $event->id;
            return view('admin.event-edit', compact('event', 'categories', 'id'));
        } catch (\Exception $e) {
            Log::error('Event Edit Error: ' . $e->getMessage());
            return redirect()->route('admin.event-management')->with('error', 'Unable to edit event');
        }
    }

    /**
     * Update the specified event (admin only)
     */
    public function update(Request $request, Event $event)
    {
        if (Auth::user()->role !== 'admin') {
            abort(403, 'Unauthorized');
        }

        try {
            $validated = $request->validate([
                'title' => 'required|max:255',
                'organizer' => 'required|max:255',
                'description' => 'nullable',
                'status' => 'in:draft,coming_soon,ongoing,ended,cancelled',
                'category_id' => 'required|exists:categories,id',
                'start_date' => 'required|date',
                'end_date' => 'nullable|date|after:start_date',
                'location' => 'required|max:255',
                'longitude' => 'required|numeric',
                'latitude' => 'required|numeric',
                'poster' => 'nullable|image|max:2048',
            ]);

            if ($request->hasFile('poster')) {
                if ($event->poster) {
                    Storage::disk('public')->delete($event->poster);
                }
                $posterPath = $request->file('poster')->store('events', 'public');
                $validated['poster'] = $posterPath;
            }

            $validated['slug'] = Str::slug($validated['title']);

            $event->update($validated);

            return redirect()->route('admin.event-management')
                ->with('success', 'Event updated successfully');
        } catch (\Exception $e) {
            return back()->with('error', 'Failed to update event')->withInput();
        }
    }

    /**
     * Remove the specified event (admin only)
     */
    public function destroy(Event $event)
    {
        if (Auth::user()->role !== 'admin') {
            abort(403, 'Unauthorized');
        }

        try {
            if ($event->poster) {
                Storage::disk('public')->delete($event->poster);
            }

            $event->delete();
            return redirect()->route('admin.event-management')
                ->with('success', 'Event berhasil dihapus!');
        } catch (\Exception $e) {
            return back()->with('error', 'Event gagal dihapus!');
        }
    }

    /**
     * Export CSV (admin only)
     */
    public function export()
    {
        if (Auth::user()->role !== 'admin') {
            abort(403, 'Unauthorized');
        }

        $fileName = 'events_' . now()->format('Ymd_His') . '.csv';
        $events = Event::with('category')->get(['title', 'location', 'start_date', 'status', 'category_id']);

        $headers = [
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        ];

        $columns = ['Judul', 'Kategori', 'Tanggal', 'Lokasi', 'Status'];

        $callback = function () use ($events, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach ($events as $event) {
                fputcsv($file, [
                    $event->title,
                    $event->category->name ?? '-',
                    $event->start_date ? $event->start_date->format('d/m/Y') : '-',
                    $event->location,
                    ucfirst($event->status),
                ]);
            }

            fclose($file);
        };

        return new StreamedResponse($callback, 200, $headers);
    }
}
