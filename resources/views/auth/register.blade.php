@extends('layouts.register')
<link href="{{ asset('frontend/img/smiletech_logo.png') }}" rel="icon">
<form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
    @csrf
    <!-- Name -->
    @section('firstname')
        <x-input-label for="firstname" :value="__('Firstname')" />
        <x-text-input id="firstname" class="form-control" type="text" name="firstname" :value="old('firstname')" required autofocus
            autocomplete="firstname" />
        <x-input-error :messages="$errors->get('firstname')" class="mt-2" />
    @endsection

    @section('middlename')
        <x-input-label for="middlename" :value="__('Middlename')" />
        <x-text-input id="middlename" class="form-control" type="text" name="middlename" :value="old('middlename')"
            autocomplete="middlename" />
        <x-input-error :messages="$errors->get('middlename')" class="mt-2" />
    @endsection

    @section('lastname')
        <x-input-label for="lastname" :value="__('Lastname')" />
        <x-text-input id="lastname" class="form-control" type="text" name="lastname" :value="old('lastname')" required
            autofocus autocomplete="lastname" />
        <x-input-error :messages="$errors->get('lastname')" class="mt-2" />
    @endsection

    @section('username')
        <x-input-label for="username" :value="__('Username')" />
        <x-text-input id="username" class="form-control" type="text" name="username" :value="old('username')" required
            autofocus autocomplete="username" />
        <x-input-error :messages="$errors->get('username')" class="mt-2" />
    @endsection

    <!-- Email Address -->
    @section('email')
        <x-input-label for="email" :value="__('Email')" />
        <x-text-input id="email" class="form-control" type="email" name="email" :value="old('email')" required
            autocomplete="username" />
        <x-input-error :messages="$errors->get('email')" class="mt-2" />
    @endsection

    <!-- Password -->
    @section('password')
        <x-input-label for="password" :value="__('Password')" />

        <x-text-input id="password" class="form-control" type="password" name="password" required
            autocomplete="new-password" />

        <x-input-error :messages="$errors->get('password')" class="mt-2" />
    @endsection

    <!-- Confirm Password -->
    @section('confirm_password')
        <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

        <x-text-input id="password_confirmation" class="form-control" type="password" name="password_confirmation" required
            autocomplete="new-password" />

        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
    @endsection

    @section('attachment')
        <x-input-label for="attachment" :value="__('Medical History')" />
        <x-text-input id="attachment" class="form-control" type="file" name="attachment" required autofocus
            accept=".pdf,.doc,.docx,.jpg,.png,.jpeg" />
        <x-input-error :messages="$errors->get('attachment')" class="mt-2" />
    @endsection

    @section('birthday')
        <x-input-label for="birthday" :value="__('Birthdate')" />
        <x-text-input id="birthday" class="form-control" type="date" name="birthday" :value="old('birthday')" required
            autofocus autocomplete="birthday" />
        <x-input-error :messages="$errors->get('birthday')" class="mt-2" />
    @endsection


    @section('address')
        <x-input-label for="address" :value="__('Home Address')" />
        <x-text-input id="address" class="form-control" type="text" name="address" :value="old('address')" required
            autofocus autocomplete="address" />
        <x-input-error :messages="$errors->get('address')" class="mt-2" />
    @endsection

    @section('contact')
        <x-input-label for="contact" :value="__('Contact Number')" />
        <x-text-input id="contact" class="form-control" type="text" name="contact" :value="old('contact')" required
            autofocus autocomplete="contact" />
        <x-input-error :messages="$errors->get('contact')" class="mt-2" />
    @endsection

    @section('contact_person')
        <x-input-label for="contact_person" :value="__('Contact Person in Case of Emergeny')" />
        <x-text-input id="contact_person" class="form-control" type="text" name="contact_person" :value="old('contact_person')" required
            autofocus autocomplete="contact_person" />
        <x-input-error :messages="$errors->get('contact_person')" class="mt-2" />
    @endsection

    @section('contact_person_number')
        <x-input-label for="contact_person_number" :value="__('Contact Person Phone Number')" />
        <x-text-input id="contact_person_number" class="form-control" type="text" name="contact_person_number" :value="old('contact_person_number')" required
            autofocus autocomplete="contact_person_number" />
        <x-input-error :messages="$errors->get('contact_person_number')" class="mt-2" />
    @endsection

    @section('already')
        <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
            href="{{ route('login') }}">
            {{ __('Already registered?') }}
        </a>
    @endsection

    @section('privacy')
        <input type="checkbox" id="privacyCheckbox">
        I agree to the
        <a href="#" data-bs-toggle="modal" data-bs-target="#privacyModal">
            Privacy Policy
        </a>
    @endsection

    @section('terms')
        <input type="checkbox" id="termsCheckbox">
        I agree to the
        <a href="#" data-bs-toggle="modal" data-bs-target="#termsModal">
            Terms and Conditions
        </a>
    @endsection


    @section('button')
        <x-primary-button class="btn btn-primary btn-block" id="submitButton" disabled>
            {{ __('Register') }}
        </x-primary-button>
    @endsection
</form>
