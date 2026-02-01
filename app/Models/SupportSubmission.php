<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SupportSubmission extends Model
{
    protected $fillable = [
        'name',
        'email',
        'category',
        'subject',
        'message',
        'status',
        'admin_notes',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
}
