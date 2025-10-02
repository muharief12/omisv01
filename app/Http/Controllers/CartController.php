<?php

namespace App\Http\Controllers;

use App\Models\AdminFee;
use App\Models\Cart;
use App\Models\Discount;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
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


        $productCarts = $user->carts()->with('product')->get();

        $totalPrice = Cart::where('user_id', $user->id)->with('product')->get()->sum('sub_total');

        // --- DISCOUNT HANDLING ---
        $discountCode = $request->query('discount_code');

        if ($discountCode) {
            // cek discount berdasarkan code
            $discount = Discount::where('code', $discountCode)->first();
            $userAffiliate = User::where('affiliate_code', $discountCode)->first();

            // jika ditemukan di table discounts
            if ($discount) {
                session(['discount_code' => $discountCode]);
            }
            // jika ditemukan di affiliate user dan bukan milik sendiri
            elseif ($userAffiliate && $userAffiliate->id !== Auth::id()) {
                session(['discount_code' => $discountCode]);
            }
            // kalau tidak ditemukan di keduanya
            else {
                return redirect()->back()->withErrors([
                    'discount_code' => "Kode discount/affiliate '{$discountCode}' tidak valid."
                ]);
            }
        } else {
            // kalau tidak ada query, tapi ada di session → tetap dipakai
            if (session()->has('discount_code')) {
                return redirect()->route('carts.index', [
                    'discount_code' => session('discount_code')
                ]);
            }
        }

        $discountCode = session('discount_code'); // ambil dari session saja
        $discountAmount = 0;
        $discountData = null;

        if ($discountCode) {
            // cek discount berdasarkan code
            $discount = Discount::where('code', $discountCode)->first();

            if ($discount) {
                $discountAmount = $totalPrice * ($discount->percentage / 100);
                $discountData = [
                    'type' => 'discount',
                    'code' => $discount->code,
                    'percentage' => $discount->percentage,
                ];
            } else {
                // cek affiliate code pada user
                $userAffiliate = User::where('affiliate_code', $discountCode)->first();

                if ($userAffiliate) {
                    $affiliateDiscount = Discount::where('name', 'affiliate')->first();

                    if ($affiliateDiscount) {
                        $discountAmount = $totalPrice * ($affiliateDiscount->percentage / 100);
                        $discountData = [
                            'type' => 'affiliate',
                            'code' => $userAffiliate->affiliate_code,
                            'percentage' => $affiliateDiscount->percentage,
                        ];
                    }
                }
            }
        }

        $ppn = $adminFee->tax * $totalPrice / 100;
        $insurance = $adminFee->insurance * $totalPrice;
        $delivery = $adminFee->delivery * $totalPrice;
        $grandTotal = ($totalPrice - $discountAmount) + $ppn + $insurance + $delivery;

        return view('front.carts', compact(
            'productCarts',
            'totalPrice',
            'adminFee',
            'ppn',
            'insurance',
            'delivery',
            'discountAmount',
            'discountData',
            'discountCode',
            'grandTotal'
        ));
    }

    public function removeDiscount(Request $request)
    {
        // hapus dari session
        $request->session()->forget('discount_code');
        return redirect()->route('carts.index')->with('success', 'Discount code removed successfully.');
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

        return redirect()->back()
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
