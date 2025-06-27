<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Permission\Models\Role as SpatieRole;
use OwenIt\Auditing\Auditable as AuditableTrait;
use OwenIt\Auditing\Contracts\Auditable;

class Role extends SpatieRole implements Auditable
{
    use HasFactory;
    use HasUuids;
    use AuditableTrait;

    protected $primaryKey = 'uuid';

    public function getRouteKeyName()
    {
        return 'uuid';
    }

}