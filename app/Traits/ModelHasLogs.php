<?php

namespace App\Traits;


use App\Models\Activity;
use Spatie\Activitylog\Traits\LogsActivity;

trait ModelHasLogs
{
    use  LogsActivity;


    /**
     * @logFillable bool
     *  log changes to all the $fillable attributes of the model.
     */
    protected static $logFillable = true;
    /**
     * @logName string
     * Specify $logName to make the model use another name than the default.
     */
    protected static $logName = __CLASS__;

    /**
     * @logOnlyDirty bool
     * Specify $logName to make the model use another name than the default.
     */
    protected static $logOnlyDirty = true;

    /**
     * @submitEmptyLogs bool
     * Prevent save logs items that have no changed attribute
     * Setting $submitEmptyLogs to false prevents the package from storing empty logs.
     * Storing empty logs can happen when you only want to log a certain attribute but only another changes.
     */
    protected static $submitEmptyLogs = false;

    /**
     * @recordEvents array
     * By default the package will log the created, updated, deleted events. You can modify this behaviour by setting the $recordEvents property on a model.
     */
    //   protected static $recordEvents = ['created', 'updated', 'deleted'];


//    /**
//     * @logAttributes string|array|null
//     * log the changed attributes for all these events when setting $logAttributes property on the model.
//     * The attributes that need to be logged can be defined either by their name or you can put in a wildcard '*' to log any attribute that has changed.
//     */
//    protected static $logAttributes =['*'];
//
//    /**
//     * @param Activity $activity
//     * @param string $eventName
//     * Tap Activity before logged from event
//     * In addition to the tap() method on ActivityLogger you can utilise the tapActivity() method in your observed model class. This method will allow you to fill properties and add custom fields before the activity is saved.
//     */
//    public function tapActivity(Activity $activity, string $eventName)
//    {
//        $activity->log_name = __CLASS__ . "  {$eventName}";
//    }
}

