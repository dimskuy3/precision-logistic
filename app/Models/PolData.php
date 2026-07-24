<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PolData extends Model
{
    use HasFactory;

    protected $table = 'pol_data';

    protected $primaryKey = 'pol_id';

    protected $fillable = [
        'status',
        'booking_date',
        'consignee',
        'sales',
        'kode_origin',
        'origin',
        'user_id',
    ];

    protected function casts(): array
    {
        return [
            'booking_date' => 'date',
        ];
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['status'] ?? null, fn($q, $v) => $q->where('status', $v));
        $query->when($filters['consignee'] ?? null, fn($q, $v) => $q->where('consignee', 'like', "%{$v}%"));
        $query->when($filters['sales'] ?? null, fn($q, $v) => $q->where('sales', 'like', "%{$v}%"));
        $query->when($filters['kode_origin'] ?? null, fn($q, $v) => $q->where('kode_origin', 'like', "%{$v}%"));
        $query->when($filters['origin'] ?? null, fn($q, $v) => $q->where('origin', 'like', "%{$v}%"));

        return $query;
    }
}
