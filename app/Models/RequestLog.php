<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RequestLog extends Model
{
    protected $table = 'requestLogs';

    protected $fillable = [
        'action', 'method', 'ip', 'city', 'country', 'type', 'data'
    ];

    public static $rules = [
        'id' => 'required|integer|min:1',
        'action' => 'required|string',
        'method' => 'required|string',
        'ip' => 'required|ip',
        'city' => 'nullable|string',
        'country' => 'nullable|string',
        'type' => 'required|string|in:GET,POST',
        'data' => 'nullable'
    ];
}
