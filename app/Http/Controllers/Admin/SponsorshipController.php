<?php

namespace App\Http\Controllers\Admin;

use App\Models\Sponsorship;
use App\Http\Requests\StoreSponsorshipRequest;
use App\Http\Requests\UpdateSponsorshipRequest;
use App\Http\Controllers\Controller;
use App\Models\Property;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

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


        $sponsorship = new Sponsorship();
        $sponsorship->id = $request['sponsorship'];
        $duration = 24;

        if ($sponsorship->id == 2) {
            $duration = 72;
        } else if ($sponsorship->id == 3) {
            $duration = 144;
        }

        $start_date = Carbon::now()->toDateTimeString();
        $end_date = date('Y-m-d H:i:s', strtotime($request['start_date'] . ' + ' . $duration . ' hours'));

        if ($request->has('property')) {

            $sponsorship->properties()->attach(
                $request['property'],
                [
                    'start_date' => $start_date,
                    'end_date' => $end_date
                ]
            );
        }

        return redirect()->route('admin.properties.index')->with(["message" => "Congratulazioni! Hai attivato la sponsorizzazione da $duration ore"]);
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
