<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class Post extends Model
{
    use HasFactory;

    protected $table = 'posts';
    protected $guarded = ['id'];


    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function postType(): BelongsTo
    {
        return $this->belongsTo(PostType::class, 'post_type_id', 'id');
    }

    protected static function booted()
    {
        static::creating(function ($post) {
            // hanya buat slug saat pertama kali
            if (empty($postType->slug)) {
                $post->slug = static::generateUniqueSlug($post->name);
            }
            $post->like = 0;
            $post->user_id = Auth::user()->id;
        });

        static::updating(function ($post) {
            // update slug setiap kali name berubah
            if ($post->isDirty('title')) {
                $post->slug = static::generateUniqueSlug($post->title, $post->id);
            }
        });
    }

    /**
     * Generate slug unik berdasarkan title
     */
    protected static function generateUniqueSlug($title, $ignoreId = null)
    {
        $slug = Str::slug($title);
        $originalSlug = $slug;
        $counter = 2;

        // cek apakah slug sudah ada
        while (static::where('slug', $slug)
            ->when($ignoreId, fn($q) => $q->where('id', '!=', $ignoreId))
            ->exists()
        ) {
            $slug = $originalSlug . '-' . $counter++;
        }

        return $slug;
    }
}
