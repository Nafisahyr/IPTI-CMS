<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CurriculumStructure extends Model
{
    use HasFactory;
    protected $fillable = [
    'program_details_id',
    'year',
    'description',

    ];
    public function programDetail()
    {
        return $this->belongsTo(ProgramDetail::class, 'program_details_id');
    }
}
