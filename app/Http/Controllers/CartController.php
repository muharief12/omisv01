<?php

namespace App\Http\Controllers;

use App\Models\AdminFee;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        $adminFee = AdminFee::where('is_active', 1)->first();

        if (!$adminFee) {
            $adminFee = (object) [
                'delivery' => 0,
                'tax' => 0,
                'insurance' => 0,
            ];
        }

        // $productCarts = Cart::with('product')->where('user_id', $user->id)->get();
        $productCarts = $user->carts()->with('product')->get();
        // $totalPrice = Cart::where('user_id', $user->id)->with('product')->get()->sum(function ($cart) {
        //     return $cart->product ? $cart->product->price : 0;
        // });
        $totalPrice = Cart::where('user_id', $user->id)->with('product')->get()->sum('sub_total');
        $ppn = $adminFee->tax * $totalPrice / 100;
        $insurance = $adminFee->insurance * $totalPrice;
        $delivery = $adminFee->delivery * $totalPrice;
        $grandTotal = $totalPrice + $ppn + $insurance + $delivery;

        return view('front.carts', compact('productCarts', 'totalPrice', 'adminFee', 'ppn', 'insurance', 'delivery', 'grandTotal'));
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
    public function store($productId)
    {
        $user = Auth::user();

        $existingCartItem = Cart::where('user_id', $user->id)->where('product_id', $productId)->first();

        if ($existingCartItem) {
            return redirect()->route('carts.index');
        } else {

            DB::beginTransaction();

            try {
                $cart = Cart::updateOrCreate([
                    'user_id' => $user->id,
                    'product_id' => $productId,
                    'qty' => 1,
                ]);

                $cart['sub_total'] = Product::findOrFail($productId)->price * $cart->qty;

                $cart->save();

                DB::commit();

                return redirect()->route('carts.index');
            } catch (\Exception $e) {
                DB::rollBack();
                $error = ValidationException::withMessages([
                    'system_error' => ['System error' . $e->getMessage()],
                ]);

                throw $error;
            }
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Cart $cart)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cart $cart)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Cart $cart)
    {
        //
    }

    public function updateQuantity(Request $request, $cartId)
    {
        $request->validate([
            'qty' => 'required|integer|min:1',
        ]);

        $cart = Cart::where('user_id', Auth::id())
            ->where('id', $cartId) // tiap row unik
            ->firstOrFail();

        $product = Product::findOrFail($cart->product_id);

        // Update qty dari form
        $cart->qty = $request->qty;
        $cart->sub_total = $cart->qty * $product->price;
        $cart->save();

        return redirect()->route('carts.index')
            ->with('success', 'Cart updated successfully');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cart $cart)
    {
        try {
            $cart->delete();
            return redirect()->back();
        } catch (\Exception $e) {
            DB::rollBack();
            $error = ValidationException::withMessages([
                'system_error' => ['System Error ' . $e->getMessage()],
            ]);
            throw $error;
        }
    }
}
