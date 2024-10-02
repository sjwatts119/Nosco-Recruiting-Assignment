<?php

namespace App\Livewire;

use App\Models\Agreement;
use Illuminate\View\View;
use Livewire\Component;

class ShowAgreement extends Component
{
    public Agreement $agreement;

    /**
     * Set the agreement to void.
     *
     * @return void
     */
    public function voidAgreement(): void
    {
        $this->agreement->void();
    }

    /**
     * Unset the agreement from being void.
     *
     * @return void
     */
    public function unvoidAgreement(): void
    {
        $this->agreement->unvoid();
    }

    public function render(): View
    {
        return view('livewire.show-agreement');
    }
}
