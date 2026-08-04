<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

#[Fillable([
    'tag',
    'title',
    'subtitle',
    'background_image',
    'button1_text',
    'button1_url',
    'button1_variant',
    'button2_text',
    'button2_url',
    'button2_variant',
    'is_enabled',
    'sort_order',
])]
class HeroSlide extends Model
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
