@extends('layouts.admin')



@section('content')


<ul>
    @forelse($messages as $message)
    <li>
        {{$message->content}}
    </li>
    @empty
    <li>Non funziona</li>
    @endforelse
</ul>



@endsection