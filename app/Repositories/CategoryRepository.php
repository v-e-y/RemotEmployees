<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\Category;
use Illuminate\Support\Facades\Cache;
use Illuminate\Database\Eloquent\Collection;

final class CategoryRepository
{
    /**
     * Get all existed Categories.
     * Categories fields: id, name, slug, description.
     * @return \Illuminate\Database\Eloquent\Collection<int,Category>
     */
    public static function getAllCategories(): Collection
    {
        return Cache::rememberForever('categories', function () {
            return Category::all(['id', 'name', 'slug', 'description']);
        });
    }
}