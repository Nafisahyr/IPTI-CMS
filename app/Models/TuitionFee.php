<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\LogsActivity;

class TuitionFee extends Model
{
    use HasFactory, LogsActivity;

    protected $fillable = [
        'image',
    ];

    /**
     * Get the tuition fee title for activity log.
     */
    public function getActivityTitle(): string
    {
        return 'Tuition Fee Image #' . $this->id;
    }

    /**
     * Get the tuition fee image URL.
     */
    public function getImageUrlAttribute(): ?string
    {
        if (!$this->image) {
            return null;
        }

        if (str_starts_with($this->image, 'http')) {
            return $this->image;
        }

        return asset('storage/' . $this->image);
    }
}
