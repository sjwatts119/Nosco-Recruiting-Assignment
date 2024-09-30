<?php

namespace App\Http\Controllers;

use App\Models\Agreement;

class AgreementController extends Controller
{
    public function index()
    {
        return view('livewire.pages.agreements.index');
    }

    public function show($slug)
    {
        $agreement = Agreement::where('id', $slug)->firstOrFail();
        return view('livewire.pages.agreements.show', ['agreement' => $agreement]);
    }

    public function create()
    {
        return view('livewire.pages.agreements.create');
    }
}
