@extends('layout.master')

@section('content')
    <h1 class="text-4xl text-center font-bold">Welcome to our Home Page</h1>

    <div class="flex justify-center mb-4">
        <input type="text" id="searchInput" placeholder="Search by name...">
        <select id="genderFilter">
            <option value="">All Genders</option>
            <option value="Male">Male</option>
            <option value="Female">Female</option>
        </select>
        <button id="filterButton">Filter</button>
    </div>
    

    <div class="flex flex-wrap justify-center">
        @foreach($users as $user)
            <div class="m-4 bg-zinc-300 user-card" data-user-id="{{ $user->id }}>
                <a href="{{ Auth::check() ? route('user.show', $user->id) : route('login') }}">
                    <img src="{{ asset('storage/' . $user->profile_picture_url) }}" alt="{{ $user->name }}" class="auto h-64">
                </a>
                <h1 class="text-center text-2xl font-semibold">{{ $user->name }}</h1>
                <h1 class="text-center text-2xl font-semibold">{{ $user->hobbies }}</h1>
                <h1 class="text-center text-2xl font-semibold">{{ $user->gender }}</h1>
            </div>
        @endforeach
    </div>

    <script>
      document.addEventListener('DOMContentLoaded', function () {
    const searchInput = document.getElementById('searchInput');
    const genderFilter = document.getElementById('genderFilter');
    const filterButton = document.getElementById('filterButton');

    filterButton.addEventListener('click', function () {
        filterUsers();
    });

    searchInput.addEventListener('keyup', function (event) {
        if (event.key === 'Enter') {
            filterUsers();
        }
    });

    function filterUsers() {
        const searchTerm = searchInput.value.toLowerCase();
        const selectedGender = genderFilter.value.toLowerCase();

        const users = document.querySelectorAll('.user-card');

        users.forEach(function (user) {
            const userId = user.getAttribute('data-user-id');
            const userName = user.querySelector('.user-name').innerText.toLowerCase();
            const userGender = user.querySelector('.user-gender').innerText.toLowerCase();

            if ((searchTerm === '' || userName.includes(searchTerm)) && (selectedGender === '' || userGender === selectedGender)) {
                user.style.display = 'block';
            } else {
                user.style.display = 'none';
            }
        });
    }
});
    </script>
@endsection