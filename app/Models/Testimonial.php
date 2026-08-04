<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

#[Fillable([
    'author_name',
    'author_designation',
    'author_organization',
    'author_avatar',
    'quote',
    'is_enabled',
    'sort_order',
])]
class Testimonial extends Model
{
    protected function casts(): array
    {
        return [
            'is_enabled' => 'boolean',
        ];
    }

    public function scopeEnabled(Builder $query): Builder
    {
        return $query->where('is_enabled', true);
    }
}
