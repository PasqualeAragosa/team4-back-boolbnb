<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\StorePropertyRequest;
use App\Http\Controllers\Controller;
use App\Http\Requests\UpdatePropertyRequest;
use App\Models\Property;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class PropertyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $user = Auth::id();
        $properties = Property::orderByDesc('id')->where('user_id', $user)->paginate(8);


        return view('admin.properties.index', compact('properties'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.properties.create');
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

        if ($request->hasFile('image')) {
            $image = Storage::put('uploads', $val_data['image']);
            $val_data['image'] = $image;
        }

        // generate property slug
        $property_slug = Property::generateSlug($val_data['title']);
        $val_data['slug'] = $property_slug;

        // assegnazione del post corrente autenticato user
        $val_data['user_id'] = Auth::id();

        if ($visibility == 1) {
            $val_data['visibility'] = true;
        } else {
            $val_data['visibility'] = false;
        }

        // create property
        Property::create($val_data);

        // redirect
        return to_route('admin.properties.index')->with('message', 'Property added successfully');
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
        if (Auth::id() != $property->user_id) {
            abort(403);
        }
        return view('admin.properties.edit', compact('property'));
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

        if(isset($val_data['address'])) {

            $response = Http::withoutVerifying()->get('https://api.tomtom.com/search/2/geocode/' . $val_data['address'] . ' ' . '.json', [
                'key' => config('services.tomtom.key'),
                'limit' => '1'
            ]);
    
            $coordinates = $response->json();
            // dd($coordinates);
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

        if ($visibility == 1) {
            $property->update(['visibility' => true]);
        } else {
            $property->update(['visibility' => false]);
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

        return to_route('admin.properties.index')->with('message', 'Property deleted successfully');
    }
}
