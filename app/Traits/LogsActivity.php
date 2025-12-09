<?php

namespace App\Traits;

use App\Models\ActivityLog;
use Illuminate\Support\Facades\Auth;

trait LogsActivity
{
    /**
     * Boot the trait.
     */
    protected static function bootLogsActivity()
    {
        // Log created event
        static::created(function ($model) {
            $model->logActivity('created');
        });

        // Log updated event
        static::updated(function ($model) {
            $model->logActivity('updated');
        });

        // Log deleted event
        static::deleted(function ($model) {
            $model->logActivity('deleted');
        });
    }

    /**
     * Log an activity.
     */
    protected function logActivity(string $event): void
    {
        // Skip if no user is authenticated
        if (!Auth::check()) {
            return;
        }

        ActivityLog::create([
            'subject_type' => get_class($this),
            'subject_id' => $this->getKey(),
            'causer_type' => get_class(Auth::user()),
            'causer_id' => Auth::id(),
            'user_id' => Auth::id(),
            'description' => $this->getActivityDescription($event),
            'event' => $event,
            'properties' => $this->getActivityProperties($event),
            'log_name' => $this->getLogName(),
        ]);
    }

    /**
     * Get the activity description.
     */
    protected function getActivityDescription(string $event): string
    {
        $modelName = $this->getModelNameForLog();
        $userName = Auth::user()->name;
        $title = $this->getActivityTitle();

        return match($event) {
            'created' => "{$userName} created new {$modelName}: {$title}",
            'updated' => "{$userName} updated {$modelName}: {$title}",
            'deleted' => "{$userName} deleted {$modelName}: {$title}",
            default => "{$userName} performed {$event} on {$modelName}: {$title}",
        };
    }

    /**
     * Get model name for log (with spaces).
     */
    protected function getModelNameForLog(): string
    {
        $name = class_basename($this);

        // Add spaces before capital letters
        return preg_replace('/(?<!^)[A-Z]/', ' $0', $name);
    }

    /**
     * Get the activity title.
     */
    protected function getActivityTitle(): string
    {
        if (isset($this->name)) {
            return $this->name;
        }

        if (isset($this->title)) {
            return $this->title;
        }

        return '#' . $this->getKey();
    }

    /**
     * Get the activity properties.
     */
    protected function getActivityProperties(string $event): array
    {
        $properties = [
            'event' => $event,
            'model' => get_class($this),
            'model_id' => $this->getKey(),
        ];

        if ($event === 'updated') {
            $properties['changes'] = $this->getChanges();
        }

        return $properties;
    }

    /**
     * Get the log name.
     */
    protected function getLogName(): string
    {
        return strtolower(class_basename($this));
    }
}
