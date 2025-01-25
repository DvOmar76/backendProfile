<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMessageRequest;
use App\Http\Requests\UpdateMessageRequest;
use App\Http\Resources\MessageResource;
use App\Models\Message;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $messages=MessageResource::collection(Message::all());
        return response()->json([
            'data'=>$messages,
            'message'=>'data returned successfully'
        ]);
    }

    public function store(StoreMessageRequest $request)
    {
        $message=MessageResource::make(Message::create($request->all()));
        return response()->json([
            'data'=>$message,
            'message'=>'message created successfully'
        ]);
    }

    public function destroy(Message $message)
    {
        $data=$message;
       $message->delete();
        return response()->json([
            'data'=>$data,
            'message'=>'message deleted successfully'
        ]);
    }
}
