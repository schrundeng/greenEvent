<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Categories;
use Illuminate\Http\Request;

class dashboardController extends Controller
{
    public function index()
    {
        $categories = Categories::all();
        $events = Event::with([ 'category'])->latest()->get();
        
        return view('user.dashboard', compact('categories', 'events'));
    }

    public function adminIndex()
    {
        $categories = Categories::all();
        $events = Event::with([ 'category'])->latest()->get();
        
        return view('admin.dashboard', compact('categories', 'events'));
    }
}