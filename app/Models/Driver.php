<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Auditable as AuditableTrait;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Support\Str;
class Driver extends Model implements Auditable
{
    use AuditableTrait;
    use HasFactory;
    
    protected $table = 'drivers';
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

    public function region()
    {
        return $this->belongsTo(Region::class);
    }
}
