<?php

namespace App\Livewire;

use App\Models\Agreement;
use Illuminate\View\View;
use Livewire\Component;
use Livewire\WithPagination;

class ViewAgreements extends Component
{
    use WithPagination;

    public $search = '';

    public function render() : View
    {
        $results = [];

        if ($this->search) {
            $results = Agreement::where('customer_forename', 'like', '%' . $this->search . '%')
                ->orWhere('customer_surname', 'like', '%' . $this->search . '%')
                ->orWhere('id', 'like', '%' . $this->search . '%')
                ->get();
        } else {
            $results = Agreement::all();
        }

        return view('livewire.view-agreements', [
            'agreements' => $results
        ]);
    }
}

