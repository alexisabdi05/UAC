@extends('layout.master')

@section('content')
    <h1 class="text-4xl font-bold">User Profile </h1>
    <h1 class="text-2xl font-semibold">Name: {{ $user->name }}</h1>
    <img src="{{ asset('storage/' . $user->profile_picture_url) }}" alt="">
    <h1 class="text-2xl font-semibold">Hobbies: {{ $user->hobbies }}</h1>
    <h1 class="text-2xl font-semibold">Gender: {{  $user->gender }}</h1> 

    @auth
    @if (auth()->user()->id !== $user->id && !auth()->user()->isFriendWith($user))
        <form action="{{ route('sendFriendRequest', $user->id) }}" method="post">
            @csrf
            <button type="submit">Add Friend</button>
        </form>
    @endif
@endauth
@endsection