<?php

namespace App\Http\Controllers;

use App\Models\Regis;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RegisController extends Controller
{
    public function index()
    {
        try {
            $registrations = Regis::with(['user', 'event'])->latest('registered_at')->get();
            $events = Event::where('status', '!=', 'ended')->get();
            return view('admin.registrations.index', compact('registrations', 'events'));
        } catch (\Exception $e) {
            return back()->with('error', 'Unable to load registrations.');
        }
    }

    public function userHistory()
    {
        try {
            $event = Event::all();
            $registrations = Regis::with(['event'])
                ->where('user_id', Auth::id())
                ->latest('registered_at')
                ->get();

            return view('user.event-history', compact('registrations'));
        } catch (\Exception $e) {
            return back()->with('error', 'Unable to load registration history.');
        }
    }

    public function create(Event $event)
    {
        try {
            // $event = Event::where('id', $idOrSlug)
            //     ->orWhere('slug', $idOrSlug)
            //     ->where('status', '!=', 'ended')
            //     ->firstOrFail();
            if ($event->status === 'ended') {
                return redirect()->route('events')
                    ->with('error', 'This event has already ended.');
            }

            // Check if user is already registered
            $isRegistered = Regis::where('user_id', Auth::id())
                ->where('event_id', $event->id)
                ->exists();

            return view('user.event-register', compact('event', 'isRegistered'));
        } catch (\Exception $e) {
            return redirect()->route('events', $event)
                ->with('error', 'Unable to load registration form.');
        }
    }

    public function store(Request $request, $idOrSlug)
    {
        try {
            $validated = $request->validate([
                'event_id' => 'required|exists:events,id',
                'name' => 'required|string|max:100',
                'email' => 'required|email|max:100',
                'phone' => 'required|string|max:20',
            ]);

            $validated['user_id'] = Auth::id();
            $validated['status'] = 'pending';

            Regis::create($validated);

            return redirect()->route('user.dashboard')
                ->with('success', 'Registration submitted successfully!');
        } catch (\Exception $e) {
            return back()->withInput()
                ->with('error', 'Registration failed. Please try again.');
        }
    }

    public function show(Regis $registration)
    {
        try {
            $registration->load(['user', 'event']);
            return view('admin.registrations.show', compact('registration'));
        } catch (\Exception $e) {
            return back()->with('error', 'Unable to load registration details.');
        }
    }

    public function edit(Regis $registration)
    {
        try {
            $events = Event::where('status', '!=', 'ended')->get();
            return view('admin.registrations.edit', compact('registration', 'events'));
        } catch (\Exception $e) {
            return back()->with('error', 'Unable to load edit form.');
        }
    }

    public function update(Request $request, Regis $registration)
    {
        try {
            $validated = $request->validate([
                'event_id' => 'required|exists:events,id',
                'name' => 'required|string|max:100',
                'email' => 'required|email|max:100',
                'phone' => 'required|string|max:20',
                'status' => 'required|in:pending,approved,rejected'
            ]);

            $registration->update($validated);

            return redirect()->route('registrations.index')
                ->with('success', 'Registration updated successfully.');
        } catch (\Exception $e) {
            return back()->with('error', 'Update failed.')
                ->withInput();
        }
    }

    public function destroy(Regis $registration)
    {
        try {
            $registration->delete();
            return redirect()->route('registrations.index')
                ->with('success', 'Registration deleted successfully.');
        } catch (\Exception $e) {
            return back()->with('error', 'Delete failed.');
        }
    }
}
