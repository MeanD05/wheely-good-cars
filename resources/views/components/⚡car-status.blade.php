<?php

use Livewire\Component;
use App\Models\Car;

new class extends Component
{
    public Car $car;
    public bool $sold;
    public int $price;

    public function mount(Car $car)
    {
        $this->car = $car;
        $this->sold = (bool) $car->sold_at;
        $this->price = $car->price;
    }

    public function toggleSold()
    {
        if (auth()->id() !== $this->car->user_id) {
            abort(403);
        }

        $this->sold = ! $this->sold;

        $this->car->update([
            'sold_at' => $this->sold ? now() : null,
        ]);
    }

    public function updatePrice()
    {
        if (auth()->id() !== $this->car->user_id) {
            abort(403);
        }

        $this->validate([
            'price' => 'required|numeric|min:0',
        ]);

        $this->car->update([
            'price' => $this->price,
        ]);
    }
};
?>

<div class="flex items-center gap-2">
    
    <input
        type="number"
        wire:model.lazy="price"
        wire:change="updatePrice"
        class="w-20 text-xs border border-gray-300 rounded-md px-2 py-0.5 text-gray-800"
    >

   
    <button
        wire:click="toggleSold"
        class="inline-flex items-center justify-center text-[11px] font-semibold px-2.5 py-0.5 rounded-full leading-tight whitespace-nowrap text-center
            {{ $sold ? 'bg-red-100 text-red-700' : 'bg-green-100 text-green-700' }}"
    >
        {{ $sold ? 'Verkocht' : 'Te koop' }}
    </button>
</div>
