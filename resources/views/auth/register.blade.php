@extends('layouts.register')
<link href="{{ asset('frontend/img/smiletech_logo.png') }}" rel="icon">
<form method="POST" action="{{ route('register') }}"  enctype="multipart/form-data">
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
    <x-text-input id="lastname" class="form-control" type="text" name="lastname" :value="old('lastname')" required autofocus
        autocomplete="lastname" />
    <x-input-error :messages="$errors->get('lastname')" class="mt-2" />
    @endsection

    @section('username')
    <x-input-label for="username" :value="__('Username')" />
    <x-text-input id="username" class="form-control" type="text" name="username" :value="old('username')" required autofocus
        autocomplete="username" />
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

    @section('already')
    <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
        href="{{ route('login') }}">
        {{ __('Already registered?') }}
    </a>
    @endsection 
    @section('terms')
        <div class="form-group">
            <input type="checkbox" id="termsCheckbox" onclick="toggleSubmitButton()"> I agree to the <a href="#" data-bs-toggle="modal" data-bs-target="#termsModal">Terms and Conditions</a>
        </div>
    @endsection

    @section ('button')
    <x-primary-button class="btn btn-primary btn-block" id="submitButton" disabled>
        {{ __('Register') }}
    </x-primary-button>
    @endsection
</form>
<!-- Terms and Conditions Modal -->
<div class="modal fade" id="termsModal" tabindex="-1" aria-labelledby="termsModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="termsModalLabel">Terms and Conditions</h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Add your terms and conditions content here -->
                
                <h4>1. Introduction</h4>
                <p>Welcome to SmileTech. These Terms and Conditions govern your use of our website and services. By accessing or using our website, you agree to comply with and be bound by these Terms. If you do not agree with these Terms, please do not use our website or services.</p><br>
                
                <h4>2. Use of the Website</h4>
                
                    <li>You agree to use the website only for lawful purposes and in a way that does not infringe the rights of others or restrict their use and enjoyment of the website.</li><br>
                    <li>You are responsible for maintaining the confidentiality of your account and password and for all activities that occur under your account.</li><br>
                
                
                <h4>3. Intellectual Property</h4>
                
                    <li>All content on the SmileTech website, including text, graphics, logos, images, and software, is the property of SmileTech and is protected by copyright, trademark, and other intellectual property laws.</li><br>
                    <li>You may not reproduce, distribute, modify, or create derivative works of any content on our website without our express written permission.</li><br>
                
                
                <h4>4. User Content</h4>
                <p>You retain ownership of any content you submit to the website, but you grant SmileTech a non-exclusive, royalty-free, worldwide license to use, display, reproduce, and distribute such content. You agree that any content you submit does not violate any third-party rights and is not unlawful, offensive, or otherwise objectionable.</p><br>
                
                <h4>5. Privacy</h4>
                <p>Your privacy is important to us. Please review our Privacy Policy, which explains how we collect, use, and protect your personal information.</p><br>
                
                <h4>6. Limitation of Liability</h4>
                
                    <li>SmileTech is not liable for any direct, indirect, incidental, consequential, or punitive damages arising from your use of the website or services.</li><br>
                    <li>We do not guarantee that the website will be available at all times or that it will be free from errors, viruses, or other harmful components.</li><br>
                
                
                <h4>7. Changes to the Terms</h4>
                <p>SmileTech reserves the right to modify these Terms at any time. We will notify you of any changes by posting the new Terms on our website. Your continued use of the website after such changes constitutes your acceptance of the new Terms.</p><br>
                
                <h4>8. Governing Law</h4>
                <p>These Terms are governed by and construed in accordance with the laws of the jurisdiction in which SmileTech operates. Any disputes arising out of or relating to these Terms will be resolved in the courts of that jurisdiction.</p><br>
                
                <h4>9. Contact Us</h4>
                <p>If you have any questions or concerns about these Terms, please contact us at:</p>
                
                    <li>Email: smiletech@gmail.com</li><br>
                    <li>Phone: 0909-111-2222</li>
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>


<script>
    function toggleSubmitButton() {
        var checkbox = document.getElementById('termsCheckbox');
        var submitButton = document.getElementById('submitButton');
        submitButton.disabled = !checkbox.checked;
    }
</script>