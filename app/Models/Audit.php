<?php

namespace App\Models;

use OwenIt\Auditing\Models\Audit as BaseAudit;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\User;

class Audit extends BaseAudit
{
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
