@extends('layout.master')
@section('content')
    <!-- component -->
    <div class="bg-grey-lighter min-h-screen flex flex-col">
        <div class="container w-30 p-3 mx-auto flex-1 flex flex-col items-center justify-center px-4">
            <div class="bg-white px-30 py-20 rounded shadow-md text-black w-full">
                <h1 class="mb-8 text-3xl text-center">Sign up</h1>
                <form action="/register" method="POST">
                    @csrf

                    <label for="name">Name:</label>
                    <input type="text" name="name" value="{{ old('name') }}">
                    @error('name')
                        <br>
                        <span class="error">{{ $message }}</span>
                    @enderror
                    <br>

                    <label for="email">Email:</label>
                    <input type="email" name="email" value="{{ old('email') }}">
                    @error('email')
                        <br>
                        <span class="error">{{ $message }}</span>
                    @enderror
                    <br>

                    <label for="password">Password:</label>
                    <input type="password" name="password">
                    @error('password')
                        <br>
                        <span class="error">{{ $message }}</span>
                    @enderror
                    <br>

                    <label for="gender">Gender:</label>
                    <select name="gender">
                        <option value="Male" @if(old('gender') == 'Male') selected @endif>Male</option>
                        <option value="Female" @if(old('gender') == 'Female') selected @endif>Female</option>
                    </select>
                    @error('gender')
                        <br>
                        <span class="error">{{ $message }}</span>
                    @enderror
                    <br>

                    <label for="hobbies">Hobbies:</label>
                    <br>
                    <input type="text" name="hobbies[]" value="{{ old('hobbies.0') }}">
                    <input type="text" name="hobbies[]" value="{{ old('hobbies.1') }}">
                    <input type="text" name="hobbies[]" value="{{ old('hobbies.2') }}">
                    @error('hobbies')
                        <br>
                        <span class="error">{{ $message }}</span>
                    @enderror
                    <br>

                    <label for="instagram_username">Instagram Username:</label>
                    <input type="text" name="instagram_username" value="{{ old('instagram_username') }}">
                    @error('instagram_username')
                        <br>
                        <span class="error">{{ $message }}</span>
                    @enderror
                    <br>

                    <label for="mobile_number">Mobile Number:</label>
                    <input type="tel" name="mobile_number" value="{{ old('mobile_number') }}">
                    @error('mobile_number')
                        <br>
                        <span class="error">{{ $message }}</span>
                    @enderror
                    <br>

                    <label for="casual_friends">Looking for Casual Friends:</label>
                    <input type="checkbox" name="casual_friends" value="1" @if(old('casual_friends') == 1) checked @endif>
                    @error('casual_friends')
                        <br>
                        <span class="error">{{ $message }}</span>
                    @enderror
                    <br>

                    <label for="price">Registration Price: IDR {{ $registrationPrice }}</label>
                    <input type="hidden" name="registration_price" value="{{ $registrationPrice }}">
                    <br>

                    <div class="text-center">
                        <button type="submit" class="text-xl">Register</button>
                    </div>
                </form>


                {{-- <div class="text-grey-dark mt-6">
                    Already have an account?
                    <a class="no-underline border-b border-blue text-blue" href="../login/">
                        Log in
                    </a>.
                </div> --}}
            </div>
        </div>
    @endsection
