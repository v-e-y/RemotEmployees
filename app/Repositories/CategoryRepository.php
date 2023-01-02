<?php

declare(strict_types=1);

namespace App\Repositories;

use Exception;
use App\Models\Category;
use App\Events\CategoryCreated;
use App\Events\CategoryDeleted;
use App\Events\CategoryUpdated;
use Illuminate\Support\Facades\Cache;
use Illuminate\Database\Eloquent\Collection;

final class CategoryRepository
{
    /**
     * Get Category by id or slug
     * @param string|null $id
     * @param string|null $slug
     * @return \App\Models\Category|null
     */
    public static function getCategory(string $id = null, string $slug = null): Category|null
    {
        if ($id) {
            return Cache::rememberForever(
                Category::class . '_id_' . $id,
                function () use ($id) {
                    return self::getAllCategories()->find($id);
                }
            );
        }

        if ($slug) {
            return Cache::rememberForever(
                Category::class . '_slug_' . $slug,
                function () use ($slug) {
                    return self::getAllCategories()->where('slug', $slug)->first();
                }
            );
        }

        return null;
    }

    /**
     * Get all existed Categories.
     * Categories fields: id, name, slug, description.
     * @return \Illuminate\Database\Eloquent\Collection<int,Category>
     */
    public static function getAllCategories(): Collection
    {
        return Cache::rememberForever(Category::class, function () {
            return Category::all(['id', 'name', 'slug', 'description']);
        });
    }

    /**
     * Get Category Products
     * @param \App\Models\Category $category
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public static function getCategoryProducts(Category $category): Collection
    {
        return Cache::rememberForever(
            Category::class . '_' . $category->id . '_products',
            function () use ($category) {
                return $category->products;
            }
        );
    }

    /**
     * Create/Store Category
     * @param array<string,mixed> $dataForCreateCategory validated data
     * @return \App\Models\Category|\Exception
     */
    public static function createCategory(array $dataForCreateCategory): Category|Exception
    {
        /**
         * @var Category
         */
        $category = Category::create($dataForCreateCategory);

        if (! $category instanceof Category) {
            return throw new Exception("Can`t create category now", 1);
        }

        CategoryCreated::dispatch($category);

        return $category;
    }

    /**
     * Update Category
     * @param array<string,mixed> $dataForUpdateCategory validated data
     * @param \App\Models\Category $category Category for update
     * @return \App\Models\Category|\Exception
     */
    public static function updateCategory(array $dataForUpdateCategory, Category $category): Category|Exception
    {
        if (! $category->update($dataForUpdateCategory)) {
            return throw new Exception("Sorry something happen while updating category", 1);
        }

        CategoryUpdated::dispatch($category);

        return $category;
    }

    public static function destroyCategory(Category $category): bool|Exception
    {
        if (! $category->delete()) {
            return throw new Exception("Cant`t delete category now", 1);
        }

        CategoryDeleted::dispatch($category);

        return true;
    }
}
