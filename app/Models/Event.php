<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\LogsActivity;

class Event extends Model
{
    use HasFactory, LogsActivity;

    protected $fillable = [
        'title',
        'description',
        'thumbnail',
    ];

    public function news()
    {
        return $this->hasMany(EventNew::class, 'event_id');
    }

    /**
     * Get the event's title for activity log.
     */
    public function getActivityTitle(): string
    {
        return $this->title;
    }

    /**
     * Get the event's thumbnail URL.
     */
    public function getThumbnailUrlAttribute(): ?string
    {
        if (!$this->thumbnail) {
            return null;
        }

        if (str_starts_with($this->thumbnail, 'http')) {
            return $this->thumbnail;
        }

        return asset('storage/' . $this->thumbnail);
    }

    /**
     * Get the news count for this event.
     */
    public function getNewsCountAttribute(): int
    {
        return $this->news()->count();
    }

    /**
     * Scope a query to search events.
     */
    public function scopeSearch($query, $search)
    {
        return $query->where('title', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%");
    }

    /**
     * Scope a query to order by recent events.
     */
    public function scopeRecent($query, $limit = 5)
    {
        return $query->latest()->limit($limit);
    }
}
