<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['name', 'email', 'phone', 'category', 'institution', 'message', 'status', 'banned_at', 'ban_reason'])]
class Member extends Model
{
    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'status' => 'string',
            'category' => 'string',
            'banned_at' => 'datetime',
        ];
    }

    public function scopePending(Builder $query): void
    {
        $query->where('status', 'pending');
    }

    public function scopeApproved(Builder $query): void
    {
        $query->where('status', 'approved');
    }

    public function scopeBanned(Builder $query): void
    {
        $query->whereNotNull('banned_at');
    }

    public function isBanned(): bool
    {
        return $this->banned_at !== null;
    }
}
