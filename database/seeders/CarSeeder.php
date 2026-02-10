<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Car;
use App\Models\Tag;
use App\Models\User;


class CarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::all();
        $tags = Tag::all();

        Car::factory()
            ->count(250)
            ->make()
            ->each(function ($car) use ($users, $tags) {
                $car->user_id = $users->random()->id;
                $car->save();

               
                $car->tags()->attach(
                    $tags->random(rand(1,3))->pluck('id')->toArray()
                );
            });
    }
}
