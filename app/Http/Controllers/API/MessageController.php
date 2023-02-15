<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Models\Message;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->all();



        $validator = Validator::make(
            $data,
            [
                'guest_full_name' => 'required',
                'guest_email' => 'required|email',
                'content' => 'required',
                'guest_phone_number' => 'required',
                'property_id' => 'required'
            ],
        );


        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ]);
        }


        $newMessage  = new Message();
        /* if (!empty($data['object'])) {
            $newMessage->object = $data['object'];
        } */
        $newMessage->guest_full_name = $data['guest_full_name'];
        $newMessage->guest_phone_number = $data['guest_phone_number'];
        $newMessage->content = $data['content'];
        $newMessage->guest_email = $data['guest_email'];
        $newMessage->property_id = $data['property_id'];
        $newMessage->save();

        return response()->json([
            "success" => true,
            "data" => $newMessage
        ]);
    }
}
