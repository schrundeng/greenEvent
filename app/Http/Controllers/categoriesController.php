<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Categories;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoriesController extends Controller
{
    public function index()
    {
        $categories = Categories::latest()->get();
        $events = Event::with(['creator', 'category'])->latest()->get();
        return view('user.categories.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.categories.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|max:100|unique:categories',
        ]);

        $validated['slug'] = Str::slug($validated['name']);

        Categories::create($validated);

        return redirect()->route('categories.index')
            ->with('success', 'Category created successfully');
    }

    public function edit(Categories $category)
    {
        return view('admin.categories.edit', compact('category'));
    }

    public function update(Request $request, Categories $category)
    {
        $validated = $request->validate([
            'name' => 'required|max:100|unique:categories,name,' . $category->id,
        ]);

        $validated['slug'] = Str::slug($validated['name']);

        $category->update($validated);

        return redirect()->route('categories.index')
            ->with('success', 'Category updated successfully');
    }

    public function destroy(Categories $category)
    {
        $category->delete();
        return redirect()->route('categories.index')
            ->with('success', 'Category deleted successfully');
    }
}