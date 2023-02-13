<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Property;

class PropertyController extends Controller
{
    public function index()
    {
        return response()->json([
            'success' => true,
            'results' => Property::with(['type', 'amenities', 'sponsorships', 'views', 'messages'])->orderByDesc('id')->paginate(8)
        ]);
    }

    public function show ($slug)
    {
        $property = Property::with('user','type', 'amenities', 'sponsorships', 'views', 'messages')->where('slug', $slug)->first();

        if ($property) {
            return response()->json([
                'success' => true,
                'results' => $property
            ]);
        } else {
            return response()->json([
                'success' => false,
                'results' => 'Property not found'
            ]);
        }

    } 
}
