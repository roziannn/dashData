<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class LogsCommentInventary extends Model
{
    use HasFactory;

    protected $table = 'comment_inventary';
    protected $primaryKey = 'id';
    protected $fillable = [
        'user_id',
        'inventary_id',
        'field',
        'old_value',
        'new_value',
    ];
    
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
