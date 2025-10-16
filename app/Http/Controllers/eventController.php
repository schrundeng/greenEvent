<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Categories;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Illuminate\Support\Facades\Log;


class eventController extends Controller
{
    /**
     * Display a listing of events
     */
    public function index()
    {
        try {
            $events = Event::with(['category'])->latest()->get();
            return view('events', compact('events')); // Changed this line
        } catch (\Exception $e) {
            // Log the error
            Log::error('Event Index Error: ' . $e->getMessage());
            
            // In development, show the error
            if (config('app.debug')) {
                dd([
                    'message' => $e->getMessage(),
                    'file' => $e->getFile(),
                    'line' => $e->getLine(),
                    'trace' => $e->getTraceAsString()
                ]);
            }
            
            // In production, return back with error message
            return back()->with('error', 'Unable to load events. Please try again later.');
        }
    }

    /**
     * Show the form for creating a new event
     */
   public function create()
{
    $categories = Categories::all();
    return view('admin.event-create', compact('categories'));
}


    public function adminIndex()
    {
        try {
            // Get total events
            $totalEvents = Event::count();

            // Get total users (excluding admins)
            $totalUsers = User::where('role', 'user')->count();

            // Get total registrations
            $totalRegistrations = DB::table('event_registrations')->count();

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
        } catch (\Exception $e) {
            return response()->view('errors.500', [], 500);
        }
    }

    /**
     * Store a newly created event
     */
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'title' => 'required|max:255',
                'description' => 'nullable',
                'category_id' => 'required|exists:categories,id',
                'start_date' => 'required|date',
                'end_date' => 'nullable|date|after:start_date',
                'location' => 'required|max:255',
                'longitude' => 'required|numeric',
                'latitude' => 'required|numeric',
                'poster' => 'required|image|max:2048',
                'organizer' => 'required|max:255'
            ]);

            // Handle poster upload
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
            dd($e->getMessage());
        }

    }

    /**
     * Display the specified event
     */
    public function show($idOrSlug)
    {
        try {
            $event = Event::where('id', $idOrSlug)
                ->orWhere('slug', $idOrSlug)
                ->firstOrFail();

            $longitude = $event->longitude;
            $latitude = $event->latitude;

            return view('event-detail', compact('event'));
        } catch (\Exception $e) {
            return response()->view('errors.404', [], 404);
        }
    }

    /**
     * Show the form for editing the specified event
     */
    public function edit(Event $event)
    {
        try {
            $categories = Categories::all();
            return view('events.edit', compact('event', 'categories'));
        } catch (\Exception $e) {
            return response()->view('errors.500', [], 500);
        }
    }

    /**
     * Update the specified event
     */
    public function update(Request $request, Event $event)
    {
        try {
            $validated = $request->validate([
                'title' => 'required|max:255',
                'description' => 'nullable',
                'category_id' => 'required|exists:categories,id',
                'start_date' => 'required|date',
                'end_date' => 'nullable|date|after:start_date',
                'location' => 'required|max:255',
                'longitude' => 'required|numeric',
                'latitude' => 'required|numeric',
                'poster' => 'nullable|image|max:2048',
                'organizer' => 'required|max:255'
            ]);

            // Handle poster upload if new file is provided
            if ($request->hasFile('poster')) {
                // Delete old poster
                if ($event->poster) {
                    Storage::disk('public')->delete($event->poster);
                }
                $posterPath = $request->file('poster')->store('events', 'public');
                $validated['poster'] = $posterPath;
            }

            $validated['slug'] = Str::slug($validated['title']);
            $event->update($validated);

            return redirect()->route('events.index')
                ->with('success', 'Event updated successfully');
        } catch (\Exception $e) {
            return back()->with('error', 'Failed to update event')
                ->withInput();
        }
    }
    /**
     * Remove the specified event
     */
    public function destroy(Event $event)
    {
        try {
            // Delete the poster file
            if ($event->poster) {
                Storage::disk('public')->delete($event->poster);
            }

            $event->delete();
            return redirect()->route('events.index')
                ->with('success', 'Event deleted successfully');
        } catch (\Exception $e) {
            return back()->with('error', 'Failed to delete event');
        }
    }
}
