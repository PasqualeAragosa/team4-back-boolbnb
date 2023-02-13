<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
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

    public function search(Request $request){
        $location = $request->input('location');

        $geocoded = Http::withoutVerifying()->get('https://api.tomtom.com/search/2/geocode/'. $location .'.json', [
            'key' => config('services.tomtom.key'),
            'limit' => '1'
        ]);

       
        $lat = $geocoded['results'][0]['position']['lat'];
        $lon = $geocoded['results'][0]['position']['lon'];
        
        $properties = Property::all();

        $filtered = [];
        foreach($properties as $property) {
            $distance = self::getDistance($lat, $lon, $property->latitude, $property->longitude);
            if($distance <= 20000) {
                array_push($filtered, $property);
            };
        }

        return compact('filtered', 'lat', 'lon');
    }


    protected function getDistance($lat1, $lon1, $lat2, $lon2) {

        $R = 6371000;

        $lat1 = round($lat1 * (M_PI / 180), 14);
        $lat2 = round($lat2 * (M_PI / 180), 14);

        $deltaLat = round(($lat2-$lat1) * (M_PI / 180), 14);
        $deltaLon = round(($lon2-$lon1) * (M_PI / 180), 14);
        
        //$d = asin( sin($lat1)*sin($lat2) + cos($lat1)*cos($lat2) * cos($deltaLon) ) * $R;
        $a = pow(sin($deltaLat/2), 2) + cos($lat1) * cos($lat2) * pow(sin($deltaLon/2), 2);
        $c = 2 * atan2(sqrt($a),sqrt(1-$a));

        $d = $R * $c;

        return $d;
    }
}
