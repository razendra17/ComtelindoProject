<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class City extends Model
{
    protected $fillable = [
        'name',
        'area'
    ];
    use HasFactory;
    public function packages():HasMany{
        return $this->hasMany(Packages::class);
    }
}
