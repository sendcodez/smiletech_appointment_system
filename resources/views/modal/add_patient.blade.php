<!-- Add Patient Modal -->
<div class="modal fade" id="addUserModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-success">
                <h4 class="modal-title" style="color:white">
                    <i class="fa fa-user-plus"></i> Add New Patient
                </h4>
                <button type="button" class="close text-white" data-bs-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>

            <form action="{{ route('patients.store') }}" method="POST" id="addPatientForm">
                @csrf

                <div class="modal-body">
                    <!-- Tabs Navigation -->
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#addPersonalTab">
                                <i class="fa fa-user"></i> Personal Information
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#addMedicalTab">
                                <i class="fa fa-heartbeat"></i> Medical History
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#addConditionsTab">
                                <i class="fa fa-stethoscope"></i> Medical Conditions
                            </a>
                        </li>
                    </ul>

                    <!-- Tabs Content -->
                    <div class="tab-content mt-4">
                        <!-- Personal Information Tab -->
                        <div class="tab-pane fade show active" id="addPersonalTab">
                            <h5 class="mb-3"><i class="fa fa-user-circle"></i> Basic Information</h5>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>First Name <span class="text-danger">*</span></label>
                                        <input type="text" name="firstname" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Middle Name</label>
                                        <input type="text" name="middlename" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Last Name <span class="text-danger">*</span></label>
                                        <input type="text" name="lastname" class="form-control" required>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Birthday</label>
                                        <input type="date" name="birthday" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Username <span class="text-danger">*</span></label>
                                        <input type="text" name="username" class="form-control" required>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Password <span class="text-danger">*</span></label>
                                        <input type="password" name="password" class="form-control" required
                                            minlength="8">
                                        <small class="form-text text-muted">Minimum 8 characters</small>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Confirm Password <span class="text-danger">*</span></label>
                                        <input type="password" name="password_confirmation" class="form-control"
                                            required minlength="8">
                                    </div>
                                </div>
                            </div>

                            <h5 class="mb-3 mt-4"><i class="fa fa-address-book"></i> Contact Information</h5>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Email Address <span class="text-danger">*</span></label>
                                        <input type="email" name="email" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Contact Number</label>
                                        <input type="text" name="contact" class="form-control"
                                            placeholder="0919XXXXXXX" pattern="^09\d{9}$" maxlength="11"
                                            inputmode="numeric" required>
                                        <small class="text-muted">Format: 0919XXXXXXX</small>
                                    </div>
                                </div>

                            </div>

                            <div class="form-group">
                                <label>Address</label>
                                <textarea name="address" class="form-control" rows="2" placeholder="Street, City, Province"></textarea>
                            </div>

                            <h5 class="mb-3 mt-4"><i class="fa fa-exclamation-triangle"></i> Emergency Contact</h5>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Contact Person Name</label>
                                        <input type="text" name="contact_person" class="form-control"
                                            placeholder="Full Name">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Contact Person Number</label>
                                        <input type="text" name="contact_person_number" class="form-control"
                                            placeholder="+63 XXX XXX XXXX">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Medical History Tab -->
                        <div class="tab-pane fade" id="addMedicalTab">
                            <h5 class="mb-3"><i class="fa fa-history"></i> General Medical Information</h5>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Requires Antibiotic Cover</label>
                                        <select name="antibiotic" class="form-control">
                                            <option value="no" selected>No</option>
                                            <option value="yes">Yes</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Abnormal Reactions to Anesthesia</label>
                                        <select name="abnormal" class="form-control">
                                            <option value="no" selected>No</option>
                                            <option value="yes">Yes</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Smoker</label>
                                        <select name="smoke" class="form-control">
                                            <option value="no" selected>No</option>
                                            <option value="yes">Yes</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Pregnant</label>
                                        <select name="pregnant" class="form-control">
                                            <option value="no" selected>No</option>
                                            <option value="yes">Yes</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Currently Under Treatment</label>
                                        <select name="treated" class="form-control">
                                            <option value="no" selected>No</option>
                                            <option value="yes">Yes</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Taking Prescription Medications</label>
                                        <select name="prescription" class="form-control">
                                            <option value="no" selected>No</option>
                                            <option value="yes">Yes</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label>Hospitalized (Last 12 months)</label>
                                <select name="hospitalized" class="form-control">
                                    <option value="no" selected>No</option>
                                    <option value="yes">Yes</option>
                                </select>
                            </div>

                            <h5 class="mb-3 mt-4"><i class="fa fa-pills"></i> Medications & Allergies</h5>

                            <div class="form-group">
                                <label>Current Medications</label>
                                <textarea name="medications" class="form-control" rows="2"
                                    placeholder="List any medications currently being taken"></textarea>
                            </div>

                            <div class="form-group">
                                <label>Drug Allergies</label>
                                <textarea name="allergies" class="form-control" rows="2" placeholder="List any known drug allergies"></textarea>
                            </div>

                            <div class="form-group">
                                <label>Other Known Allergies</label>
                                <textarea name="known_allergies" class="form-control" rows="2"
                                    placeholder="List any other allergies (food, environment, etc.)"></textarea>
                            </div>
                        </div>

                        <!-- Medical Conditions Tab -->
                        <div class="tab-pane fade" id="addConditionsTab">
                            <h5 class="mb-3"><i class="fa fa-notes-medical"></i> Medical Conditions</h5>
                            <p class="text-muted">Please select if the patient has any of the following conditions:</p>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <label>Steroid Therapy</label>
                                        <select name="steriod" class="form-control">
                                            <option value="no" selected>No</option>
                                            <option value="yes">Yes</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <label>Kidney Disease</label>
                                        <select name="kidney_disease" class="form-control">
                                            <option value="no" selected>No</option>
                                            <option value="yes">Yes</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <label>Prosthetic Implant</label>
                                        <select name="prosthetic_implant" class="form-control">
                                            <option value="no" selected>No</option>
                                            <option value="yes">Yes</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <label>Rheumatic Fever</label>
                                        <select name="rheumatic" class="form-control">
                                            <option value="no" selected>No</option>
                                            <option value="yes">Yes</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <label>Excessive Bleeding</label>
                                        <select name="excessive_bleeding" class="form-control">
                                            <option value="no" selected>No</option>
                                            <option value="yes">Yes</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <label>Cardiac Pacemaker</label>
                                        <select name="cardiac_pacemaker" class="form-control">
                                            <option value="no" selected>No</option>
                                            <option value="yes">Yes</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <label>Epilepsy</label>
                                        <select name="epilepsy" class="form-control">
                                            <option value="no" selected>No</option>
                                            <option value="yes">Yes</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <label>Stroke</label>
                                        <select name="stroke" class="form-control">
                                            <option value="no" selected>No</option>
                                            <option value="yes">Yes</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <label>Stomach/Digestive Issues</label>
                                        <select name="stomach_condition" class="form-control">
                                            <option value="no" selected>No</option>
                                            <option value="yes">Yes</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <label>Asthma</label>
                                        <select name="asthma" class="form-control">
                                            <option value="no" selected>No</option>
                                            <option value="yes">Yes</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <label>Cancer</label>
                                        <select name="cancer" class="form-control">
                                            <option value="no" selected>No</option>
                                            <option value="yes">Yes</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <label>Hepatitis/Liver Disease</label>
                                        <select name="hepatitis" class="form-control">
                                            <option value="no" selected>No</option>
                                            <option value="yes">Yes</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <label>Diabetes</label>
                                        <select name="diabetes" class="form-control">
                                            <option value="no" selected>No</option>
                                            <option value="yes">Yes</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <label>Tuberculosis</label>
                                        <select name="tuberculosis" class="form-control">
                                            <option value="no" selected>No</option>
                                            <option value="yes">Yes</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <label>Blood-borne Viruses</label>
                                        <select name="blood_borne" class="form-control">
                                            <option value="no" selected>No</option>
                                            <option value="yes">Yes</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <label>Heart Disorder</label>
                                        <select name="heart_disorder" class="form-control">
                                            <option value="no" selected>No</option>
                                            <option value="yes">Yes</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <label>Thyroid Disease</label>
                                        <select name="thyroid_disease" class="form-control">
                                            <option value="no" selected>No</option>
                                            <option value="yes">Yes</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <label>Bronchitis/Lung Disease</label>
                                        <select name="bronchitis" class="form-control">
                                            <option value="no" selected>No</option>
                                            <option value="yes">Yes</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <label>Bone Disease/Osteoporosis</label>
                                        <select name="bone_disease" class="form-control">
                                            <option value="no" selected>No</option>
                                            <option value="yes">Yes</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <label>Nervous/Psychiatric Condition</label>
                                        <select name="nervous" class="form-control">
                                            <option value="no" selected>No</option>
                                            <option value="yes">Yes</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <label>Anemia/Blood Disease</label>
                                        <select name="anaemia" class="form-control">
                                            <option value="no" selected>No</option>
                                            <option value="yes">Yes</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <label>Radiation Therapy</label>
                                        <select name="radiation" class="form-control">
                                            <option value="no" selected>No</option>
                                            <option value="yes">Yes</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <label>High/Low Blood Pressure</label>
                                        <select name="high_blood" class="form-control">
                                            <option value="no" selected>No</option>
                                            <option value="yes">Yes</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <label>Other Conditions</label>
                                        <select name="other_condition" class="form-control">
                                            <option value="no" selected>No</option>
                                            <option value="yes">Yes</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        <i class="fa fa-times"></i> Cancel
                    </button>
                    <button type="submit" class="btn btn-success">
                        <i class="fa fa-save"></i> Add Patient
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
