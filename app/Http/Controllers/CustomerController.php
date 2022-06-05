<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $keyword = strtolower($request->get('keyword'));

        $customers = Customer::query();

        if ($keyword) {
            $customers = $customers->where(function ($query) use ($keyword) {
                return $query->where(
                    "name",
                    "ILIKE",
                    "$keyword%"
                )->orWhere(
                    "phone_number",
                    "ILIKE",
                    "$keyword%"
                )->orWhere(
                    "address",
                    "ILIKE",
                    "$keyword%"
                );;
            });
        }

        $customers = $customers->orderBy("updated_at", "DESC")->simplePaginate(10);

        return Inertia::render('Customer/Index', compact("customers"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render('Customer/Create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            "name" => "required|alpha|min:2|max:50|string",
            "phone_number" => "nullable|max:20|string",
            "address" => "nullable|max:255|string",
        ]);

        Customer::query()->create($request->validated());

        return redirect()->route("customers.index")->with(['message' => "Customer created successfully"]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function show(Customer $customer)
    {
        // not implemented
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function edit(Customer $customer)
    {
        return Inertia::render('Customer/Edit', compact("customer"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Customer $customer)
    {
        $request->validate([
            "name" => "required|alpha|min:2|max:50|string",
            "phone_number" => "nullable|max:20|string",
            "address" => "nullable|max:255|string",
        ]);

        $customer->update($request->validated());

        return redirect()->route("customers.index")
            ->with(["message" => 'Customer "' . $customer->name . '" updated successfully']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Customer $customer)
    {
        $customer->delete();
        return redirect()->route("customers.index")
            ->with(["message" => 'Customer "' . $customer->name . '" deleted successfully']);
    }
}
