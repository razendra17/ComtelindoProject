<?php

namespace App\Models;

use App\Constant;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\DB;

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

    public static function statusSummary()
    {
        return self::select('status', DB::raw('COUNT(*) as total'))
            ->groupBy('status')
            ->pluck('total', 'status');
    }
    public static function dashboardData($start, $end)
    {
        return self::select(
            DB::raw('MONTH(created_at) as bulan'),
            DB::raw('MONTHNAME(created_at) as nama_bulan'),
            DB::raw('COUNT(*) as total')
        )
        ->whereBetween('created_at', [$start, $end])
        ->groupBy('bulan', 'nama_bulan')
        ->orderBy('bulan')
        ->get();
    }
    public static function dominantReason()
    {
        return self::where('status', Constant::status['rejected'])
            ->select('rejection', DB::raw('COUNT(*) as total'))
            ->groupBy('rejection')
            ->orderByDesc('total')
            ->limit(3)
            ->get();
    }

    
}
