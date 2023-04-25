<?php
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Admin\User;
use Illuminate\Support\Facades\DB;

class UserController extends Controller {

    public function __construct(){
        //$this->middleware("auth:api");
    }
    /* Get bank info. */
    public function getUserList(Request $request) {

        $userModel = DB::table('user')->leftJoin('channel', 'channel.id', '=','user.channel_id' );
        if($request->phone_number){
            $userModel = $userModel->where('user.phone_number','Like', '%' . $request->phone_number . '%');
        }

        if($request->id_card_name){
            $userModel = $userModel->where('user.id_card_name','Like', '%' . $request->id_card_name . '%');
        }

        if($request->channel_id){
            $userModel = $userModel->where('user.channel_id','=', $request->channel_id);
        }

        $userList = $userModel->select('user.*', 'channel.name')->get()->toArray();
        return response()->json(['success'=>true, 'userList' => $userModel->orderBy('user.created_at', 'desc')->paginate($request->results)]);
    }

    public function getUserById(Request $request) {
        $userModel = DB::table('user')->leftJoin('channel', 'channel.id', '=','user.channel_id' )
        ->where('user.id','=', $request->id)->first();
        return response()->json(['success'=>true, 'user' => $userModel]);
    }

    public function updateUserLoginStatus(Request $request) {
        $data = [];
        $data['login_status'] = $request->login_status;
        $userModel = User::where('id', $request->id)->update($data);
        return response()->json(['success'=>true, 'result' => $userModel]);
    }

    public function updateUserMainInformation(Request $request) {
        $data = [];
        $data['phone_number'] = $request->phone_number;
        $data['login_status'] = $request->login_status;
        $data['status'] = $request->status;
        $data['password'] = $request->password;
        $userModel = User::where('id', $request->id)->update($data);
        return response()->json(['success'=>true, 'result' => $userModel]);
    }

    public function deleteUser(Request $request) {
        $userModel = User::where('id', $request->id)->delete();
        return response()->json(['success'=>true, 'result' => $userModel]);
    }

    public function registerUser(Request $request) {
        $valid = User::where('phone_number', $request->phone_number)->first();
        if ($valid)
            return response()->json(['success'=>false, 'result'=>$valid]);

        $data = [];
        $data['phone_number'] = $request->phone_number;
        $user = new User;
        if ($user->create($data)){
            $result = User::where('phone_number', $request->phone_number)->first();
            return response()->json(['success'=>true, 'result' => $result]);
        }
        return response()->json(['success'=>false]);
    }

    public function updateUser(Request $request) {
        $data = [];
        if($request->id_card_name !== "" && $request->id_card_name !== null )
            $data['id_card_name'] = $request->id_card_name;
        if($request->id_card_number !== "" && $request->id_card_number !== null )
            $data['id_card_number'] = $request->id_card_number;
        if($request->gender !== "" && $request->gender !== null )
            $data['gender'] = $request->gender;
        if($request->current_address !== "" && $request->current_address !== null )
            $data['current_address'] = $request->current_address;
        if($request->login_status !== "" && $request->login_status !== null )
            $data['login_status'] = $request->login_status;
        if($request->bank_card_number !== "" && $request->bank_card_number !== null )
            $data['bank_card_number'] = $request->bank_card_number;
        if($request->bank_account !== "" && $request->bank_account !== null )
            $data['bank_account'] = $request->bank_account;
        if($request->family_relationship !== "" && $request->family_relationship !== null )
            $data['family_relationship'] = $request->family_relationship;
        if($request->family_name !== "" && $request->family_name !== null )
            $data['family_name'] = $request->family_name;
        if($request->family_phone_number !== "" && $request->family_phone_number !== null )
            $data['family_phone_number'] = $request->family_phone_number;
        if($request->friend_relationship !== "" && $request->friend_relationship !== null )
            $data['friend_relationship'] = $request->friend_relationship;
        if($request->friend_name !== "" && $request->friend_name !== null )
            $data['friend_name'] = $request->friend_name;
        if($request->friend_phone_number !== "" && $request->friend_phone_number !== null )
            $data['friend_phone_number'] = $request->friend_phone_number;
        if($request->work_experience !== "" && $request->work_experience !== null )
            $data['work_experience'] = $request->work_experience;
        if($request->work_income !== "" && $request->work_income !== null )
            $data['work_income'] = $request->work_income;
        if($request->work_address !== "" && $request->work_address !== null )
            $data['work_address'] = $request->work_address;
        if($request->loan_way !== "" && $request->loan_way !== null )
            $data['loan_way'] = $request->loan_way;
        if($request->status !== "" && $request->status !== null )
            $data['status'] = $request->status;

        $userModel = User::where('id', $request->id)->update($data);

        $result = User::where('id', $request->id)->first();
        return response()->json(['success'=>true, 'result' => $result]);
    }
}