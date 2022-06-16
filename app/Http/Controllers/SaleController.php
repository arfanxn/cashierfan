<?php

namespace App\Http\Controllers;

use App\Actions\MakeSaleAction;
use App\Http\Requests\StoreSaleRequest;
use App\Models\Sale;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\URL;
use Inertia\Inertia;

class SaleController extends Controller
{
    public function __construct()
    {
        $this->middleware(
            'role_has_permission:sales.index|sales.create|sales.edit|sales.delete',
            ['only' => ['index', "profitIndex"]]
        );
        $this->middleware('role_has_permission:sales.create', ['only' => ['create', 'store']]);
        $this->middleware('role_has_permission:sales.edit', ['only' => ['edit', 'update']]);
        $this->middleware('role_has_permission:sales.delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $request->validate([
            'keyword' => 'nullable|string',
            "start_date" => "nullable|date",
            "end_date" => "nullable|date|after_or_equal:start_date",
        ]);

        $keyword = strtolower($request->get('keyword'));

        $sales = Sale::with([
            // with relation select only specific fields/columns
            "cashier" => fn ($q) => $q->select(["id", 'name']),
            "customer" => fn ($q) => $q->select(["id", 'name']),
        ])->when($keyword, function ($query) use ($keyword) {
            return $query->where(function ($query) use ($keyword) {
                $query->where(
                    "invoice",
                    "ILIKE",
                    "$keyword%"
                )->orWhereHas(
                    "cashier",
                    function ($query) use ($keyword) {
                        return $query->where("name", "ILIKE", "%$keyword%");
                    }
                )->orWhereHas(
                    "customer",
                    function ($query) use ($keyword) {
                        return $query->where("name", "ILIKE", "%$keyword%");
                    }
                );
            });
        })->when($request->start_date, fn ($q) => $q->whereDate("created_at",  ">=", $request->start_date))
            ->when($request->end_date, fn ($q) => $q->whereDate("created_at",  "<=", $request->end_date))
            ->orderBy("created_at", "DESC")
            ->simplePaginate(20);

        return Inertia::render('Sale/Index', compact("sales"));
    }

    public function profitIndex(Request $request)
    {
        $request->validate([
            "start_date" => "nullable|date",
            "end_date" => "nullable|date|after_or_equal:start_date",
        ]);

        $perPage = 5;
        $currentPage = $request->query("page", 1);
        $offset = ($currentPage * $perPage) - $perPage;

        $sales = Sale::with(["products" => fn ($q) => $q->select("*")])
            ->when($request->start_date, fn ($q) => $q->where("created_at", ">=", $request->start_date))
            ->when($request->end_date, fn ($q) => $q->where("created_at", "<=", $request->end_date))
            ->offset($offset)->limit($perPage)
            ->orderBy("created_at", "DESC")->get(['id']);
        $products  = Arr::flatten(collect($sales)->map(fn ($sale) => $sale->products));

        return Inertia::render('Sale/ProfitIndex', compact("products"));
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
        $sale = MakeSaleAction::exec(
            $request->cashier,
            $request->customer ?? null,
            $request->customer_pay_money,
            $request->discount ?: 0.00,
            $request->products,
        );

        $signedURL = URL::temporarySignedRoute("sales.invoice", now()->addDays(2), ['sale' => $sale["invoice"]]);

        if ($request->expectsJson() || $request->wantsJson())
            return response()->json([
                "message" => "Sale created successfully",
                'redirect' => $signedURL
            ]);

        return redirect($signedURL);
    }

    public function invoice(Request $request, Sale $sale)
    {
        if (!$request->hasValidSignature()) abort(403);

        $sale = $sale->load([
            "cashier", "customer",
            "products",
        ]);

        return Inertia::render("Sale/Invoice", compact("sale"));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function show(Sale $sale)
    {
        $sale = $sale->load(["cashier.details", "customer", 'products' => fn ($q) => $q->select("*")]);
        // dd($sale->toArray());
        return Inertia::render("Sale/Show", compact('sale'));
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
