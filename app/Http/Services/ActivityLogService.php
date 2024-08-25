<?php

namespace App\Http\Services;

use Illuminate\Database\Eloquent\Model;
use PhpParser\Node\Expr\AssignOp\Mod;

class ActivityLogService
{

    /**
     * Event Logs Name
     */

    const ADD_NEW_BALANCE = 'add_new_balance';

    /**
     * Log
     */

    const ADD_NEW_BALANCE_LOG = 'added new balance';

    /**
     * @param Model $causedBy
     * @param Model $performedOn
     * @param $event
     * @param array $properties
     * @param $log
     * @return void
     */
    public function saveLogs(Model $causedBy , Model $performedOn , $event , array $properties , $log)
    {
        activity()
        ->causedBy($causedBy)
        ->performedOn($performedOn)
        ->event($event)
        ->withProperties($properties)
        ->log($log);
    }
}
