<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/* Admin controllers. */
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\Admin\FeedbackController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\ChannelController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\SystemSetting\SystemParametersController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

/* Admin routes. */
Route::group(['prefix'=>'admin', 'middleware'=>'CORS'], function ($router) {
    /* Authentication */
    Route::post('/login', [AuthController::class, 'login'])->name('admin.auth.login');
    Route::post('/register', [AuthController::class, 'register'])->name('admin.auth.register');
    Route::get('/userList', [UserController::class, 'getUserList'])->name('admin.user.getUserList');
    Route::post('/registerUser', [UserController::class, 'registerUser'])->name('admin.user.registerUser');
    Route::get('/getUserById', [UserController::class, 'getUserById'])->name('admin.user.getUserById');
    Route::put('/updateUser', [UserController::class, 'updateUser'])->name('admin.user.updateUser');
    Route::put('/updateUserLoginStatus', [UserController::class, 'updateUserLoginStatus'])->name('admin.user.updateUserLoginStatus');
    Route::put('/updateUserMainInformation', [UserController::class, 'updateUserMainInformation'])->name('admin.user.updateUserMainInformation');
    Route::delete('/deleteUser', [UserController::class, 'deleteUser'])->name('admin.user.deleteUser');
    Route::get('/channelList', [ChannelController::class, 'getChannelList'])->name('admin.channel.getChannelList');
    Route::post('/addChannel', [ChannelController::class, 'addChannel'])->name('admin.channel.addChannel');
    Route::put('/updateChannel', [ChannelController::class, 'updateChannel'])->name('admin.channel.updateChannel');
    Route::get('/orderList', [OrderController::class, 'getOrderList'])->name('admin.channel.getOrderList');
    Route::post('/makeOrder', [OrderController::class, 'makeOrder'])->name('admin.channel.makeOrder');
    Route::put('/updateOrder', [OrderController::class, 'updateOrder'])->name('admin.channel.updateOrder');
    Route::put('/updateAppStatus', [OrderController::class, 'updateAppStatus'])->name('admin.channel.updateAppStatus');
    Route::put('/updateOrderInsurance', [OrderController::class, 'updateOrderInsurance'])->name('admin.channel.updateOrderInsurance');
    Route::get('/feedbackList', [FeedbackController::class, 'getFeedbackList'])->name('admin.feedback.getFeedbackList');
    Route::put('/updateFeedbackStatus', [FeedbackController::class, 'updateFeedbackStatus'])->name('admin.feedback.updateFeedbackStatus');
    Route::delete('/deleteFeedback', [FeedbackController::class, 'deleteFeedback'])->name('admin.feedback.deleteFeedback');
    Route::get('/adminUserList', [AdminUserController::class, 'getAdminUserList'])->name('admin.adminuser.getAdminUserList');
    Route::put('/updateAdminUser', [AdminUserController::class, 'updateAdminUser'])->name('admin.adminuser.updateAdminUser');
});