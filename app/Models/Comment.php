<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
class Comment extends Model
{
    use HasFactory;

    protected $guarder = [];

    use LogsActivity;

    protected static $logAttributes = ['author', 'is_active', 'post_id'];
    public function post(){
        return $this->belongsTo(Post::class);
    }

  
}
