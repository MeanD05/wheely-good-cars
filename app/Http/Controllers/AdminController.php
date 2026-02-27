<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tag;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = auth()->user();
        $allowed = (bool) ($user->isadmin ?? $user->is_admin ?? false);
        if (! $user || ! $allowed) {
            abort(403);
        }

        $tags = Tag::query()
            ->withCount('cars')
            ->withCount([
                'cars as sold_cars_count' => fn ($query) => $query->whereNotNull('sold_at'),
                'cars as unsold_cars_count' => fn ($query) => $query->whereNull('sold_at'),
            ])
            ->orderBy('name')
            ->get();


        

        return view('admin', compact('tags'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
