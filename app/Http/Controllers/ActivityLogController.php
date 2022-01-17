<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Activitylog\Models\Activity;

class ActivityLogController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        try{
            $activityLog = Activity::orderBy('created_at', 'DESC')->paginate(10);
            return view('activity-log.index', compact('activityLog'));
        } catch(\Exception $e){
            $bug = $e->getMessage();
            return $bug;
        }
    }
}
