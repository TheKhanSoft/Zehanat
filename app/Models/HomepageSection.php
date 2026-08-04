<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

#[Fillable([
    'block_id',
    'layout_template',
    'title',
    'icon',
    'is_enabled',
    'sort_order',
    'content',
])]
class HomepageSection extends Model
{
    protected function casts(): array
    {
        return [
            'is_enabled' => 'boolean',
            'content' => 'array',
        ];
    }

    public function scopeEnabled(Builder $query): Builder
    {
        return $query->where('is_enabled', true);
    }
}
