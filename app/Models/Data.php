<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Data extends Model
{
    use HasFactory;
    protected $guarded = [
        'id',
        'created_at',
        'updated_at',
    ];
    public function package(): BelongsTo
    {
        return $this->belongsTo(Package::class);
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->customer_id = self::generateCustomerId();
        });
    }

    public static function generateCustomerId()
    {
        do {
            $id = 'CUST' . mt_rand(100000, 999999);
        } while (self::where('customer_id', $id)->exists());

        return $id;
    }
}
