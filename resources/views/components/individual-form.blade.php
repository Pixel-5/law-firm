<div>
    <div class="container-fluid">
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="inputSurname">Surname</label>
                <input type="text" class="form-control" id="surname"
                       name="surname" required value="{{ $file->surname }}">
            </div>
            <div class="form-group col-md-6">
                <label for="inputName">Name</label>
                <input type="text" class="form-control" id="name"
                       name="name" required value="{{ $file->name }}">
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <div class="form-group">
                    <label for="dob">Date of Birth</label>
                    <input type="date" class="form-control"
                           name="dob" id="dob" required value="{{ $file->dob }}">
                </div>
            </div>
            <div class="form-group col-md-6">
                <div class="form-group">
                    <label for="gender">ID/Passport Number</label>
                    <input type="text" class="form-control"
                           name="identifier" id="identifier" required value="{{ $file->identifier }}">
                </div>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <div class="form-group">
                    <label for="gender">Gender</label>
                    <select class="form-control form-control-md"
                            name="gender" required>
                        <option disabled>Select</option>
                        <option>Male</option>
                        <option>Female</option>
                    </select>
                </div>
            </div>
            <div class="form-group col-md-6">
                <div class="form-group">
                    <label for="gender">Is Citizen?</label>
                    <select class="form-control form-control-md"
                            name="is_citizen" required>
                        <option disabled>Select</option>
                        <option>{{ $file->is_citizen == 1? 'Yes':'No' }}</option>
                        <option>{{ $file->is_citizen == 1? 'No':'Yes' }}</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="form-group">
            <label for="inputAddress">Nationality</label>
            <input type="text" class="form-control" id="nationality"
                   name="nationality" required value="{{ $file->nationality }}">
        </div>
        <div class="form-group">
            <label for="inputAddress">Occupation</label>
            <input type="text" class="form-control" id="nationality"
                   name="occupation" required value="{{ $file->occupation }}">
        </div>
        <div class="form-group">
            <label for="inputAddress">Physical Address</label>
            <input type="text" class="form-control" id="physicalAddress"
                   name="physical_address" placeholder="1234 Main St" required value="{{ $file->physical_address }}">
        </div>
        <div class="form-group">
            <label for="inputAddress2">Postal Address</label>
            <input type="text" class="form-control"
                   name="postal_address" id="PostalAddress" required value="{{ $file->postal_address }}">
        </div>
        <div class="form-row">
            <div class="form-group col-md-12">
                <label >Contacts (TEL|FAX|CELL)</label>
                <div class="input-group">
                    <input type="tel" class="form-control" id="tel" name="tel">
                    <input type="tel" class="form-control" name="cell" id="cell">
                    <input type="tel" class="form-control" id="tel" name="fax">
                </div>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="inputEmail">Email</label>
                <input type="email" class="form-control" id="email"
                       name="email" required value="{{ $file->email }}">
            </div>
            <div class="form-group col-md-6">
                <label for="inputContact">Preferred Email</label>
                <input type="email" class="form-control"
                       name="preferred_email" id="preferred_email"
                       required value="{{ $file->preferred_email }}">
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <div class="form-group">
                    <label for="gender">Preferred method of contact</label>
                    <select class="form-control form-control-md"
                            name="preferred_contact" required>
                        <option disabled>Select</option>
                        <option>CELL</option>
                        <option>TEL</option>
                        <option>FAX</option>
                    </select>
                </div>
            </div>
            <div class="form-group col-md-6">
                <label for="inputContact">Marital Status</label>
                <input type="text" class="form-control"
                       name="marital_status" id="marital_status"
                       required value="{{ $file->marital_status }}">
            </div>
        </div>
        <div class="form-group">
            <label for="inputAddress2">Name of Spouse (If applicable)</label>
            <input type="text" class="form-control"
                   name="name_spouse" id="name_spouse" required value="{{ $file->name_spouse }}">
        </div>
        <div class="form-group">
            <label for="inputAddress2">Name of next of kin</label>
            <input type="text" class="form-control"
                   name="name_next_kin" id="name_next_kin" required value="{{ $file->name_next_kin }}">
        </div>
        <div class="form-group">
            <label for="inputAddress2">Contact of Next of kin</label>
            <input type="text" class="form-control"
                   name="contact_next_kin" id="contact_next_kin" required value="{{ $file->contact_next_kin }}">
        </div>
        <div class="form-group">
            <label for="inputAddress2">Preferred methods of receiving invoices</label>
            <select class="form-control form-control-md"
                    name="preferred_invoice" required>
                <option disabled>Select</option>
                <option>{{ $file->preferred_invoice }}</option>
                <option>email</option>
            </select>
        </div>
        <div class="form-group">
            <div class="custom-file">
                <input type="file"
                       name="docs[]" class="form-control-file"
                       id="validatedCustomFile" multiple>
                <label class="custom-file-label" for="validatedCustomFile">
                    Upload supporting docs...</label>
                <div class="invalid-feedback">Scan Supporting Documents</div>
            </div>
        </div>
    </div>
</div>
