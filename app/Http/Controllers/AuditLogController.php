<?php

namespace App\Http\Controllers;

use App\Models\AuditLog;
use Illuminate\Http\Request;
use App\Helpers\AuditHelper;

class AuditLogController extends Controller
{
    public function index(Request $request)
    {
        $query = AuditLog::with('user');

        // SEARCH
        if ($request->filled('search')) {

            $search = $request->search;
        
            $query->where(function ($q) use ($search) {
        
                $q->where('module', 'like', "%{$search}%")
                  ->orWhere('action', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%")
                  ->orWhere('ip_address', 'like', "%{$search}%")
        
                  ->orWhereHas('user', function ($uq) use ($search) {
        
                      $uq->where('first_name', 'like', "%{$search}%")
                         ->orWhere('last_name', 'like', "%{$search}%")
                         ->orWhereRaw(
                             "CONCAT(first_name, ' ', last_name) LIKE ?",
                             ["%{$search}%"]
                         );
        
                  });
        
            });
        
        }

        // ACTION FILTER
        if ($request->filled('action')) {
            $query->where('action', $request->action);
        }

        // MODULE FILTER
        if ($request->filled('module')) {
            $query->where('module', $request->module);
        }

        $logs = $query
            ->latest()
            ->paginate(15)
            ->withQueryString();

        return view('audit.index', [
            'logs' => $logs,

            'actions' => AuditLog::select('action')
                ->distinct()
                ->pluck('action'),

            'modules' => AuditLog::select('module')
                ->distinct()
                ->pluck('module'),
        ]);
    }

    public function clear()
    {
        AuditHelper::log(
            'DELETE',
            'Audit',
            auth()->user()->name . ' cleared all audit logs'
        );
        
        AuditLog::where('id', '<>', AuditLog::latest()->first()->id)
            ->delete();

        return redirect()
            ->route('audit.index')
            ->with('success', 'Audit logs cleared.');
    }
}