<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventNew extends Model
{
    use HasFactory;

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
}
