<?php

namespace App\Http\Controllers;

use App\Models\PostLike;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostLikeController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'post_id' => 'required|exists:posts,id',
        ]);

        $user_id = Auth::id();
        $post_id = $validated['post_id'];

        $like = PostLike::where('user_id', $user_id)
            ->where('post_id', $post_id)
            ->first();

        if ($like) {
            $like->delete();
            return response()->json(['status' => 'unliked']);
        } else {
            PostLike::create([
                'user_id' => $user_id,
                'post_id' => $post_id,
            ]);
            return response()->json(['status' => 'liked']);
        }
    }
}
