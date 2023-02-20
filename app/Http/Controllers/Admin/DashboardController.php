<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Message;
use App\Models\Property;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {

        // Messages
        $properties = Property::where('user_id', Auth::id())->get();
        $prop_ut = [];

        foreach ($properties as $property) {
            array_push($prop_ut, $property['id']);
        }

        $messages = Message::whereIn('property_id', $prop_ut)->count();

        // Sponsorships
        $sponsorships = DB::table('property_sponsorship')->whereIn('property_id', $prop_ut)->count();


        return view('dashboard', compact('messages', 'sponsorships'));
    }
}
