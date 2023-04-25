<?php
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Admin\Feedback;
use Illuminate\Support\Facades\DB;

class FeedbackController extends Controller {

    public function __construct(){
        //$this->middleware("auth:api");
    }
    /* Get bank info. */
    public function getFeedbackList(Request $request) {
        $feedbackModel = DB::table('feedback');
        $feedbackList = $feedbackModel->get()->toArray();
        return response()->json(['success'=>true, 'feedbackList' => $feedbackModel->orderBy('created_at', 'desc')->paginate($request->results)]);
    }

    public function updateFeedbackStatus(Request $request) {
        $data = [];
        $data['status'] = $request->status;
        $feedbackModel = Feedback::where('id', $request->id)->update($data);
        return response()->json(['success'=>true, 'result' => $feedbackModel]);
    }

    public function deleteFeedback(Request $request) {
        $feedbackModel = Feedback::where('id', $request->id)->delete();
        return response()->json(['success'=>true, 'result' => $feedbackModel]);
    }
}