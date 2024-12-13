<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Traits\ActivityLoggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Brand extends Model
{
    use ActivityLoggable;

    use SoftDeletes;

    protected $fillable = ['name', 'code', 'url', 'image', 'is_active'];  

    public function getLogs(){
        return $this->hasMany(ActivityLog::class,'model_id','id');
    }
}
