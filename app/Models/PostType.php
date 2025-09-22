<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class PostType extends Model
{
    use HasFactory;

    protected $table = 'post_types';
    protected $guarded = ['id'];

    public function posts(): HasMany
    {
        return $this->hasMany(Post::class, 'post_type_id', 'id');
    }

    protected static function booted()
    {
        static::creating(function ($postType) {
            // hanya buat slug saat pertama kali
            if (empty($postType->slug)) {
                $postType->slug = static::generateUniqueSlug($postType->name);
            }
        });

        static::updating(function ($postType) {
            // update slug setiap kali name berubah
            if ($postType->isDirty('name')) {
                $postType->slug = static::generateUniqueSlug($postType->name, $postType->id);
            }
        });
    }

    /**
     * Generate slug unik berdasarkan title
     */
    protected static function generateUniqueSlug($name, $ignoreId = null)
    {
        $slug = Str::slug($name);
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
