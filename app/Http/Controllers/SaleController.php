<?php

namespace App\Http\Controllers;

use App\Actions\MakeSaleAction;
use App\Http\Requests\StoreSaleRequest;
use App\Models\Sale;
use App\Models\User;
use App\Models\Customer;
use Illuminate\Http\Request;
use Inertia\Inertia;

class SaleController extends Controller
{
    public function __construct()
    {
        $this->middleware('role_has_permission:sales.index|sales.create|sales.edit|sales.delete', ['only' => ['index']]);
        $this->middleware('role_has_permission:sales.create', ['only' => ['create', 'store']]);
        $this->middleware('role_has_permission:sales.edit', ['only' => ['edit', 'update']]);
        $this->middleware('role_has_permission:sales.delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Inertia::render('Sale/Index');
    }

    public function profitIndex()
    {
        return Inertia::render('Sale/ProfitIndex');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render('Sale/Create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSaleRequest $request)
    {
        $make = MakeSaleAction::exec(
            $request->cashier,
            $request->customer ?? null,
            $request->customer_pay_money,
            $request->discount ?: 0.00,
            $request->products,
        );

        return dd($make);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function show(Sale $sale)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function edit(Sale $sale)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Sale $sale)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function destroy(Sale $sale)
    {
        //
    }
}
