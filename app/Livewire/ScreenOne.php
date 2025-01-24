<?php

namespace App\Livewire;

use App\Models\Record;
use Livewire\Component;
use Livewire\WithPagination;

class ScreenOne extends Component
{
    use WithPagination;

    public $search = '';

    protected $queryString = ['search'];

    public function updatingSearch()
    {
        $this->resetPage(); // Reset to the first page when searching
    }

    public function render()
    {
        $data = Record::query()
            ->where(function ($query) {
                $query->where('title', 'like', '%' . $this->search . '%')
                    ->orWhere('status', 'like', '%' . $this->search . '%')
                    ->orWhere('notes', 'like', '%' . $this->search . '%')
                    ->orWhere('id', 'like', '%' . $this->search . '%');
            })
            ->paginate(10);

        return view('livewire.screen-one', ['data' => $data]);
    }
}
