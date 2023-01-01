<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\Product;
use Illuminate\Support\Facades\Cache;
use Illuminate\Database\Eloquent\Collection;

final class ProductRepository
{
    public static function getProduct(string $id): Product|null
    {
        return Cache::rememberForever(
            Product::class . '_id_' . $id,
            function () use ($id) {
                return self::getAllProducts()->find($id);
            }
        );
    }

    /**
     * Get all existed Products.
     * Categories fields: id, name, slug, description.
     * @return \Illuminate\Database\Eloquent\Collection<int,Product>
     */
    public static function getAllProducts(): Collection
    {
        return Cache::rememberForever(Product::class, function () {
            return Product::all(
                ['id', 'name', 'price', 'description', 'condition_id']
            );
        });
    }
}