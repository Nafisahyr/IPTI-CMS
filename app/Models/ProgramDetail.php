<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProgramDetail extends Model
{
    use HasFactory;

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
}
