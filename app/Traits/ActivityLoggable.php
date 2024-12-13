<?php

namespace App\Traits;

use App\Models\ActivityLog;

trait ActivityLoggable
{
    /**
     * Boot the trait and listen to the events of the model.
     */
    protected static function bootActivityLoggable()
    {
        static::created(function ($model) {
            $model->logActivity('create', auth()->user()->name . " created a new " . ($model->getTable()) . ": " . $model->name);
        });

        static::updated(function ($model) {
            $entityName = $model->name ?? 'Unknown'; 

            $model->logActivity('updated', auth()->user()->name . " updated " . ($model->getTable()) . ": " . $entityName);
        });

       
        static::deleted(function ($model) {
            $entityName = $model->name ?? 'Unknown'; 
            
            // Log the activity
            $model->logActivity('deleted', auth()->user()->name . " deleted " . ($model->getTable()) . ": " . $entityName);
        });

        static::updated(function ($model) {
            if (isset($model->getDirty()['is_active'])) {
                $model->logActivity('status changed', auth()->user()->name . " changed status of " . ($model->getTable()) . ": " . $model->name);
            }
        });
    }

    /**
     * Log the activity for the model.
     *
     * @param string $action
     * @param string $description
     * @return void
     */
    protected function logActivity($action, $description)
    {
        ActivityLog::create([
            'action' => $action,
            'model_type' => get_class($this),
            'model_id' => $this->id,
            'description' => $description,
            'user_id' => auth()->user()->id,
        ]);
    }
}

