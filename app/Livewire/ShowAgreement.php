<?php

namespace App\Livewire;

use App\Models\Agreement;
use Livewire\Component;

class ShowAgreement extends Component
{
    public Agreement $agreement;

    public function voidAgreement() : void
    {
        $this->agreement->void();
    }

    public function unvoidAgreement() : void
    {
        $this->agreement->unvoid();
    }

    public function render()
    {
        return view('livewire.show-agreement');
    }
}
