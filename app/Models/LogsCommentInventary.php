<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LogsCommentInventary extends Model
{
    use HasFactory;
    
    protected $table = 'comment_inventary';
    protected $primaryKey = 'id';
    protected $fillable = [
      'user_id',
      'inventary_id',
      'user_name',
      'event',
      'extra',
      'ip',
    ];

    public static function record($user_id = null, $inventary_id, $user_name, $event, $extra)
    {
        return static::create([
            'user_id' => is_null($user_id) ? null : $user_id->id,
            'inventary_id' => $inventary_id,
            'user_name' => $user_name,
            'event' => $event,
            'extra' => $extra,
            'ip' => request()->ip(),
        ]);
    }
}
