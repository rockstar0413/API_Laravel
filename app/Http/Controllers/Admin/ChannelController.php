<?php
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Admin\Channel;
class ChannelController extends Controller {

    public function __construct(){
        //$this->middleware("auth:api");
    }
    /* Get bank info. */
    public function getChannelList(Request $request) {
        $channelList = Channel::all();
        return response()->json(['success'=>true, 'channelList' => $channelList]);
    }

    public function updateChannel(Request $request) {
        $channel = Channel::where('channel_id', $request->channel_id)->where('id','!=', $request->id)->first();
        if ($channel)
            return response()->json(['success'=>false, 'message'=>'Channel ID already exists.']);

        $data = [];
        $data['channel_id'] = $request->channel_id;
        $data['name'] = $request->name;
        $data['promotion'] = "卡卡优选：http://h1.isvflf.cn/#/pages/login/login/?apk_id=1&tg_id=".$request->channel_id."\n"
                            ."99钱包：http://h1.isvflf.cn/#/pages/login/login/?apk_id=2&tg_id=".$request->channel_id."\n"
                            ."好招分期：http://h1.isvflf.cn/#/pages/login/login/?apk_id=3&tg_id=".$request->channel_id."\n";
        $channelModel = Channel::where('id', $request->id)->update($data);
        return response()->json(['success'=>true, 'result' => $channelModel]);
    }

    public function addChannel(Request $request) {
        $valid = Channel::where('channel_id', $request->channel_id)->first();
        if ($valid)
            return response()->json(['success'=>false, 'message'=>'Channel ID already exists.']);

        $data = [];
        $data['channel_id'] = $request->channel_id;
        $data['name'] = $request->name;
        $data['promotion'] = "卡卡优选：http://h1.isvflf.cn/#/pages/login/login/?apk_id=1&tg_id=".$request->channel_id."\n"
                            ."99钱包：http://h1.isvflf.cn/#/pages/login/login/?apk_id=2&tg_id=".$request->channel_id."\n"
                            ."好招分期：http://h1.isvflf.cn/#/pages/login/login/?apk_id=3&tg_id=".$request->channel_id."\n";
        $channel = new Channel;
        if ($channel->create($data)){
            return response()->json(['success'=>true]);
        }
        return response()->json(['success'=>false]);
    }
}