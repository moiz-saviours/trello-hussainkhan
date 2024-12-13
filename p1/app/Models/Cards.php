<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Traits\ActivityLoggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cards extends Model
{

    use SoftDeletes;
    
    use ActivityLoggable;

    protected $fillable = ['board_list_id','name', 'startdate', 'duedate', 'tags', 'image', 'priority'];  

  

    
}
