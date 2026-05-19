<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\User;
use App\Models\Tag;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;
use Illuminate\Pagination\LengthAwarePaginator;

class DashboardController extends Controller
{
    public function index()
    {
        $this->authorizeAdmin();

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

            $sameDayHighPriceSoldCount = $user->cars
                ->filter(function ($car) {
                    if (! $car->created_at || ! $car->sold_at) {
                        return false;
                    }

                    return (float) $car->price > 10000
                        && $car->created_at->isSameDay($car->sold_at);
                })
                ->count();

            if ($sameDayHighPriceSoldCount > 3) {
                $reasons[] = 'many_high_price_sold_same_day';
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

        $page = request()->integer('page', 1);
        $perPage = 6;
        $suspiciousUsers = new LengthAwarePaginator(
            $suspiciousUsers->forPage($page, $perPage)->values(),
            $suspiciousUsers->count(),
            $perPage,
            $page,
            [
                'path' => request()->url(),
                'query' => request()->query(),
            ]
        );

        return view('admin', compact('tags', 'suspiciousUsers'));

    }

    public function metrics()
    {
        $this->authorizeAdmin();

        $now = Carbon::now();
        $start = $now->copy()->subDays(6)->startOfDay();
        $end = $now->copy()->endOfDay();

        $totalCars = Car::count();
        $soldCars = Car::whereNotNull('sold_at')->count();
        $todayCars = Car::whereDate('created_at', $now->toDateString())->count();
        $providersCount = Car::distinct('user_id')->count('user_id');

        $viewsKey = 'car_views_' . $now->toDateString();
        $viewsToday = (int) Cache::get($viewsKey, 0);

        $avgCarsPerProvider = $providersCount > 0
            ? round($totalCars / $providersCount, 2)
            : 0;

        $soldRatio = $totalCars > 0
            ? round(($soldCars / $totalCars) * 100, 1)
            : 0;

        $offeredByDay = Car::query()
            ->selectRaw('DATE(created_at) as day, COUNT(*) as total')
            ->whereBetween('created_at', [$start, $end])
            ->groupBy('day')
            ->orderBy('day')
            ->pluck('total', 'day');

        $soldByDay = Car::query()
            ->selectRaw('DATE(sold_at) as day, COUNT(*) as total')
            ->whereNotNull('sold_at')
            ->whereBetween('sold_at', [$start, $end])
            ->groupBy('day')
            ->orderBy('day')
            ->pluck('total', 'day');

        $labels = [];
        $offeredSeries = [];
        $soldSeries = [];

        for ($i = 6; $i >= 0; $i--) {
            $day = $now->copy()->subDays($i)->toDateString();
            $labels[] = Carbon::parse($day)->format('D d/m');
            $offeredSeries[] = (int) ($offeredByDay[$day] ?? 0);
            $soldSeries[] = (int) ($soldByDay[$day] ?? 0);
        }

        return response()->json([
            'totals' => [
                'cars_total' => $totalCars,
                'cars_sold' => $soldCars,
                'cars_today' => $todayCars,
                'providers' => $providersCount,
                'views_today' => $viewsToday,
                'avg_cars_per_provider' => $avgCarsPerProvider,
                'sold_ratio' => $soldRatio,
            ],
            'charts' => [
                'labels' => $labels,
                'offered' => $offeredSeries,
                'sold' => $soldSeries,
                'sold_vs_unsold' => [$soldCars, max($totalCars - $soldCars, 0)],
            ],
            'updated_at' => $now->toDateTimeString(),
        ]);
    }

    private function authorizeAdmin(): void
    {
        $user = auth()->user();
        $allowed = (bool) ($user->isadmin ?? $user->is_admin ?? false);

        if (! $user || ! $allowed) {
            abort(403);
        }
    }

}
