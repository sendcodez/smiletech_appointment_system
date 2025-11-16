<!-- Edit Patient Modal -->
<div class="modal fade" id="editModal{{ $patient->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-warning text-white" style="color:white">
                <h4 class="modal-title">
                    <i class="fa fa-edit"></i> Edit Patient Information
                </h4>
                <button type="button" class="close text-white" data-bs-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>

            <form action="{{ route('patients.update', $patient->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="modal-body">
                    <!-- Tabs Navigation -->
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#editPersonal{{ $patient->id }}">
                                <i class="fa fa-user"></i> Personal Information
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#editMedical{{ $patient->id }}">
                                <i class="fa fa-heartbeat"></i> Medical History
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#editConditions{{ $patient->id }}">
                                <i class="fa fa-stethoscope"></i> Medical Conditions
                            </a>
                        </li>
                    </ul>

                    <!-- Tabs Content -->
                    <div class="tab-content mt-4">
                        <!-- Personal Information Tab -->
                        <div class="tab-pane fade show active" id="editPersonal{{ $patient->id }}">
                            <h5 class="mb-3"><i class="fa fa-user-circle"></i> Basic
                                Information</h5>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>First Name <span class="text-danger">*</span></label>
                                        <input type="text" name="firstname" class="form-control"
                                            value="{{ $patient->firstname }}" required>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Middle Name</label>
                                        <input type="text" name="middlename" class="form-control"
                                            value="{{ $patient->middlename }}">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Last Name <span class="text-danger">*</span></label>
                                        <input type="text" name="lastname" class="form-control"
                                            value="{{ $patient->lastname }}" required>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Birthday</label>
                                        <input type="date" name="birthday" class="form-control"
                                            value="{{ $patient->birthday }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Username <span class="text-danger">*</span></label>
                                        <input type="text" name="username" class="form-control"
                                            value="{{ $patient->username }}" required>
                                    </div>
                                </div>
                            </div>

                            <h5 class="mb-3 mt-4"><i class="fa fa-address-book"></i>
                                Contact Information</h5>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Email Address <span class="text-danger">*</span></label>
                                        <input type="email" name="email" class="form-control"
                                            value="{{ $patient->email }}" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Contact Number</label>
                                        <input type="text" name="contact" class="form-control"
                                            value="{{ $patient->number }}">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label>Address</label>
                                <textarea name="address" class="form-control" rows="2">{{ $patient->address }}</textarea>
                            </div>

                            <h5 class="mb-3 mt-4"><i class="fa fa-exclamation-triangle"></i> Emergency
                                Contact</h5>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Contact Person Name</label>
                                        <input type="text" name="contact_person" class="form-control"
                                            value="{{ $patient->contact_person }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Contact Person Number</label>
                                        <input type="text" name="contact_person_number" class="form-control"
                                            value="{{ $patient->contact_person_number }}">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Medical History Tab -->
                        <div class="tab-pane fade" id="editMedical{{ $patient->id }}">
                            <h5 class="mb-3"><i class="fa fa-history"></i> General
                                Medical Information</h5>

                            @php
                                $medHistory = $patient->medicalHistory;
                            @endphp

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Requires Antibiotic Cover</label>
                                        <select name="antibiotic" class="form-control">
                                            <option value="no"
                                                {{ !$medHistory || !$medHistory->antibiotic ? 'selected' : '' }}>
                                                No</option>
                                            <option value="yes"
                                                {{ $medHistory && $medHistory->antibiotic ? 'selected' : '' }}>
                                                Yes</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Abnormal Reactions to Anesthesia</label>
                                        <select name="abnormal" class="form-control">
                                            <option value="no"
                                                {{ !$medHistory || !$medHistory->abnormal ? 'selected' : '' }}>
                                                No</option>
                                            <option value="yes"
                                                {{ $medHistory && $medHistory->abnormal ? 'selected' : '' }}>
                                                Yes</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Smoker</label>
                                        <select name="smoke" class="form-control">
                                            <option value="no"
                                                {{ !$medHistory || !$medHistory->smoke ? 'selected' : '' }}>
                                                No</option>
                                            <option value="yes"
                                                {{ $medHistory && $medHistory->smoke ? 'selected' : '' }}>
                                                Yes</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Pregnant</label>
                                        <select name="pregnant" class="form-control">
                                            <option value="no"
                                                {{ !$medHistory || !$medHistory->pregnant ? 'selected' : '' }}>
                                                No</option>
                                            <option value="yes"
                                                {{ $medHistory && $medHistory->pregnant ? 'selected' : '' }}>
                                                Yes</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Currently Under Treatment</label>
                                        <select name="treated" class="form-control">
                                            <option value="no"
                                                {{ !$medHistory || !$medHistory->treated ? 'selected' : '' }}>
                                                No</option>
                                            <option value="yes"
                                                {{ $medHistory && $medHistory->treated ? 'selected' : '' }}>
                                                Yes</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Taking Prescription Medications</label>
                                        <select name="prescription" class="form-control">
                                            <option value="no"
                                                {{ !$medHistory || !$medHistory->presription ? 'selected' : '' }}>
                                                No</option>
                                            <option value="yes"
                                                {{ $medHistory && $medHistory->prescription ? 'selected' : '' }}>
                                                Yes</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label>Hospitalized (Last 12 months)</label>
                                <select name="hospitalized" class="form-control">
                                    <option value="no"
                                        {{ !$medHistory || !$medHistory->hospitalized ? 'selected' : '' }}>
                                        No</option>
                                    <option value="yes"
                                        {{ $medHistory && $medHistory->hospitalized ? 'selected' : '' }}>
                                        Yes</option>
                                </select>
                            </div>

                            <h5 class="mb-3 mt-4"><i class="fa fa-pills"></i>
                                Medications & Allergies</h5>

                            <div class="form-group">
                                <label>Current Medications</label>
                                <textarea name="medications" class="form-control" rows="2">{{ $medHistory->medications ?? '' }}</textarea>
                            </div>

                            <div class="form-group">
                                <label>Drug Allergies</label>
                                <textarea name="allergies" class="form-control" rows="2">{{ $medHistory->allergies ?? '' }}</textarea>
                            </div>

                            <div class="form-group">
                                <label>Other Known Allergies</label>
                                <textarea name="known_allergies" class="form-control" rows="2">{{ $medHistory->known_allergies ?? '' }}</textarea>
                            </div>
                        </div>

                        <!-- Medical Conditions Tab -->
                        <div class="tab-pane fade" id="editConditions{{ $patient->id }}">
                            <h5 class="mb-3"><i class="fa fa-notes-medical"></i>
                                Medical Conditions</h5>

                            @php
                                $medConditions = $patient->medicalConditions;
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
                                    ['label' => 'Epilepsy', 'field' => 'epilepsy'],
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
                                    ['label' => 'Diabetes', 'field' => 'diabetes'],
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

                            <div class="row">
                                @foreach ($conditions as $condition)
                                    <div class="col-md-6 mb-3">
                                        <div class="form-group">
                                            <label>{{ $condition['label'] }}</label>
                                            <select name="{{ $condition['field'] }}" class="form-control">
                                                <option value="no"
                                                    {{ !$medConditions || !$medConditions->{$condition['field']} ? 'selected' : '' }}>
                                                    No</option>
                                                <option value="yes"
                                                    {{ $medConditions && $medConditions->{$condition['field']} ? 'selected' : '' }}>
                                                    Yes</option>
                                            </select>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        <i class="fa fa-times"></i> Cancel
                    </button>
                    <button type="submit" class="btn btn-warning">
                        <i class="fa fa-save"></i> Update Patient
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
