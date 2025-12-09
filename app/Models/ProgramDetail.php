<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\LogsActivity;

class ProgramDetail extends Model
{
    use HasFactory, LogsActivity;

    protected $fillable = [
        'program_id',
        'description',
        'degree',
        'credits_course',
        'period',
        'competency',
        'career_prospect',
    ];

    public function program()
    {
        return $this->belongsTo(\App\Models\Program::class);
    }

    public function structures()
    {
        return $this->hasMany(CurriculumStructure::class, 'program_detail_id');
    }

    /**
     * Get the program detail's title for activity log.
     */
    public function getActivityTitle(): string
    {
        return $this->program ? $this->program->name . ' Details' : 'Program Details #' . $this->id;
    }

    /**
     * Get the program name through relationship.
     */
    public function getProgramNameAttribute(): ?string
    {
        return $this->program ? $this->program->name : null;
    }
}
