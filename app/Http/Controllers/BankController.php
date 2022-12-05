<?php

namespace App\Http\Controllers;

use App\Models\BankAccount;
use App\Models\BankAccountLedger;
use App\Models\Branch;
use Illuminate\Http\Request;

class BankController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $banks = BankAccount::all();

        foreach ($banks as $item) {
            $balance = BankAccountLedger::where('bank_account_id', $item->id)->sum('amount');
            $item->balance = $balance;
        }
        return view('finance.banks.index')->with(['banks' => $banks]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $branches = Branch::where('active', true)->get();
        return view('finance.banks.create')->with(['branches' => $branches]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $bank = BankAccount::create([
            'name' => $request->name,
            'account_number' => $request->account,
            'bank_branch' => $request->bank_branch,
            'branch' => $request->branch
        ]);

        return redirect()->to('/finance/banks');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
