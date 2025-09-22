<?php

namespace App\Http\Controllers;

use App\Models\AdminFee;
use App\Models\ProductTransaction;
use App\Models\TransactionDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class ProductTransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        // if ($user->hasRole('buyer')) {
        //     $product_transactions = $user->transactions()->orderBy('id', 'DESC')->get();
        // } else {
        //     $product_transactions = ProductTransaction::orderBy('id', 'DESC')->get();
        // }

        $product_transactions = $user->transactions()->orderBy('id', 'DESC')->get();
        return view('admin.product_transactions.index', compact('product_transactions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user = Auth::user();
        $adminFee = AdminFee::where('is_active', '1')->latest()->first();
        $validated = $request->validate([
            'type' => 'required',
            'address' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'postal_code' => 'required|integer',
            'phone_number' => 'required|integer',
            'notes' => 'nullable|string|max:5000',
            'proof' => 'nullable|image|mimes:png,jpeg,jpg',
        ]);

        DB::beginTransaction();

        try {
            $total = 0;
            $adminFee = AdminFee::where('is_active', '1')->latest()->first();

            $cartItems = $user->carts;

            foreach ($cartItems as $item) {
                $total += $item->sub_total;
            }

            $tax = (int)round($adminFee->tax * $total / 100);
            $insurance = (int)round($adminFee->insurance * $total);
            $deliveryFee = (int)round($adminFee->delivery * $total);
            $grandTotal = $total + $deliveryFee + $tax + $insurance;
            $point = $total / 1000;
            $code = 'TRX-' . mt_rand(100000, 999999);

            $validated['user_id'] = $user->id;
            $validated['total_amount'] = $grandTotal;
            $validated['is_paid'] = 0;
            $validated['point'] = $point;
            $validated['code'] = $code;

            if ($request->hasFile('proof')) {
                $proofPath = $request->file('proof')->store('payment_proofs', 'public');
                $validated['proof'] = $proofPath;
            }

            $newTransaction = ProductTransaction::create($validated);

            foreach ($cartItems as $item) {
                TransactionDetail::create([
                    'product_transaction_id' => $newTransaction->id,
                    'product_id' => $item->product->id,
                    'price' => $item->product->price,
                    'qty' => $item->qty,
                    'sub_total' => $item->sub_total,
                    'point' => $point,
                ]);

                $item->delete();
            }
            DB::commit();

            return redirect()->route('orders');
        } catch (\Exception $e) {
            DB::rollBack();
            $error = ValidationException::withMessages([
                'system_error' => ['System Error' . $e->getMessage()],
            ]);

            throw $error;
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(ProductTransaction $productTransaction)
    {
        return view('admin.product_transactions.detail-dev', compact('productTransaction'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ProductTransaction $productTransaction)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ProductTransaction $productTransaction)
    {
        if ($productTransaction->is_paid == 0) {
            $productTransaction->update([
                'is_paid' => 1,
            ]);
        } else {
            $productTransaction->update([
                'is_paid' => 0,
            ]);
        }

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ProductTransaction $productTransaction)
    {
        //
    }
}
