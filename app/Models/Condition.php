<?php

namespace App\Models;

use App\Models\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Condition extends Model
{
    use HasFactory;

    protected $guarded = [];

    /**
     * Relations
     */

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
