<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LogsInventary extends Model
{
    use HasFactory;
    
    protected $table = 'logs_inventary';
    protected $primaryKey = 'id';
    protected $fillable = [
      'user_id',
      'user_name',
      'ip',
      'event',
      'extra'
    ];

    public static function record($user_id = null, $user_name = null, $event, $extra)
    {
        return static::create([
            'user_id' => is_null($user_id) ? null : $user_id->id,
            'user_id' => $user_name,
            'ip' => request()->ip(),
            'event' => $event,
            'extra' => $extra
        ]);
    }
}
