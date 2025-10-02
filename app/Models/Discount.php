<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Discount extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'discounts';
    protected $guarded = ['id'];

    public function productTransaction(): HasMany
    {
        return $this->hasMany(ProductTransaction::class, 'discount_id', 'id');
    }
}
