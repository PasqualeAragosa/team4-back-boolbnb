<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Message;
use Illuminate\Support\Facades\Validator;

class MessageController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->all();

        dd($data);

        $validator = Validator::make(
            $data,
            [
                'guest_full_name' => 'required',
                'email' => 'required|email',
                'content' => 'required',
                'guest_phone_number' => 'required',
                'property_id' => 'exists:properties,id'
            ],
        );


        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ]);
        }


        $newMessage  = new Message();
        if (!empty($data['object'])) {
            $newMessage->object = $data['object'];
        }
        $newMessage->guest_full_name = $data['guest_full_name'];
        $newMessage->guest_phone_number = $data['guest_phone_number'];
        $newMessage->content = $data['content'];
        $newMessage->email = $data['email'];
        $newMessage->property_id = $data['property_id'];
        $newMessage->save();

        return response()->json([
            "success" => true
        ]);
    }
}
