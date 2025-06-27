<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Auditable as AuditableTrait;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Support\Str;
class Booking extends Model implements Auditable
{
    use AuditableTrait;
    use HasFactory;
    
    protected $table = 'bookings';
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

    public function kendaraan()
    {
        return $this->belongsTo(Kendaraan::class, 'kendaraan_id');
    }

    public function driver()
    {
        return $this->belongsTo(Driver::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function bookingUsage()
    {
        return $this->hasOne(KendaraanUsage::class, 'booking_id');
    }

    public function approver1()
    {
        return $this->belongsTo(User::class, 'approver1_id');
    }

    public function approver2()
    {
        return $this->belongsTo(User::class, 'approver2_id');
    }


}
