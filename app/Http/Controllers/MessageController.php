<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\messages;
use App\Events\SendMessage;
class MessageController extends Controller
{
    public function index($id){

                 $users = User::where('is_seller', 0)
                                ->where('is_admin',0)->get();

                return view("messages.MessagesSeller",["id"=>$id,"users"=>$users]);

    }

    public function indexBuyer($id){

                $users = User::where('is_seller', 1)
                                ->where('is_admin',0)->get();
                return view("messages.MessagesBuyer",["id"=>$id,"users"=>$users]);

    }
    public function chat($sellerid,$buyerid){

                $messages = messages::where(function($query) use ($sellerid, $buyerid) {
                    $query->where('senderid', $sellerid)
                          ->where('receiverid', $buyerid);
                })
                ->orWhere(function($query) use ($sellerid, $buyerid) {
                    $query->where('senderid', $buyerid)
                          ->where('receiverid', $sellerid);
                })
                ->orderBy('created_at', 'asc')
                ->get();
                foreach ($messages as $message) {
                    if ($message->receiverid == $sellerid) {
                        $message->is_read = true;
                        $message->save();
                    }
                }
                $buyer=User::find($buyerid);
                return view('messages.ChatSeller',["messages"=>$messages,"id"=>$sellerid,"buyer"=>$buyer]);

    }
    public function chatBuyer($buyerid,$sellerid){

                $messages = messages::where(function($query) use ($sellerid, $buyerid) {
                    $query->where('senderid', $sellerid)
                          ->where('receiverid', $buyerid);
                })
                ->orWhere(function($query) use ($sellerid, $buyerid) {
                    $query->where('senderid', $buyerid)
                          ->where('receiverid', $sellerid);
                })
                ->orderBy('created_at', 'asc')
                ->get();
                foreach ($messages as $message) {
                    if ($message->receiverid == $buyerid) {
                        $message->is_read = true;
                        $message->save();
                    }
                }
                $seller=User::find($sellerid);
                return view('messages.ChatBuyer',["messages"=>$messages,"id"=>$buyerid,"seller"=>$seller]);

    }
    public function selleraddmsg(Request $request){
        $msg=new messages();
        $msg->senderid=$request->sellerid;
        $msg->receiverid=$request->buyerid;
        $msg->message=$request->sellermessage;
        $msg->save();
        event(new SendMessage($msg, 'my-channel' . $msg->receiverid, 'my-event'.$msg->receiverid));
        $messages = messages::where(function($query) use ($msg) {
            $query->where('senderid', $msg->senderid)
                  ->where('receiverid', $msg->receiverid);
        })
        ->orWhere(function($query) use ($msg) {
            $query->where('senderid', $msg->receiverid)
                  ->where('receiverid', $msg->senderid);
        })
        ->orderBy('created_at', 'asc')
        ->get();
        foreach ($messages as $message) {
            if ($message->receiverid == $msg->senderid) {
                $message->is_read = true;
                $message->save();
            }
        }
		return redirect()->route('chat',["sellerid"=>$msg->senderid,"buyerid"=>$msg->receiverid]);

    }
    public function buyeraddmsg(Request $request){
        $msg=new messages();
        $msg->senderid=$request->buyerid;
        $msg->receiverid=$request->sellerid;
        $msg->message=$request->sellermessage;
        $msg->save();
        event(new SendMessage($msg, 'my-channel' . $msg->receiverid, 'my-event'.$msg->receiverid));
        $messages = messages::where(function($query) use ($msg) {
            $query->where('senderid', $msg->senderid)
                  ->where('receiverid', $msg->receiverid);
        })
        ->orWhere(function($query) use ($msg) {
            $query->where('senderid', $msg->receiverid)
                  ->where('receiverid', $msg->senderid);
        })
        ->orderBy('created_at', 'asc')
        ->get();
        foreach ($messages as $message) {
            if ($message->receiverid == $msg->senderid) {
                $message->is_read = true;
                $message->save();
            }
        }
			return redirect()->route('chatBuyer',["buyerid"=>$msg->senderid,"sellerid"=>$msg->receiverid]);
    }

}
