<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\Cashflow;
use Illuminate\Http\Request;

class OperationsController extends Controller
{
    public function cashflows()
    {
        $data = Cashflow::orderby('id', 'desc')->get();
        return view('operations.cashflow.index')->with(['data' => $data]);
    }


    public function create_cashflow(Request $request)
    {
        $branches = Branch::where('active', true)->get();
        return view('operations.cashflow.create')->with(['branches' => $branches]);
    }

    public function store_cashflow(Request $request)
    {
        if ($request->direction == '1') {
            $cf = CashFlow::create([
                'branch' => $request->branch,
                'to' => 'HQ',
                'from' => $request->branch,
                'amount' => $request->amount,
                'description' => $request->description,
                'status' => 'pending',
                'created_by' => auth()->user()->name,
                'created_at' => $request->date
            ]);
        } else if ($request->direction == '2') {
            $cf = CashFlow::create([
                'branch' => $request->branch,
                'from' => 'HQ',
                'to' => $request->branch,
                'amount' => $request->amount,
                'description' => $request->description,
                'status' => 'pending',
                'created_by' => auth()->user()->name,
                'created_at' => $request->date
            ]);
        } else {
        }

        return redirect()->to('/ops/cashflow');
    }
}
