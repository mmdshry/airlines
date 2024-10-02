<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Airplane;
use Livewire\WithPagination;

class AirplanesList extends Component
{
    use WithPagination;

    public $search = '';
    public $types = ['commercial', 'private_jet', 'cargo'];

    protected $queryString = ['search'];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $airplanes = Airplane::query()
            ->when($this->search, function ($query) {
                $query->where('model', 'like', '%' . $this->search . '%')
                    ->orWhere('type', 'like', '%' . $this->search . '%');
            })
            ->get()
            ->groupBy('type');

        return view('airplanes', [
            'airplanesByType' => $airplanes,
        ]);
    }
}
