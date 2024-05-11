<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailProgram extends Model
{
    use HasFactory;

    protected $table = "university_program";
    protected $guarded = ['id'];

}
