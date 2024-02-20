<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AdmissionDate extends Model
{
    use HasFactory;

    protected $fillable = ['detail_program_id','cycle', 'type','start_at','end_at','session_admission','link'];

    public function universityProgram() : BelongsTo
    {
        return $this->belongsTo(DetailProgram::class);
    }
}
