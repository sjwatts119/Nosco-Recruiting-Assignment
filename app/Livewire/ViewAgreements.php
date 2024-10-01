<?php

namespace App\Livewire;

use App\Models\Agreement;
use Illuminate\View\View;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class ViewAgreements extends Component
{
    use WithPagination, WithoutUrlPagination;

    public $search = '';

    // Reset the page when the search query is updated.
    public function updatingSearch() : void
    {
        $this->resetPage();
    }

    public function render() : View
    {
        $results = [];

        if ($this->search) {
            $results = Agreement::where('customer_forename', 'like', '%' . $this->search . '%')
                ->orWhere('customer_surname', 'like', '%' . $this->search . '%')
                ->orWhere('id', 'like', '%' . $this->search . '%')
                ->orderBy('created_at', 'desc')
                ->paginate(10);
        } else {
            $results = Agreement::orderBy('created_at', 'desc')->paginate(10);
        }

        return view('livewire.view-agreements', [
            'agreements' => $results
        ]);
    }
}

