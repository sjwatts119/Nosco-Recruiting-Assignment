<?php

namespace App\Http\Controllers;

use App\Models\Agreement;

class AgreementController extends Controller
{
    public function index()
    {
        return view('agreements.index');
    }

    public function show($slug)
    {
        $agreement = Agreement::where('id', $slug)->firstOrFail();
        return view('agreements.show', ['agreement' => $agreement]);
    }

    public function create()
    {
        return view('agreements.create');
    }
}
