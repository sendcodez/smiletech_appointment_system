@extends('layouts.register')
<link href="{{ asset('frontend/img/smiletech_logo.png') }}" rel="icon">
<form method="POST" action="{{ route('register') }}" enctype="multipart/form-data" id="registrationForm">
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

    @section('birthday')
        <x-input-label for="birthday" :value="__('Birthdate')" />
        <x-text-input id="birthday" class="form-control" type="date" name="birthday" :value="old('birthday')" required
            autofocus autocomplete="birthday" />
        <x-input-error :messages="$errors->get('birthday')" class="mt-2" />
        <span class="text-danger" id="birthdayError" style="display: none; font-size: 0.875rem;"></span>
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
            autofocus autocomplete="contact" maxlength="11" inputmode="numeric" placeholder="09191234567" />

        @error('contact')
            <span class="invalid-feedback d-block" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
        <span class="text-danger" id="contactError" style="display: none; font-size: 0.875rem;"></span>
    @endsection

    @section('contact_person')
        <x-input-label for="contact_person" :value="__('Contact Person in Case of Emergency')" />
        <x-text-input id="contact_person" class="form-control" type="text" name="contact_person" :value="old('contact_person')"
            required autofocus autocomplete="contact_person" />
        <x-input-error :messages="$errors->get('contact_person')" class="mt-2" />
    @endsection

    @section('contact_person_number')
        <x-input-label for="contact_person_number" :value="__('Contact Person Phone Number')" />
        <x-text-input id="contact_person_number" class="form-control" type="text" name="contact_person_number"
            :value="old('contact_person_number')" required autofocus autocomplete="contact_person_number" maxlength="11" inputmode="numeric"
            placeholder="09191234567" />
        @error('contact_person_number')
            <span class="invalid-feedback d-block" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
        <span class="text-danger" id="contactPersonError" style="display: none; font-size: 0.875rem;"></span>
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

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const contactInput = document.getElementById('contact');
        const contactPersonInput = document.getElementById('contact_person_number');
        const contactError = document.getElementById('contactError');
        const contactPersonError = document.getElementById('contactPersonError');
        const birthdayInput = document.getElementById('birthday');
        const birthdayError = document.getElementById('birthdayError');
        const registrationForm = document.getElementById('registrationForm');

        // Remove any is-invalid class on page load (from old validation)
        if (contactInput) {
            contactInput.classList.remove('is-invalid');
        }
        if (contactPersonInput) {
            contactPersonInput.classList.remove('is-invalid');
        }

        // Set max date for birthday (yesterday)
        if (birthdayInput) {
            const today = new Date();
            const yesterday = new Date(today);
            yesterday.setDate(yesterday.getDate() - 1);

            const maxDate = yesterday.toISOString().split('T')[0];
            birthdayInput.setAttribute('max', maxDate);

            // Optional: Set a reasonable minimum date (e.g., 120 years ago)
            const minDate = new Date(today.getFullYear() - 120, today.getMonth(), today.getDate());
            birthdayInput.setAttribute('min', minDate.toISOString().split('T')[0]);
        }

        // Philippine phone number validation pattern
        // Accepts: 09xxxxxxxxx (11 digits starting with 09)
        const phNumberPattern = /^09\d{9}$/;

        function validatePhoneNumber(input, errorElement, showError = true) {
            const value = input.value.trim();

            // Remove any non-numeric characters
            const numericValue = value.replace(/\D/g, '');

            if (numericValue.length === 0) {
                errorElement.textContent = '';
                errorElement.style.display = 'none';
                input.classList.remove('is-invalid');
                input.classList.remove('is-valid');
                return true; // Empty is valid until user interacts
            }

            if (!phNumberPattern.test(numericValue)) {
                if (!showError) {
                    return false;
                }

                let errorMessage = '';

                if (numericValue.length !== 11) {
                    errorMessage = 'Phone number must be exactly 11 digits.';
                } else if (!numericValue.startsWith('09')) {
                    errorMessage = 'Phone number must start with 09.';
                } else {
                    errorMessage = 'Invalid Philippine phone number format. Use 09XXXXXXXXX.';
                }

                errorElement.textContent = errorMessage;
                errorElement.style.display = 'block';
                input.classList.add('is-invalid');
                return false;
            } else {
                errorElement.textContent = '';
                errorElement.style.display = 'none';
                input.classList.remove('is-invalid');
                input.classList.add('is-valid');
                return true;
            }
        }

        // Birthday validation
        function validateBirthday() {
            if (!birthdayInput || !birthdayInput.value) {
                return true;
            }

            const selectedDate = new Date(birthdayInput.value);
            const today = new Date();
            today.setHours(0, 0, 0, 0);

            if (selectedDate >= today) {
                birthdayError.textContent = 'Birthdate cannot be today or a future date.';
                birthdayError.style.display = 'block';
                birthdayInput.classList.add('is-invalid');
                return false;
            } else {
                birthdayError.textContent = '';
                birthdayError.style.display = 'none';
                birthdayInput.classList.remove('is-invalid');
                birthdayInput.classList.add('is-valid');
                return true;
            }
        }

        // Birthday change event
        if (birthdayInput) {
            birthdayInput.addEventListener('change', validateBirthday);
            birthdayInput.addEventListener('blur', validateBirthday);
        }

        // Real-time validation for contact number
        let contactTouched = false;
        if (contactInput) {
            contactInput.addEventListener('input', function(e) {
                // Remove non-numeric characters
                this.value = this.value.replace(/\D/g, '');
                if (contactTouched) {
                    validatePhoneNumber(this, contactError);
                }
            });

            contactInput.addEventListener('blur', function() {
                contactTouched = true;
                validatePhoneNumber(this, contactError);
            });

            contactInput.addEventListener('focus', function() {
                contactTouched = true;
            });
        }

        // Real-time validation for contact person number
        let contactPersonTouched = false;
        if (contactPersonInput) {
            contactPersonInput.addEventListener('input', function(e) {
                // Remove non-numeric characters
                this.value = this.value.replace(/\D/g, '');
                if (contactPersonTouched) {
                    validatePhoneNumber(this, contactPersonError);
                }
            });

            contactPersonInput.addEventListener('blur', function() {
                contactPersonTouched = true;
                validatePhoneNumber(this, contactPersonError);
            });

            contactPersonInput.addEventListener('focus', function() {
                contactPersonTouched = true;
            });
        }

        // Form submission validation
        if (registrationForm) {
            registrationForm.addEventListener('submit', function(e) {
                const isContactValid = validatePhoneNumber(contactInput, contactError);
                const isContactPersonValid = validatePhoneNumber(contactPersonInput,
                contactPersonError);
                const isBirthdayValid = validateBirthday();

                if (!isContactValid || !isContactPersonValid || !isBirthdayValid) {
                    e.preventDefault();

                    // Scroll to first invalid field
                    if (!isContactValid) {
                        contactInput.focus();
                        contactInput.scrollIntoView({
                            behavior: 'smooth',
                            block: 'center'
                        });
                    } else if (!isContactPersonValid) {
                        contactPersonInput.focus();
                        contactPersonInput.scrollIntoView({
                            behavior: 'smooth',
                            block: 'center'
                        });
                    } else if (!isBirthdayValid) {
                        birthdayInput.focus();
                        birthdayInput.scrollIntoView({
                            behavior: 'smooth',
                            block: 'center'
                        });
                    }

                    return false;
                }
            });
        }

        // Terms and Privacy checkbox handling
        var terms = document.getElementById('termsCheckbox');
        var privacy = document.getElementById('privacyCheckbox');
        var submitButton = document.getElementById('submitButton');

        if (terms && privacy && submitButton) {
            function toggleSubmitButton() {
                submitButton.disabled = !(terms.checked && privacy.checked);
            }

            terms.addEventListener('change', toggleSubmitButton);
            privacy.addEventListener('change', toggleSubmitButton);
        }
    });
</script>
