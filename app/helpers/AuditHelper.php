<?php

namespace App\Helpers;

use App\Models\AuditLog;

class AuditHelper
{
    public static function log($action, $module, $description)
    {
        AuditLog::create([
            'user_id' => auth()->id(),
            'action' => $action,
            'module' => $module,
            'description' => $description,
            'ip_address' => request()->ip(),
        ]);
    }
}