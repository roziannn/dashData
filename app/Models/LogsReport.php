<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LogsReport extends Model
{
    use HasFactory;
    protected $table = 'logs_report';
    protected $primaryKey = 'id';
    protected $fillable = [
      'user_id',
      'user_name',
      'type_log',
      'event',
      'extra',
      'ip',
    ];

    public static function record($user_id = null, $user_name, $type_log, $event, $extra)
    {
        return static::create([
            'user_id' => is_null($user_id) ? null : $user_id->id,
            'user_name' => $user_name,
            'type_log' => $type_log,
            'event' => $event,
            'extra' => $extra,
            'ip' => request()->ip(),
        ]);
    }
}
