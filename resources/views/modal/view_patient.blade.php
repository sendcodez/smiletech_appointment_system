<!-- View Patient Details Modal -->
<div class="modal fade" id="viewModal{{ $patient->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h4 class="modal-title" style="color: #e8e8e8">
                    <i class="fa fa-user-circle"></i> Patient Details
                </h4>
                <!--
                                                                                                                                                                                                                    <button type="button" class="close text-white" data-dismiss="modal" id="modal">
                                                                                                                                                                                                                        <span>&times;</span>
                                                                                                                                                                                                                    </button>
                                                                                                                                                                                                                -->
            </div>
            <div class="modal-body">
                <!-- Tabs Navigation -->
                <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#personal{{ $patient->id }}">
                            <i class="fa fa-user"></i> Personal Information
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#medical{{ $patient->id }}">
                            <i class="fa fa-heartbeat"></i> Medical History
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#conditions{{ $patient->id }}">
                            <i class="fa fa-stethoscope"></i> Medical Conditions
                        </a>
                    </li>
                </ul>

                <!-- Tabs Content -->
                <div class="tab-content mt-4">
                    <!-- Personal Information Tab -->
                    <div class="tab-pane fade show active" id="personal{{ $patient->id }}">
                        <!-- Basic Information Section -->
                        <div class="info-section">
                            <h5 class="section-header">
                                <i class="fa fa-user-circle"></i> Basic Information
                            </h5>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="detail-card">
                                        <div class="detail-icon">
                                            <i class="fa fa-id-card text-primary"></i>
                                        </div>
                                        <div class="detail-content">
                                            <label class="detail-label">Full
                                                Name</label>
                                            <p class="detail-value" style="font-size:2rem;text-transform: uppercase;">
                                                {{ $patient->firstname }}
                                                {{ $patient->middlename }}
                                                {{ $patient->lastname }}</p>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="detail-card">
                                        <div class="detail-icon">
                                            <i class="fa fa-calendar text-success"></i>
                                        </div>
                                        <div class="detail-content">
                                            <label class="detail-label">Birthday</label>
                                            <p class="detail-value">
                                                {{ date('F d, Y', strtotime($patient->birthday)) }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="detail-card">
                                        <div class="detail-icon">
                                            <i class="fa fa-birthday-cake text-warning"></i>
                                        </div>
                                        <div class="detail-content">
                                            <label class="detail-label">Age</label>
                                            <p class="detail-value">
                                                {{ \Carbon\Carbon::parse($patient->birthday)->age }}
                                                years old</p>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <!-- Contact Information Section -->
                        <div class="info-section">
                            <h5 class="section-header">
                                <i class="fa fa-address-book"></i> Contact Information
                            </h5>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="detail-card">
                                        <div class="detail-icon">
                                            <i class="fa fa-envelope text-danger"></i>
                                        </div>
                                        <div class="detail-content">
                                            <label class="detail-label">Email
                                                Address</label>
                                            <p class="detail-value">
                                                {{ $patient->email }}</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="detail-card">
                                        <div class="detail-icon">
                                            <i class="fa fa-phone text-success"></i>
                                        </div>
                                        <div class="detail-content">
                                            <label class="detail-label">Contact
                                                Number</label>
                                            <p class="detail-value">
                                                {{ $patient->contact ?? ($patient->number ?? 'N/A') }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="detail-card">
                                        <div class="detail-icon">
                                            <i class="fa fa-map-marker text-primary"></i>
                                        </div>
                                        <div class="detail-content">
                                            <label class="detail-label">Residential
                                                Address</label>
                                            <p class="detail-value">
                                                {{ $patient->address ?? 'N/A' }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Emergency Contact Section -->
                        <div class="info-section">
                            <h5 class="section-header">
                                <i class="fa fa-exclamation-triangle"></i> Emergency
                                Contact
                            </h5>
                            <div class="emergency-alert">
                                <i class="fa fa-info-circle"></i>
                                <span>Contact person to notify in case of
                                    emergency</span>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="detail-card">
                                        <div class="detail-icon">
                                            <i class="fa fa-shield text-warning"></i>
                                        </div>
                                        <div class="detail-content">
                                            <label class="detail-label">Contact Person
                                                Name</label>
                                            <p class="detail-value">
                                                {{ $patient->contact_person ?? 'N/A' }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="detail-card">
                                        <div class="detail-icon">
                                            <i class="fa fa-mobile text-danger"></i>
                                        </div>
                                        <div class="detail-content">
                                            <label class="detail-label">Contact Person
                                                Number</label>
                                            <p class="detail-value">
                                                {{ $patient->contact_person_number ?? 'N/A' }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Medical History Tab -->
                    <div class="tab-pane fade" id="medical{{ $patient->id }}">
                        @if ($patient->medicalHistory)
                            <div class="medical-section">
                                <h5 class="section-title"><i class="fa fa-history"></i> General Medical
                                    Information</h5>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="status-item">
                                            <span class="status-label">Requires
                                                Antibiotic Cover:</span>
                                            <span
                                                class="badge {{ $patient->medicalHistory->antibiotic ? 'badge-danger' : 'badge-success' }}">
                                                {{ $patient->medicalHistory->antibiotic ? 'Yes' : 'No' }}
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="status-item">
                                            <span class="status-label">Abnormal
                                                Reactions to Anesthesia:</span>
                                            <span
                                                class="badge {{ $patient->medicalHistory->abnormal ? 'badge-danger' : 'badge-success' }}">
                                                {{ $patient->medicalHistory->abnormal ? 'Yes' : 'No' }}
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="status-item">
                                            <span class="status-label">Smoker:</span>
                                            <span
                                                class="badge {{ $patient->medicalHistory->smoke ? 'badge-danger' : 'badge-success' }}">
                                                {{ $patient->medicalHistory->smoke ? 'Yes' : 'No' }}
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="status-item">
                                            <span class="status-label">Pregnant:</span>
                                            <span
                                                class="badge {{ $patient->medicalHistory->pregnant ? 'badge-danger' : 'badge-success' }}">
                                                {{ $patient->medicalHistory->pregnant ? 'Yes' : 'No' }}
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="status-item">
                                            <span class="status-label">Currently Under
                                                Treatment:</span>
                                            <span
                                                class="badge {{ $patient->medicalHistory->treated ? 'badge-danger' : 'badge-success' }}">
                                                {{ $patient->medicalHistory->treated ? 'Yes' : 'No' }}
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="status-item">
                                            <span class="status-label">Taking
                                                Prescription Medications:</span>
                                            <span
                                                class="badge {{ $patient->medicalHistory->prescription ? 'badge-danger' : 'badge-success' }}">
                                                {{ $patient->medicalHistory->prescription ? 'Yes' : 'No' }}
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="status-item">
                                            <span class="status-label">Hospitalized
                                                (Last 12 months)
                                                :</span>
                                            <span
                                                class="badge {{ $patient->medicalHistory->hospitalized ? 'badge-danger' : 'badge-success' }}">
                                                {{ $patient->medicalHistory->hospitalized ? 'Yes' : 'No' }}
                                            </span>
                                        </div>
                                    </div>
                                </div>

                                <hr class="my-4">

                                <h5 class="section-title"><i class="fa fa-pills"></i>
                                    Medications & Allergies</h5>
                                <div class="row">
                                    <div class="col-md-12 mb-3">
                                        <div class="info-box">
                                            <label class="info-box-label">Current
                                                Medications:</label>
                                            <p class="info-box-content">
                                                {{ $patient->medicalHistory->medications ?? 'None' }}
                                            </p>
                                        </div>
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <div class="info-box alert-warning">
                                            <label class="info-box-label">Drug
                                                Allergies:</label>
                                            <p class="info-box-content">
                                                {{ $patient->medicalHistory->allergies ?? 'None' }}
                                            </p>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="info-box alert-warning">
                                            <label class="info-box-label">Other Known
                                                Allergies:</label>
                                            <p class="info-box-content">
                                                {{ $patient->medicalHistory->known_allergies ?? 'None' }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @else
                            <div class="alert alert-info">
                                <i class="fa fa-info-circle"></i> No medical history
                                recorded for this patient.
                            </div>
                        @endif
                    </div>

                    <!-- Medical Conditions Tab -->
                    <div class="tab-pane fade" id="conditions{{ $patient->id }}">
                        @if ($patient->medicalConditions)
                            <h5 class="section-title mb-4"><i class="fa fa-notes-medical"></i> Medical Conditions
                                History</h5>
                            <div class="row">
                                @php
                                    $conditions = [
                                        [
                                            'label' => 'Steroid Therapy',
                                            'field' => 'steriod',
                                        ],
                                        [
                                            'label' => 'Kidney Disease',
                                            'field' => 'kidney_disease',
                                        ],
                                        [
                                            'label' => 'Prosthetic Implant',
                                            'field' => 'prosthetic_implant',
                                        ],
                                        [
                                            'label' => 'Rheumatic Fever',
                                            'field' => 'rheumatic',
                                        ],
                                        [
                                            'label' => 'Excessive Bleeding',
                                            'field' => 'excessive_bleeding',
                                        ],
                                        [
                                            'label' => 'Cardiac Pacemaker',
                                            'field' => 'cardiac_pacemaker',
                                        ],
                                        [
                                            'label' => 'Epilepsy',
                                            'field' => 'epilepsy',
                                        ],
                                        ['label' => 'Stroke', 'field' => 'stroke'],
                                        [
                                            'label' => 'Stomach/Digestive Issues',
                                            'field' => 'stomach_condition',
                                        ],
                                        ['label' => 'Asthma', 'field' => 'asthma'],
                                        ['label' => 'Cancer', 'field' => 'cancer'],
                                        [
                                            'label' => 'Hepatitis/Liver Disease',
                                            'field' => 'hepatitis',
                                        ],
                                        [
                                            'label' => 'Diabetes',
                                            'field' => 'diabetes',
                                        ],
                                        [
                                            'label' => 'Tuberculosis',
                                            'field' => 'tuberculosis',
                                        ],
                                        [
                                            'label' => 'Blood-borne Viruses',
                                            'field' => 'blood_borne',
                                        ],
                                        [
                                            'label' => 'Heart Disorder',
                                            'field' => 'heart_disorder',
                                        ],
                                        [
                                            'label' => 'Thyroid Disease',
                                            'field' => 'thyroid_disease',
                                        ],
                                        [
                                            'label' => 'Bronchitis/Lung Disease',
                                            'field' => 'bronchitis',
                                        ],
                                        [
                                            'label' => 'Bone Disease/Osteoporosis',
                                            'field' => 'bone_disease',
                                        ],
                                        [
                                            'label' => 'Nervous/Psychiatric Condition',
                                            'field' => 'nervous',
                                        ],
                                        [
                                            'label' => 'Anemia/Blood Disease',
                                            'field' => 'anaemia',
                                        ],
                                        [
                                            'label' => 'Radiation Therapy',
                                            'field' => 'radiation',
                                        ],
                                        [
                                            'label' => 'High/Low Blood Pressure',
                                            'field' => 'high_blood',
                                        ],
                                        [
                                            'label' => 'Other Conditions',
                                            'field' => 'other_condition',
                                        ],
                                    ];
                                @endphp

                                @foreach ($conditions as $condition)
                                    <div class="col-md-6 col-lg-4 mb-3">
                                        <div
                                            class="condition-item {{ $patient->medicalConditions->{$condition['field']} ? 'has-condition' : 'no-condition' }}">
                                            <i
                                                class="fa {{ $patient->medicalConditions->{$condition['field']} ? 'fa-check-circle text-danger' : 'fa-times-circle text-success' }}"></i>
                                            <span>{{ $condition['label'] }}</span>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="alert alert-info">
                                <i class="fa fa-info-circle"></i> No medical conditions
                                recorded for this patient.
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"
                    id="close">Close</button>



            </div>

        </div>
    </div>
</div>
