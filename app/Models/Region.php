<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Auditable as AuditableTrait;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Support\Str;
class Region extends Model implements Auditable
{
    use AuditableTrait;
    use HasFactory;

    protected $table = 'regions';
    protected $guarded = [];

    protected $keyType = 'string';
    public $incrementing = false;

        protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->{$model->getKeyName()})) {
                $model->{$model->getKeyName()} = (string) Str::uuid();
            }
        });
    }
}
