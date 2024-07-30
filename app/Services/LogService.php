<?php

namespace App\Services;

use App\Models\Blog;
use App\Models\Image;
use App\Models\Navbar;
use App\Models\Category;
use App\Models\ActivityLog;
use App\Helpers\LogActivity;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\File;


class LogService
{
   public function addLogs($subject,$request)
   {
    LogActivity::addToLog($subject,$request);
   }
   public function getLogs($request)
   {
		// dd($request->all());
      $logs = LogActivity::logActivityLists($request);
      return $logs;
   }
   public function getSingleLog($id)
   {
      $logs = ActivityLog::find($id);
      return $logs;
   }
   public function deleteLog($id)
   {
      $logs = ActivityLog::find($id);
      $logs->delete();
      return $logs;
   }
}
