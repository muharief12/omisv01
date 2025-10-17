<?php

namespace App\Models;

use App\Traits\HasImageCleanUp;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class Category extends Model
{
    use HasFactory, SoftDeletes, HasImageCleanUp;

    protected $guarded = ['id'];

    public function products()
    {
        return $this->hasMany(Product::class, 'category_id');
    }

    #protected static array $imageFields = ['icon']; // ✅ Field yang perlu dibersihkan filenya
    protected static function booted()
    {
        parent::boot();
        static::creating(function ($category) {
            // hanya buat slug saat pertama kali
            if (empty($category->slug)) {
                $category->slug = static::generateUniqueSlug($category->name);
            }
        });

        static::updating(function ($category) {
            // update slug setiap kali name berubah
            if ($category->isDirty('name')) {
                $category->slug = static::generateUniqueSlug($category->name, $category->id);
            }
        });

        static::updated(function ($category) {
            // 🔄 Saat user mengganti foto
            if ($category->wasChanged('icon')) {
                $oldIcon = $category->getOriginal('icon');
                $newIcon = $category->icon;

                if ($oldIcon && $oldIcon !== $newIcon && Storage::disk('public')->exists($oldIcon)) {
                    Storage::disk('public')->delete('category_icon/' . $oldIcon);
                }
            }
        });

        static::deleting(function ($category) {
            if ($category->icon && Storage::disk('public')->exists($category->icon)) {
                Storage::disk('public')->delete($category->icon);
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
