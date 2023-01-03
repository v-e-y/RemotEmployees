<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\Condition;
use Illuminate\Support\Facades\Cache;
use Illuminate\Database\Eloquent\Collection;

final class ConditionRepository
{
    /**
     * Get all existed Conditions.
     * Condition fields: id, name, slug.
     * @return \Illuminate\Database\Eloquent\Collection<int,Condition>
     */
    public static function getAllConditions(): Collection
    {
        return Cache::rememberForever('conditions', function () {
            return Condition::all(['id', 'name', 'slug']);
        });
    }
}