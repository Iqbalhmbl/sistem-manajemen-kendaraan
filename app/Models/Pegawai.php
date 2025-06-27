<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Auditable as AuditableTrait;
use OwenIt\Auditing\Contracts\Auditable;

class Pegawai extends Model implements Auditable
{
    use HasFactory;
    use AuditableTrait;

    protected $table = 'pegawai';
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = ['id', 'nama', 'jabatan', 'user_id'];
}
