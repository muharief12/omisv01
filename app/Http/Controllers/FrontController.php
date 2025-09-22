<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\AdminFee;
use App\Models\Category;
use App\Models\Post;
use App\Models\Product;
use App\Models\ProductTransaction;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class FrontController extends Controller
{
    public function index(Request $request)
    {
        $keyword = $request->input('keyword');
        $logo = AdminFee::where('is_active', true)->first()?->logo;
        $products = Product::with('category')->orderBy('id', 'DESC')->take(6)->get();
        $categories = Category::all();

        return view('front.index', compact('products', 'categories', 'keyword', 'logo'));
    }

    public function search(Request $request)
    {
        $keyword = $request->input('keyword');
        $products = Product::where('name', 'LIKE', '%' . $keyword . '%')->get();

        return view('front.search', compact('products', 'keyword'));
    }

    public function category(Category $category)
    {
        $products = Product::with('category')->where('category_id', $category->id)->get();

        return view('front.category', compact('products', 'category'));
    }

    public function details(Product $product)
    {

        return view('front.detail', compact('product'));
    }

    public function orders()
    {
        $orders = ProductTransaction::with('details')->where('user_id', Auth::user()->id)->get();

        return view('front.orders', compact('orders'));
    }

    public function orderDetail(ProductTransaction $order)
    {
        $user = Auth::user();
        $adminFee = AdminFee::where('is_active', 1)->first();
        // pastikan hanya bisa akses order miliknya
        if ($order->user_id !== $user->id) {
            abort(403, 'Unauthorized action.');
        }

        return view('front.order_detail', compact('order', 'adminFee'));
    }

    public function posts()
    {
        $posts = Post::with('postType', 'user')->get();
        return view('front.posts.index', compact('posts'));
    }

    public function postDetail(Post $post)
    {
        return view('front.posts.detail', compact('post'));
    }

    public function profile()
    {
        $user = User::with(['transactions'])->where('id', Auth::user()->id)->first();
        $transaction = $user->transactions?->count();
        $point = ProductTransaction::where('user_id', Auth::user()->id)->sum('point');


        return view('front.profile', compact('user', 'transaction', 'point'));
    }

    public function profileUpdate(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('my_profile')->with('status', 'profile-updated');
    }
}
