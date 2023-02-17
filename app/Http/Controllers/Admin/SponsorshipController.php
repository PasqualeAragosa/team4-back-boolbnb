<?php

namespace App\Http\Controllers\Admin;

use App\Models\Sponsorship;
use App\Http\Requests\StoreSponsorshipRequest;
use App\Http\Requests\UpdateSponsorshipRequest;
use App\Http\Controllers\Controller;
use App\Models\Property;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Braintree\Gateway;


class SponsorshipController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::id();
        $properties = Property::where('user_id', $user)->get();
        $sponsorships = Sponsorship::all();


        return view('admin.sponsorships.index', compact('properties', 'sponsorships',));
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
     * @param  \App\Http\Requests\StoreSponsorshipRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSponsorshipRequest $request)
    {
        $pippo = $request;
        $sponsor = new Sponsorship();

        if ($pippo->has('property_id')) {

            dd($pippo);
            $sponsor->properties()->attach($pippo['property_id']);
        }

        // $pippo = $request;
        // //dd($pippo);
        // $pippo['start_date'] = Carbon::now()->toDateTimeString();
        // $sponsorships = Sponsorship::all();
        // $duration = $sponsorships->duration;
        // $pippo['end_date'] = date('Y-m-d H:i:s', strtotime($pippo['start_date'] . ' + ' . $duration . ' hours'));

        // if ($pippo->has('properties')) {
        //     $sponsor = new Sponsorship();
        //     $sponsor->properties()->attach(array("property_id" => $pippo['property_id'], "start_date" => $pippo['start_date'], "end_date" => $pippo['end_date']));
        // }


        return redirect()->route('admin.properties.index')->with(["message" => "Sponsorizzazione avvenuta con successo!"]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Sponsorship  $sponsorship
     * @return \Illuminate\Http\Response
     */
    public function show(Sponsorship $sponsorship)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Sponsorship  $sponsorship
     * @return \Illuminate\Http\Response
     */
    public function edit(Sponsorship $sponsorship)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateSponsorshipRequest  $request
     * @param  \App\Models\Sponsorship  $sponsorship
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSponsorshipRequest $request, Sponsorship $sponsorship)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Sponsorship  $sponsorship
     * @return \Illuminate\Http\Response
     */
    public function destroy(Sponsorship $sponsorship)
    {
        //
    }
}
