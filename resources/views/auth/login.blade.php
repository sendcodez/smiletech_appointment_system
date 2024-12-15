@extends('layouts.login')
<link href="{{ asset('frontend/img/smiletech_logo.png') }}" rel="icon">

<!-- Session Status -->

<form method="POST" action="{{ route('login') }}">
    @csrf

    <!-- Login Field (Email or Username) -->
    @section('login')
        <label for="login" class="form-label"></label>
        <x-text-input id="login" class="form-control" type="text" name="login" :value="old('login')" required autofocus
            placeholder="Enter your email or username" />
    @endsection


    <!-- Password -->
    @section('password')
        <label for="password" class="form-label"></label>
        <x-text-input id="password" class="form-control" type="password" name="password" required
            autocomplete="current-password" />
    @endsection

    <!-- Forgot Password -->
    @section('forgot')
        @if (Route::has('password.request'))
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                href="{{ route('password.request') }}">
                {{ __('Forgot your password?') }}
            </a>
        @endif
    @endsection

    <!-- Submit Button -->
    @section('button')
        <x-primary-button class="btn btn-primary btn-block">
            {{ __('Log in') }}
        </x-primary-button>
    @endsection
</form>
