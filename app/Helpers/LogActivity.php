<?php


namespace App\Helpers;
// use Request;

use App\Models\ActivityLog;
use Illuminate\Http\Request;



class LogActivity
{


    public static function addToLog($subject,Request $request)
    {
    	$log = [];
    	$log['subject'] = $subject;
    	$log['url'] = $request->fullUrl();
    	$log['method'] = $request->method();
    	$log['ip'] = $request->ip();
    	$log['agent'] = $request->header('user-agent');
    	$log['user_id'] = auth()->check() ? auth()->user()->id : null;
    	ActivityLog::create($log);
    }

	 public static function errorLog($subject,$request)
    {
		// dd('log');
    	$log = [];
    	$log['subject'] = $subject;
		$log['url'] = $request->fullUrl();
    	$log['method'] = $request->method();
    	$log['ip'] = $request->ip();
    	$log['agent'] = $request->header('user-agent');
    	$log['user_id'] = auth()->check() ? auth()->user()->id : null;
    	ActivityLog::create($log);
    }
	



    public static function logActivityLists($request)
    {
		// dd($request->all());
    	return ActivityLog::ApplyFilter($request->only(['search_by_name']))->latest()->get();
    }


}