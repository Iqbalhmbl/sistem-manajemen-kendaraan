<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Permission\Models\Permission as SpatiePermission;
use OwenIt\Auditing\Auditable as AuditableTrait;
use OwenIt\Auditing\Contracts\Auditable;

class Permission extends SpatiePermission implements Auditable
{
    use HasFactory;
    use HasUuids;
    use AuditableTrait;
    
    protected $primaryKey = 'uuid';
    public $incrementing = false;
    protected $keyType = 'string';
    public function getRouteKeyName()
    {
        return 'uuid';
    }
}