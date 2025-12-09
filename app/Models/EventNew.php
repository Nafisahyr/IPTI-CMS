<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\LogsActivity;

class EventNew extends Model
{
    use HasFactory, LogsActivity;

    protected $fillable = [
        'event_id',
        'title',
        'publisher',
        'link',
    ];

    public function event()
    {
        return $this->belongsTo(\App\Models\Event::class);
    }

    /**
     * Get the event news title for activity log.
     */
    public function getActivityTitle(): string
    {
        return $this->title . ' - ' . $this->publisher;
    }

    /**
     * Get the event name through relationship.
     */
    public function getEventNameAttribute(): ?string
    {
        return $this->event ? $this->event->title : null;
    }

    /**
     * Scope a query to search event news.
     */
    public function scopeSearch($query, $search)
    {
        return $query->where('title', 'like', "%{$search}%")
                    ->orWhere('publisher', 'like', "%{$search}%")
                    ->orWhere('link', 'like', "%{$search}%");
    }

    /**
     * Check if link is external.
     */
    public function getIsExternalLinkAttribute(): bool
    {
        return str_starts_with($this->link, 'http');
    }
}
