<?php

namespace App\Http\Controllers;

use App\Models\Finance;
use Illuminate\Http\Request;
use Inertia\Inertia;

class FinanceController extends Controller
{
    public function index()
    {
        return Inertia::render('finance/index');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'account' => 'required|string|max:255',
            'amount' => 'required|numeric|min:0',
        ]);

        Finance::create($data);

        return redirect()->route('finance.index')->with('message', 'Finance added successfully');

        // 37:59
    }
}
