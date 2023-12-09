<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class Log extends BaseModel
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'session_id',
        'ip_address',
        'method',
        'uri',
        'parameters',
        'response',
        'start_date',
        'execution_time',
    ];

}
