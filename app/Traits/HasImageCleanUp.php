<?php

namespace App\Traits;

use Illuminate\Support\Facades\Storage;

trait HasImageCleanUp
{
    /**
     * Daftar atribut yang akan dihapus file lamanya ketika model diperbarui atau dihapus.
     *
     * @var array
     */
    protected static array $imageFields = [];

    public static function bootHasImageCleanup()
    {
        // 🔁 Hapus file lama setelah update berhasil
        static::updated(function ($model) {
            foreach (static::$imageFields as $field) {
                if ($model->wasChanged($field)) {
                    $oldFile = $model->getOriginal($field);
                    $newFile = $model->{$field};

                    if ($oldFile && $oldFile !== $newFile && Storage::disk('public')->exists($oldFile)) {
                        Storage::disk('public')->delete($oldFile);
                    }
                }
            }
        });

        // 🗑️ Hapus file saat record dihapus
        static::deleting(function ($model) {
            foreach (static::$imageFields as $field) {
                $file = $model->{$field};

                if ($file && Storage::disk('public')->exists($file)) {
                    Storage::disk('public')->delete($file);
                }
            }
        });
    }
}
