<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Spatie\Activitylog\Models\Activity;
use Illuminate\Support\Carbon;
use DataTables, Auth;

class ActivityLogController extends Controller
{
    public function index()
    {
        return view('activity-log.index');
    }

    public function getActivityLogList()
    {
        $data = Activity::whereDate('created_at', Carbon::today())->orderBy('created_at', 'DESC')->get();

        return Datatables::of($data)
                ->addColumn('description', function($data){
                    return $data->description;
                })
                ->addColumn('created_at', function($data){
                    return $data->created_at->diffForHumans();
                })
                ->addColumn('action', function($data){
                    if (Auth::user()->can('melihat log aktivitas')){
                        return '<div class="table-actions">
                                <a class="btn-show" href="'.url('activity-logs/'.$data->id).'/show"><i class="ik ik-eye f-16 mr-15 text-info"></i></a>
                            </div>';
                    }else{
                        return '';
                    }
                })
                ->rawColumns(['description','created_at','action'])
                ->make(true);
    }
}
