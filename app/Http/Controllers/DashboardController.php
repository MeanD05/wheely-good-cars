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
             
        $oneYearAgo = Carbon::now()->subYear();

        $users = User::with(['cars' => function ($q) {
            $q->orderBy('created_at', 'desc');
        }])->get();

        $suspiciousUsers = collect();

        foreach ($users as $user) {
            $reasons = [];

            if (empty($user->phone_number)) {
                $reasons[] = 'no_phone_number';
            }

            if ($user->cars->contains(function ($car) {
                return (float) $car->price < 1000;
            })) {
                $reasons[] = 'car_under_1000';
            }

            if ($user->cars->isNotEmpty() && $user->cars->pluck('tags')->flatten()->isEmpty()) {
                $reasons[] = 'no_tags_added';
            }

            $latest = $user->cars->first();
            if ($latest && isset($latest->created_at) && $latest->created_at->lt($oneYearAgo)) {
                $reasons[] = 'no_car_in_year';
            }

            if ($user->cars->contains(function ($car) {
                return (float) $car->price > 10000;
            })) {
                $reasons[] = 'car_over_10000';
            }

            if ($user->cars->contains(function ($car) {
                return $car->production_year
                    && $car->mileage !== null
                    && (Carbon::now()->year - (int) $car->production_year) >= 10
                    && (int) $car->mileage <= 50000;
            })) {
                $reasons[] = 'old_car_low_mileage_possible_tampering';
            }

            if (! empty($reasons)) {
                $suspiciousUsers->push($user);
            }
        }

        return view('admin', compact('tags', 'suspiciousUsers'));

    }

}
