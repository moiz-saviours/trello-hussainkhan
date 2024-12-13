<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Traits\ActivityLoggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Board_List extends Model
{
    use SoftDeletes;

    use ActivityLoggable;
    
    protected $fillable = ['name', 'is_active'];

    public function cards(){
        return $this->hasMany(Cards::class,'board_list_id');
    }
}
