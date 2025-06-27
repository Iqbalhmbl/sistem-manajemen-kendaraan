<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Auditable as AuditableTrait;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Support\Str;

class KendaraanUsage extends Model implements Auditable
{
    use AuditableTrait;
    use HasFactory;

    protected $table = 'kendaraan_usages';
    protected $guarded = [];

    protected $keyType = 'string';
    public $incrementing = false;

    
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (!$model->getKey()) {
                $model->{$model->getKeyName()} = (string) Str::uuid();
            }
        });
    }

    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }

    public function kendaraan()
    {
        return $this->belongsTo(Kendaraan::class, 'kendaraan_id');
    }
}
