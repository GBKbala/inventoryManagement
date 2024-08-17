<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AuditLog extends Model
{
    use HasFactory;
    protected $fillable = [
        'action',
        'item_id',
        'user_id',
        'details'
    ];

    protected $table='audit_logs';
}
