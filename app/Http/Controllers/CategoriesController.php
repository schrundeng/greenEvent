<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Categories;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class CategoriesController extends Controller
{
    // Semua user bisa melihat daftar kategori
    public function index()
    {
        $categories = Categories::latest()->get();
        $events = Event::with(['creator', 'category'])->latest()->get();
        return view('user.categories.index', compact('categories'));
    }

    // Hanya admin yang bisa membuka halaman tambah kategori
    public function create()
    {
        if (Auth::user()->role !== 'admin') {
            return redirect()->route('user.dashboard')->with('error', 'Akses ditolak.');
        }

        return view('admin.categories.create');
    }

    // Hanya admin yang bisa menyimpan kategori baru
    public function store(Request $request)
    {
        if (Auth::user()->role !== 'admin') {
            return redirect()->route('user.dashboard')->with('error', 'Akses ditolak.');
        }

        $validated = $request->validate([
            'name' => 'required|max:100|unique:categories',
        ]);

        $validated['slug'] = Str::slug($validated['name']);

        Categories::create($validated);

        return redirect()->route('categories.index')
            ->with('success', 'Category created successfully');
    }

    // Hanya admin yang bisa mengedit kategori
    public function edit(Categories $category)
    {
        if (Auth::user()->role !== 'admin') {
            return redirect()->route('user.dashboard')->with('error', 'Akses ditolak.');
        }

        return view('admin.categories.edit', compact('category'));
    }

    // Hanya admin yang bisa update kategori
    public function update(Request $request, Categories $category)
    {
        if (Auth::user()->role !== 'admin') {
            return redirect()->route('user.dashboard')->with('error', 'Akses ditolak.');
        }

        $validated = $request->validate([
            'name' => 'required|max:100|unique:categories,name,' . $category->id,
        ]);

        $validated['slug'] = Str::slug($validated['name']);

        $category->update($validated);

        return redirect()->route('categories.index')
            ->with('success', 'Category updated successfully');
    }

    // Hanya admin yang bisa menghapus kategori
    public function destroy(Categories $category)
    {
        if (Auth::user()->role !== 'admin') {
            return redirect()->route('user.dashboard')->with('error', 'Akses ditolak.');
        }

        $category->delete();

        return redirect()->route('categories.index')
            ->with('success', 'Category deleted successfully');
    }
}
