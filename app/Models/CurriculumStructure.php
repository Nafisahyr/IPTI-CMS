<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\LogsActivity;

class CurriculumStructure extends Model
{
    use HasFactory, LogsActivity;

    protected $fillable = [
        'program_detail_id',
        'year',
        'description',
    ];

    public function programDetail()
    {
        return $this->belongsTo(ProgramDetail::class, 'program_detail_id');
    }

    /**
     * Get the curriculum structure's title for activity log.
     */
    public function getActivityTitle(): string
    {
        $programName = $this->programDetail && $this->programDetail->program
            ? $this->programDetail->program->name
            : 'Program';

        return "{$programName} - Year {$this->year} Curriculum";
    }

    /**
     * Get the program name through relationships.
     */
    public function getProgramNameAttribute(): ?string
    {
        return $this->programDetail && $this->programDetail->program
            ? $this->programDetail->program->name
            : null;
    }

    /**
     * Get the year with suffix.
     */
    public function getYearFormattedAttribute(): string
    {
        $suffix = ['st', 'nd', 'rd'][$this->year - 1] ?? 'th';
        return $this->year . $suffix . ' Year';
    }
}
