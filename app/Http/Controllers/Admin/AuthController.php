<?php
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use App\Models\Admin\AdminUser;

class AuthController extends Controller {

    /* Login action. */
    public function login(Request $request) {
        $name = $request->input('name');
        $password = $request->input('password');

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:50',
            'password' => 'required'
        ]);

        if ($validator->fails())
            return response()->json(['success'=>false, 'message'=>$validator->messages()->toArray()]);

        if (!auth()->guard('admin')->attempt(compact('name', 'password'))) {
            auth()->guard('admin')->logout();
            return response()->json(['success'=>false, 'message'=>'Your credentials are incorrect.']);
        }

        $accessToken = auth()->guard('admin')->user()->createToken('adminToken')->accessToken;
        return $this->respondWithToken($accessToken, 'Login successfully.', auth()->guard('admin')->user());
    }


    /* Register action. */
    public function register(Request $request) {
        $name = $request->input('name');
        $password = $request->input('password');

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:50',
            'password' => 'required'
        ]);

        if ($validator->fails())
            return response()->json(['success'=>false, 'message'=>$validator->messages()->toArray()]);

        $user = AdminUser::where('name', $name)->first();
        if ($user)
            return response()->json(['success'=>false, 'message'=>'Your name already exists.']);

        $user = new AdminUser;
        $user->name = $name;
        $user->password = Hash::make($password);

        if ($user->save())
            return response()->json(['success'=>true, 'message'=>'Register successfully.']);
        else
            return response()->json(['success'=>false, 'message'=>'Register operation failure.']);
    }

    /* Get user info. */
    public function user(Request $request) {
        return $request->user();
    }
}