<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Car;
use App\Models\User;
use App\Models\Tag;
use Carbon\Carbon;

class DashboardController extends Controller
{
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

        return view('admin', compact('tags', 'suspiciousUsers'));

    }

}
