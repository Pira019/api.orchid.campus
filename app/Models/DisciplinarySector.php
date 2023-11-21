<?php

namespace App\Models;

use App\Core\ServiceUtils;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DisciplinarySector extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $fillable = ['label', 'description'];

    protected function label(): Attribute
    {
        return Attribute::make(
            set: fn (string $value) => ServiceUtils::ucfirst_lower($value),
        );
    }
}
