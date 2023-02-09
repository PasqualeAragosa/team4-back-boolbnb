@extends('layouts.admin')



@section('content')


<div class="container">
    <h1>Messages</h1>

    <table class="table mt-4 table-striped">
        <thead>
            <tr>
                <td>Name</td>
                <td>Email</td>
                <td>Phone</td>
                <td>Property ID</td>
                <td colspan="2">Message</td>
                <td>Actions</td>
            </tr>
        </thead>
        <tbody >
            @forelse ($messages as $message)
                <tr>
                    <td> {{ $message->guest_full_name }} </td>
                    <td> {{ $message->guest_email }} </td>
                    <td> {{ $message->guest_phone_number }} </td>
                    <td> 
                            {{ $message->property_id }}

                    </td>
                    <td colspan="2">{{ $message->content }}</td>
                    <td>
                        <button type="button" class="btn btn-danger btn-md" data-bs-toggle="modal" data-bs-target="#deleteMessage-{{$message->id}}">
                        <i class="fa-solid fa-trash-can"></i>
                        </button>
                    <!-- Modal Body -->
                            <!-- if you want to close by clicking outside the modal, delete the last endpoint:data-bs-backdrop and data-bs-keyboard -->
                            <div class="modal fade" id="deleteMessage-{{$message->id}}" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog" aria-labelledby="modalTitleId-{{$message->id}}" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-sm" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="modalTitleId-{{$message->id}}">Delete message</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            Are you sure, you want to delete the message? The process is irreversible!
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            <form action="{{route('admin.messages.destroy', $message->id)}}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="w-100 btn btn-danger"> CONFIRM
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                </td>                   
                </tr>
                @empty
                <tr class="table-primary">
                    <td scope="row">Sorry no messages to show</td>
                </tr>
                @endforelse
        </tbody>
    </table>
</div>



@endsection