<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property string $key
 * @property string $name
 * @property string $category
 * @property string|null $description
 * @property string $subject
 * @property string|null $preheader
 * @property string $body_html
 * @property string|null $body_text
 * @property array<int, string>|null $variables
 * @property bool $is_active
 * @property bool $is_system
 * @property int $sort_order
 * @property int|null $updated_by
 * @property User|null $updatedBy
 */
#[Fillable([
    'key',
    'name',
    'category',
    'description',
    'subject',
    'preheader',
    'body_html',
    'body_text',
    'variables',
    'is_active',
    'is_system',
    'sort_order',
    'updated_by',
])]
class EmailTemplate extends Model
{
    protected function casts(): array
    {
        return [
            'variables' => 'array',
            'is_active' => 'boolean',
            'is_system' => 'boolean',
            'sort_order' => 'integer',
        ];
    }

    /**
     * @return BelongsTo<User, $this>
     */
    public function updatedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    /**
     * @return Attribute<string, string>
     */
    protected function key(): Attribute
    {
        return Attribute::set(function (string $value): string {
            if ($this->exists && $this->getRawOriginal('key') !== $value) {
                throw new \LogicException('Email template keys are immutable.');
            }

            return strtolower(trim($value));
        });
    }
}
