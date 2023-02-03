@extends('layouts.admin')



@section('content')

<div class="table-responsive">
    <h1>Properties</h1>
    <a class="btn btn-info mb-3" href="{{route('admin.properties.create')}}" role="button">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-lg" viewBox="0 0 16 16">
            <path fill-rule="evenodd" d="M8 2a.5.5 0 0 1 .5.5v5h5a.5.5 0 0 1 0 1h-5v5a.5.5 0 0 1-1 0v-5h-5a.5.5 0 0 1 0-1h5v-5A.5.5 0 0 1 8 2Z" />
        </svg>
    </a>
    @include('partials.message')
    <table class="table table-striped
    table-hover	
    table-borderless
    table-primary
    align-middle">
        <thead class="table-light">
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Slug</th>
                <th>Price</th>
                <th>Rooms_num</th>
                <th>Beds_num</th>
                <th>Baths_num</th>
                <th>Square_meters</th>
                <th>Street</th>
                <th>City</th>
                <th>State</th>
                <th>Image</th>
                <th>Description</th>
                <th>Visibility</th>
                <th>Longitude</th>
                <th>Latitude</th>
            </tr>
        </thead>
        <tbody class="table-group-divider">
            @foreach($properties as $property)
            <tr class="table-primary">
                <td>{{$property->id}}</td>
                <td scope="row">{{$property->title}}</td>
                <td>{{$property->slug}}</td>
                <td>{{$property->price}}</td>
                <td>{{$property->rooms_num}}</td>
                <td>{{$property->beds_num}}</td>
                <td>{{$property->baths_num}}</td>
                <td>{{$property->square_meters}}</td>
                <td>{{$property->street}}</td>
                <td>{{$property->city}}</td>
                <td>{{$property->state}}</td>
                <td> @if($property->image)
                    <img class="img-fluid" width="180" src="{{asset('storage/' . $property->image)}}" alt="">
                    @else
                    <div class="placeholders p-5 bg-secondary" width="140">Placeholders</div>
                    @endif
                </td>
                <td>{{$property->description}}</td>
                <td>{{$property->visibility}}</td>
                <td>{{$property->longitude}}</td>
                <td>{{$property->latitude}}</td>
                <td class="Actions">

                    <!-- Show -->
                    <a href="#" class="btn btn-primary">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                            <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z" />
                            <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z" />
                        </svg>
                    </a>
                    <!-- /.Show -->

                    <!-- Create -->
                    <a href="#" class="btn btn-secondary my-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                            <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                            <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
                        </svg>
                    </a>

                    <!-- /.Create -->

                    <!-- Delete -->


                    <!-- Modal trigger button -->
                    <button type="button" class="btn btn-danger btn-md" data-bs-toggle="modal" data-bs-target="#deleteProperty-{{$property->slug}}">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16">
                            <path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5ZM11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H2.506a.58.58 0 0 0-.01 0H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1h-.995a.59.59 0 0 0-.01 0H11Zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5h9.916Zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47ZM8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5Z" />
                        </svg>
                    </button>

                    <!-- Modal Body -->
                    <!-- if you want to close by clicking outside the modal, delete the last endpoint:data-bs-backdrop and data-bs-keyboard -->
                    <div class="modal fade" id="deleteProperty-{{$property->slug}}" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog" aria-labelledby="modalTitleId-{{$property->slug}}" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-sm" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="modalTitleId-{{$property->slug}}">Delete Property</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    Stai per effettuare un operazione di cancellazione, sei sicuro?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <form action="#" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">
                                            Delete
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Optional: Place to the bottom of scripts -->
                    <script>
                        const myModal = new bootstrap.Modal(document.getElementById('modalId'), options)
                    </script>
                    <!-- /.Delete -->
                </td>
                @endforeach
            </tr>
        </tbody>
    </table>
</div>

{{ $properties->links('vendor.pagination.bootstrap-5') }}

@endsection