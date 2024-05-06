@extends('layouts.sidebar')
@section('title', 'Manage website')


@section('contents')

<div class="content-body">
    <div class="container-fluid">
        <div class="row page-titles mx-0">
            <div class="col-sm-6 p-md-0">
                <div class="welcome-text">
                    <h4>Manage Website</h4>

                </div>
            </div>

        </div>

        <div class="row">
            <div class="col-xl-12 col-xxl-12">
                <div class="card">
                    <div class="card-header">
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('website.update') }}" enctype="multipart/form-data">
                            @csrf
                            <div>
                                <section>
                                    <div class="row justify-content-center">
                                        <div class="form-group text-center ">
                                            <label>Current Logo</label>
                                            <div>
                                                @if($web->logo)
                                                    <img src="{{ asset('web_images/' . $web->logo) }}" alt="Website Logo" style="max-width: 200px;">
                                                @else
                                                    <p>No logo uploaded</p>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6 mb-2">
                                            <div class="form-group">
                                                <label class="text-label">Business Name</label>
                                                <input type="text" name="business_name" class="form-control" value="{{ $web->business_name }}" required>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 mb-2">
                                            <div class="form-group">
                                                <label class="text-label">Upload New Logo</label>
                                                <input type="file" name="logo" class="form-control" placeholder="Montana">
                                            </div>
                                        </div>
                                        <div class="col-lg-6 mb-2">
                                            <div class="form-group">
                                                <label class="text-label">Email Address</label>
                                                <input type="email" class="form-control" name="email" value="{{ $web->email }}" id="inputGroupPrepend2" aria-describedby="inputGroupPrepend2" placeholder="example@example.com.com" required>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 mb-2">
                                            <div class="form-group">
                                                <label class="text-label">Contact Number</label>
                                                <input type="text" name="contact_number" class="form-control" value="{{ $web->contact_number }}" placeholder="0909-999-9999" required>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 mb-2">
                                            <div class="form-group">
                                                <label class="text-label">Clinic Opening Hour</label>
                                                <input type="time" name="store_hour_start" class="form-control" value="{{ $web->store_hour_start }}" required>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 mb-2">
                                            <div class="form-group">
                                                <label class="text-label">Clinic Closing Hour</label>
                                                <input type="time" name="store_hour_end" class="form-control" value="{{ $web->store_hour_end }}"  required>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 mb-2">
                                            <div class="form-group">
                                                <label class="text-label">Clinic Close Day(s)</label>
                                                <select multiple class="form-control" id="sel2" name="store_close[]">
                                                    @foreach (['monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday'] as $day)
                                                        <option value="{{ $day }}" {{ in_array($day, json_decode($web->store_close)) ? 'selected' : '' }}>
                                                            {{ ucfirst($day) }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                  
                                            </div>
                                        </div>
                                        
                                        <div class="col-lg-6 mb-2">
                                            <div class="form-group">
                                                <label class="text-label">Address</label>
                                                <input type="text" name="address" value="{{ $web->address }}" class="form-control" required>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 mb-2">
                                            <div class="form-group">
                                                <label class="text-label">Customer Per Day (Morning)</label>
                                                <input type="number" name="customer_morning"  value="{{ $web->customer_morning }}" class="form-control" required>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 mb-2">
                                            <div class="form-group">
                                                <label class="text-label">Customer Per Day (Afternoon)</label>
                                                <input type="number" name="customer_afternoon" value="{{ $web->customer_afternoon }}" class="form-control" required>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 mb-2">
                                            <div class="form-group">
                                                <label class="text-label">Tagline</label>
                                                <input type="text" name="tagline" value="{{ $web->tagline }}" class="form-control" required>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 mb-2">
                                            <div class="form-group">
                                                <label class="text-label">About</label>
                                                <textarea name="about" class="form-control">{{ $web->about }}</textarea>
                                            </div>
                                        </div>                                        
                                        
                                    </div>
                                    <div class="col-12 d-flex justify-content-end">
                                        <button type="submit" class="btn btn-primary">
                                            <i class="bx bx-check d-block d-sm-none"></i>
                                            <span class="d-none d-sm-block">Update</span>
                                        </button>&nbsp
                                        
                                    </div>
                                </form>
                                </section>
                            </div>
                        </div>
                        
@endsection