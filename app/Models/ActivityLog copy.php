<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActivityLog extends Model
{
    protected $fillable = ['action', 'model_type', 'model_id', 'user_id', 'details'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public static function logActivity($action, $model, $description)
{
    return self::create([
        'action' => $action,
        'model_type' => get_class($model),
        'model_id' => $model->id,
        'description' => $description,
        'user_id' => auth()->user()->id,
    ]);
}
}
