<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
class Permission extends Model
{
    use HasFactory,LogsActivity;
    protected $guarder=[];
    protected static $logAttributes = ['name'];
    
    public function roles(){
        return $this->belongsToMany(Role::class);
    }
    public function users(){
        return $this->belongsToMany(Users::class);
    }
}
