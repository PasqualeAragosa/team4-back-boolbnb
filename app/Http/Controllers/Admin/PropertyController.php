<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\StorePropertyRequest;
use App\Http\Controllers\Controller;
use App\Http\Requests\UpdatePropertyRequest;
use App\Models\Property;
use App\Models\Amenity;
use App\Models\Type;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;

class PropertyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        // GET USER->PROPERTY
        $properties = Property::orderByDesc('id')->where('user_id', Auth::id())->get();

        // GET USER->PROPERTY->ID
        $arrayGetPropertyUser = [];
        $getPropertyUser = Property::where('user_id', Auth::id())->get();
        foreach ($getPropertyUser as $value) {
            array_push($arrayGetPropertyUser, $value->id);
        }

        // GET PROPERTY->ID->SPONSORORED
        $arrayPivotProperty = [];
        $pivotProperty = DB::table('property_sponsorship')->pluck('property_id');
        foreach ($pivotProperty as $value) {
            array_push($arrayPivotProperty, $value);
        }

        // GET USER->PROPERTY->ID->SPONSORORED
        $propertySponsored = array_intersect($arrayGetPropertyUser, $arrayPivotProperty);

        // GET USER->PROPERTY->ID without USER->PROPERTY->ID->SPONSORORED
        $propertiesWithoutSponsorship = array_diff($arrayGetPropertyUser, $propertySponsored);
        $propertiesWithoutSponsorship = array_values($propertiesWithoutSponsorship);

        // GET PROPERTY->SPONSORED & PROPERTY->NOT_SPONSORED
        $hasSponsored = [];
        $hasNoSponsored = [];
        foreach ($properties as $property) {

            foreach ($propertiesWithoutSponsorship as $value) {

                if ($property->id == $value) {
                    array_push($hasNoSponsored, $property);
                }
            }

            foreach ($propertySponsored as $value) {

                if ($property->id == $value) {
                    array_push($hasSponsored, $property);
                }
            }
        }

        // GET SPONSORSHIP->ID
        $arrayPivotSponsorship = [];
        $pivotSponsorship = DB::table('property_sponsorship')->pluck('sponsorship_id');
        foreach ($pivotSponsorship as $value) {
            array_push($arrayPivotSponsorship, $value);
        }
        //dd($arrayPivotSponsorship);

        return view('admin.properties.index', compact('properties', 'hasNoSponsored', 'hasSponsored', 'pivotProperty', 'pivotSponsorship'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $amenities = Amenity::all();
        $types = Type::all();

        return view('admin.properties.create', compact('amenities', 'types'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePropertyRequest  
     * @return \Illuminate\Http\Response
     */
    public function store(StorePropertyRequest $request)
    {
        $val_data = $request->validated();
        $visibility = $request->boolean('visibility');

        // TOM TOM
        $response = Http::withoutVerifying()->get('https://api.tomtom.com/search/2/geocode/' . $val_data['address'] . ' ' . '.json', [
            'key' => config('services.tomtom.key'),
            'limit' => '1'
        ]);

        $coordinates = $response->json();
        //dd($coordinates);
        $val_data['latitude'] = $coordinates['results'][0]['position']['lat'];
        $val_data['longitude'] = $coordinates['results'][0]['position']['lon'];
        // dd($response);

        // image
        if ($request->hasFile('image')) {
            $image = Storage::put('uploads', $val_data['image']);
            $val_data['image'] = $image;
        }

        // generate property slug
        $property_slug = Property::generateSlug($val_data['title']);
        $val_data['slug'] = $property_slug;

        // assegnazione del post corrente autenticato user
        $val_data['user_id'] = Auth::id();

        // visibility
        if ($visibility == 1) {
            $val_data['visibility'] = true;
        } else {
            $val_data['visibility'] = false;
        }

        // create property
        $property = Property::create($val_data);


        // attach the selected amenities
        if ($request->has('amenities')) {

            $property->amenities()->attach($val_data['amenities']);
        }

        // redirect
        return to_route('admin.properties.index')->with('message', "Property id: $property->id added successfully");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Property  $property
     * @return \Illuminate\Http\Response
     */
    public function show(Property $property)
    {
        if (Auth::id() != $property->user_id) {
            abort(403);
        }
        return view('admin.properties.show', compact('property'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Property  $property
     * @return \Illuminate\Http\Response
     */
    public function edit(Property $property)
    {
        $amenities = Amenity::all();
        $types = Type::all();

        if (Auth::id() != $property->user_id) {
            abort(403);
        }
        return view('admin.properties.edit', compact('property', 'amenities', 'types'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePropertyRequest  $request
     * @param  \App\Models\Property  $property
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePropertyRequest $request, Property $property)
    {
        $val_data = $request->validated();
        $visibility = $request->boolean('visibility');

        if (isset($val_data['address'])) {

            $response = Http::withoutVerifying()->get('https://api.tomtom.com/search/2/geocode/' . $val_data['address'] . ' ' . '.json', [
                'key' => config('services.tomtom.key'),
                'limit' => '1'
            ]);

            $coordinates = $response->json();
            //dd($coordinates);
            if ($coordinates['results'] == null) {
                abort(404);
            }

            $val_data['latitude'] = $coordinates['results'][0]['position']['lat'];
            $val_data['longitude'] = $coordinates['results'][0]['position']['lon'];

            // dd($response);
        }

        // check if the request has a image field
        if ($request->hasFile('image')) {
            // check if the current property has an image if yes, delete it
            if ($property->image) {
                Storage::delete($property->image);
            }
            $image = Storage::put('uploads', $val_data['image']);
            // replace the value of image inside $val_data
            $val_data['image'] = $image;
        }

        // update property slug
        $property_slug = Property::generateSlug($val_data['title']);
        $val_data['slug'] = $property_slug;

        //update the visibility
        if ($visibility == 1) {
            $property->update(['visibility' => true]);
        } else {
            $property->update(['visibility' => false]);
        }

        // update the selected amenities
        if ($request->has('amenities')) {
            $property->amenities()->sync($val_data['amenities']);
        } else {
            $property->amenities()->sync([]);
        }

        // update resource
        $property->update($val_data);

        return to_route('admin.properties.index')->with('message', "Property id: $property->id updated successfully");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Property  $property
     * @return \Illuminate\Http\Response
     */
    public function destroy(Property $property)
    {
        if ($property->image) {
            Storage::delete($property->image);
        }

        $property->delete();

        return to_route('admin.properties.index')->with('message', "Property id: $property->id deleted successfully");
    }
}
