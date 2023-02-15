<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\StoreMessageRequest;
use App\Http\Requests\UpdateMessageRequest;
use App\Models\Message;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Property;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;


class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $properties = Property::where('user_id', Auth::id())->get();
        $prop_ut = [];

        foreach ($properties as $property) {
            array_push($prop_ut, $property['id']);
        }

        $messages = Message::whereIn('property_id', $prop_ut)->get();
        //dd($messages);

        return view('admin.messages.index', compact('messages', 'properties'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreMessageRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreMessageRequest $request)
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


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function show(Message $message)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function edit(Message $message)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateMessageRequest  $request
     * @param  \App\Models\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateMessageRequest $request, Message $message)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function destroy(Message $message)
    {
        //
    }
}
