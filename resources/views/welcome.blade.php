@extends('layouts.app')
@section('content')

<div class="welcome" style="height: 350px"></div>
<div class="welcome-body">
    <div class="container">
        <div class="title text-center p-5">
            <h1 class="text-orange">Sell on BoolBnb</h1>
        </div>
        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4 pb-5">
            <div class="col">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body">
                        <h4 class="card-title text-orange">An experienced guest for your first booking</h4>
                        <p class="card-text">For your first booking, you can choose to welcome an experienced guest who has at least three stays and a good track record on BoolBnb.</p>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body">
                        <h4 class="card-title text-orange">Specialized support from BoolBnb</h4>
                        <p class="card-text">New Hosts get one-tap access to specially trained Community Support agents who can help with everything from account issues to billing support.</p>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body">
                        <h4 class="card-title text-orange">One-to-one guidance from a Superhost</h4>
                        <p class="card-text">We'll match you with a Superhost in your area, who'll guide you from your first question to your first guest—by phone, video call, or chat.</p>
                    </div>
                </div>
            </div>
        </div>
    
        <div id="carousel" class="carousel slide my-5" data-bs-ride="carousel">
            <h2 class="text-orange text-center">Your questions, answered</h2>
            <div class="carousel-inner">
                <div class="carousel-item active p-md-5" data-bs-interval="4000">
                    <img src="/images/slider_back.png" class="d-block w-100 position-relative" alt="...">
                    <div class="carousel-caption p-md-5">
                        <div class="content-caption d-flex align-items-center p-md-5 h-100">
                           <div class="col image d-none d-md-block p-3">
                            <img src="/images/flat_1.png" class="img-fluid" alt="">
                           </div>
                           <div class="col text text-black p-3">
                               <h5>Do I have to host all the time?</h5>
                               <p> Not at all—you control your calendar. You can host once a year, a few nights a month, or more often.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="carousel-item active p-md-5" data-bs-interval="4000">
                    <img src="/images/slider_back.png" class="d-block w-100 position-relative" alt="...">
                    <div class="carousel-caption p-md-5">
                       <div class="content-caption d-flex align-items-center p-md-5 h-100">
                            <div class="col image d-none d-md-block p-3">
                               <img src="/images/cottage_1.png" class="img-fluid" alt="">
                            </div>
                            <div class="col text text-black p-3">
                               <h5>Any tips on being a great Host?</h5>
                               <p>Getting the basics down goes a long way. Keep your place clean, respond to guests promptly, and provide necessary amenities, like fresh towels. Some Hosts like adding a personal touch.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="carousel-item active p-md-5" data-bs-interval="4000">
                    <img src="/images/slider_back.png" class="d-block w-100 position-relative" alt="...">
                    <div class="carousel-caption p-md-5">
                        <div class="content-caption d-flex align-items-center p-md-5 h-100">
                            <div class="col image d-none d-md-block p-3">
                               <img src="/images/baita_1.png" class="img-fluid" alt="">
                            </div>
                            <div class="col text text-black p-3">
                                <h5>Is my place right for Airbnb?</h5>
                                <p>Airbnb guests are interested in all kinds of places. We have listings for tiny homes, cabins, treehouses, and more. Even a spare room can be a great place to stay.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carousel" data-bs-slide="prev">
              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carousel" data-bs-slide="next">
              <span class="carousel-control-next-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>
</div>
@endsection
