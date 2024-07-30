<?php

namespace App\Http\Controllers\website;
use App\Helpers\LogActivity;
use Illuminate\Http\Request;
use App\Services\CommentService;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;

class CommentController extends Controller
{
    private $commentService;

    public function __construct(CommentService $commentService)
    {
        $this->commentService = $commentService;
    }
    public function store(Request $request)
    {
        // dd($request->all());
        
        // dd($request->all());

        try {
            $request->validate([
            'name' => 'required',
            'email' => 'required',
            'comment' => 'required',
        ]);
        // dd($request->all());
            // $undefinedVariable; 
            $comment = $this->commentService->addComment($request);
            $notification = array(
                'message' => 'Comment added successfully',
                'alert-type' => 'success'
            );
            LogActivity::addToLog("Comment added successfully",$request);
            // LogActivity::addToLog("Comment appeared successfully",$request);
            return redirect()->back()->with($notification);
        } catch (\Exception $exception) {
            // dd('1');
            // LogActivity::addToLog("Errorrrr",$exception->getMessage());
            Log::error('exceptionn'.$exception->getMessage());
            LogActivity::errorLog("Error occurred: ". $exception->getMessage(),$request);
            // return $exception->getMessage();
            return back();
        }
    }
    public function index(Request $request)
    {
        // dd($request->all());
        try {
            $comments = $this->commentService->getAllComments($request,10);
            if ($request->ajax()) {
                $total_comment_view  = '';
                if ($comments->count() > 0) {
                    foreach ($comments as $comment) {
                        $comment_view = (string)view('dashboard.WebsiteManagement.Comments.single-comment-row', compact('comment'));
                        $total_comment_view = $total_comment_view . $comment_view;
                    }
                } else {
                    $comment_view = (string)view('dashboard.WebsiteManagement.Comments.single-comment-row');
                    $total_comment_view = $total_comment_view . $comment_view;
                }
                return response()->json([
                    'data' => $total_comment_view,
                    'success' => true,
                ]);
            }
            return view('dashboard.WebsiteManagement.Comments.all-comment', compact('comments'));
        
        } catch (\Exception $exception) {
            return $exception->getMessage();
        }
    }
    public function show($slug)
    {
        // dd($slug);
        try {
            $comment = $this->commentService->showComment($slug);
            return view('dashboard.WebsiteManagement.Comments.view-comment', compact('comment'));
        
        } catch (\Exception $exception) {
            return $exception->getMessage();
        }
    }
    public function updateStatus(Request $request)
    {
        // dd($request->all());
        try {
            $comment = $this->commentService->changeStatus($request);
            // return view('dashboard.WebsiteManagement.Comments.view-comment', compact('comment'));
            return response()->json([
                'data' => $comment,
                'success' => true,
            ]);
        
        } catch (\Exception $exception) {
            return $exception->getMessage();
        }
    }


}
