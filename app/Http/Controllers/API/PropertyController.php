<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Property;
use App\Models\Amenity;
use Illuminate\Support\Facades\DB;

class PropertyController extends Controller
{
    public function index()
    {
        return response()->json([
            'success' => true,
            'results' => Property::with(['type', 'amenities', 'sponsorships', 'views', 'messages'])->orderByDesc('id')->paginate(8)
        ]);
    }

    public function show($slug)
    {
        $property = Property::with('user', 'type', 'amenities', 'sponsorships', 'views', 'messages')->where('slug', $slug)->first();

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

    // ricerca appartamenti
    public function searchProperties($lng, $lat, $radius,)
    {


        $properties = Property::with(['type', 'amenities', 'sponsorships', 'views', 'messages'])->get();

        $propertiesInRange = [];

        foreach ($properties as $property) {

            // raggio di ricerca default 20km
            if ($this->haversineGreatCircleDistance($lat, $lng, $property->latitude, $property->longitude) < $radius) {
                array_push($propertiesInRange, $property);
            }
        }

        return json_encode($propertiesInRange);
    }

    public function getAmenities()
    {
        $amenities = Amenity::all();

        return json_encode($amenities);
    }

    public function filteredSearch($lng, $lat, $radius, $rooms, $beds, $amenities)
    {

        $properties = Property::with(['type', 'amenities', 'sponsorships', 'views', 'messages'])->orderByDesc('id')->paginate(8);

        $filteredProperties = [];

        foreach ($properties as $property) {
            $amenities_list = $property->amenities;

            $amenities_ids = [];

            foreach ($amenities_list as $amenity) {
                array_push($amenities_ids, $amenity);
                //dd($amenity->id);
            }

            //dd($amenities_ids);
            //dd($amenities_ids[0]->name);
            //dd($property);
            //dd($amenities_list);

            // raggio di ricerca default 20km
            if ($this->haversineGreatCircleDistance($lat, $lng, $property->latitude, $property->longitude) < $radius && $property->rooms_num >= $rooms && $property->beds_num >= $beds) {

                $amenities_array = explode(',', $amenities);

                foreach ($amenities_ids as $amenity) {
                    //dd('ciao');
                    //dd($amenity->name, $amenities_array);
                    if (in_array($amenity->name, $amenities_array)) {

                        array_push($filteredProperties, $property);
                    }
                }
            }
        }

        //dd($filteredProperties);
        return json_encode($filteredProperties);
    }


    /**
     * Calculates the great-circle distance between two points, with
     * the Haversine formula.
     * @param float $latitudeFrom Latitude of start point in [deg decimal]
     * @param float $longitudeFrom Longitude of start point in [deg decimal]
     * @param float $latitudeTo Latitude of target point in [deg decimal]
     * @param float $longitudeTo Longitude of target point in [deg decimal]
     * @param float $earthRadius Mean earth radius in [m]
     * @return float Distance between points in [m] (same as earthRadius)
     */

    // funzione per calcolare distanza tra due punti
    public function haversineGreatCircleDistance(
        $latitudeFrom,
        $longitudeFrom,
        $latitudeTo,
        $longitudeTo,
        $earthRadius = 6371000
    ) {
        // convert from degrees to radians
        $latFrom = deg2rad($latitudeFrom);
        $lonFrom = deg2rad($longitudeFrom);
        $latTo = deg2rad($latitudeTo);
        $lonTo = deg2rad($longitudeTo);

        $latDelta = $latTo - $latFrom;
        $lonDelta = $lonTo - $lonFrom;

        $angle = 2 * asin(sqrt(pow(sin($latDelta / 2), 2) +
            cos($latFrom) * cos($latTo) * pow(sin($lonDelta / 2), 2)));
        return $angle * $earthRadius;
    }
}
