<?php

declare(strict_types=1);

namespace App\Repositories;

use Exception;
use App\Models\Product;
use Illuminate\Support\Arr;
use App\Events\ProductCreated;
use App\Events\ProductDeleted;
use App\Events\ProductUpdated;
use Illuminate\Support\Facades\Cache;
use Illuminate\Database\Eloquent\Collection;

final class ProductRepository
{
    /**
     * Get Product by id
     
     * @param string $id
     * @return \App\Models\Product|null
     */
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
            return Product::select(
                ['id', 'name', 'price', 'description', 'condition_id']
            )->orderBy('created_at', 'desc')->get();
        });
    }

    /**
     * Update Product
     * @param \App\Models\Product $product
     * @param array<string,mixed> $newData
     * @return \App\Models\Product|\Exception
     */
    public static function updateProduct(Product $product, array $newData): Product|Exception
    {
        if (! $product->update($newData)) {
            return throw new Exception(
                "We were unable to update the product" . $product->id,
                1
            );
        }

        if ($newData['categories']) {
            $product->categories()->sync($newData['categories']);
        }

        ProductUpdated::dispatch($product);

        return $product;
    }

    /**
     * Create new Product
     * @param array<string,mixed> $productData
     * @return \App\Models\Product|\Exception
     */
    public static function createProduct(array $productData): Product|Exception
    {
        /**
         * @var Product created product
         */
        $product = Product::create(
            Arr::only($productData, app(Product::class)->getFillable())
        );

        if (! $product instanceof Product) {
            return throw new Exception("The product has not been created", 1);
        }

        /**
         * Attach product to categories
         */
        if (array_key_exists('categories', $productData)) {
            $product->categories()->attach(
                $productData['categories']
            );
        }

        // Update product cache
        ProductCreated::dispatch($product);

        return $product;
    }

    /**
     * Delete Product
     * @param \App\Models\Product $product
     * @return boolean|\Exception
     */
    public static function destroyProduct(Product $product): bool|Exception
    {
        if (! $product->delete()) {
            return throw new Exception("Cant`t delete product " . $product->id . " now", 1);
        }

        ProductDeleted::dispatch($product);

        return true;
    }
}
