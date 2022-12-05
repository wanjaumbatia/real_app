<?php

namespace App\Http\Controllers;

use App\Models\Plan;
use Illuminate\Http\Request;

class PlanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $plans = Plan::all();
        return view('admin.plans.index')->with(['plans' => $plans]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.plans.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $plan = new Plan();
        $plan->name = $request->name;
        $plan->charge = $request->charge;
        $plan->returns = $request->returns;
        $plan->commission = $request->commission;
        $plan->penalty = $request->penalty;
        $plan->duration = $request->duration;
        if ($request->default == '1') {
            $plan->default = true;
        } else {
            $plan->default = false;
        }
        if ($request->multiple == '1') {
            $plan->allow_multiple = true;
        } else {
            $plan->allow_multiple = false;
        }

        if ($request->type == 'regular') {
            $plan->regular = true;
        } else if ($request->type == 'savings') {
            $plan->savings = true;
        } else if ($request->type == 'invest') {
            $plan->invest = true;
        }

        $plan->save();

        return redirect()->to('/plans');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $plan = Plan::where('id', $id)->first();
        return view('admin.plans.show')->with(['plan' => $plan]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $plan = Plan::where('id', $id)->first();
        return view('admin.plans.edit')->with(['plan' => $plan]);
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
        $plan = Plan::where('id', $id)->first();
        $plan->name = $request->name;
        $plan->charge = $request->charge;
        $plan->returns = $request->returns;
        $plan->commission = $request->commission;
        $plan->penalty = $request->penalty;
        $plan->duration = $request->duration;
        if ($request->default == '1') {
            $plan->default = true;
        } else {
            $plan->default = false;
        }
        if ($request->active == '1') {
            $plan->active = true;
        } else {
            $plan->active = false;
        }
        if ($request->multiple == '1') {
            $plan->allow_multiple = true;
        } else {
            $plan->allow_multiple = false;
        }

        if ($request->type == 'regular') {
            $plan->regular = true;
        } else if ($request->type == 'savings') {
            $plan->savings = true;
        } else if ($request->type == 'invest') {
            $plan->invest = true;
        }

        $plan->update();

        return redirect()->to('/plans');
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
