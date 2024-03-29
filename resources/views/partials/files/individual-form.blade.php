
<div class="container-fluid">
    <div class="form-row">
        <div class="form-group col-md-6">
            <label for="inputSurname">Surname</label>
            <input type="text" class="form-control"
                   name="surname" required>
        </div>
        <div class="form-group col-md-6">
            <label for="inputName">Name</label>
            <input type="text" class="form-control"
                   name="name" required>
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-6">
            <div class="form-group">
                <label for="dob">Date of Birth</label>
                <input type="date" class="form-control"
                       name="dob"  required>
            </div>
        </div>
        <div class="form-group col-md-6">
            <div class="form-group">
                <label for="gender">ID/Passport Number</label>
                <input type="text" class="form-control"
                       name="identifier"  required>
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
                    <option>Yes</option>
                    <option>No</option>
                </select>
            </div>
        </div>
    </div>
    <div class="form-group">
        <label for="inputAddress">Nationality</label>
        <input type="text" class="form-control"
               name="nationality" required>
    </div>
    <div class="form-group">
        <label for="inputAddress">Occupation</label>
        <input type="text" class="form-control"
               name="occupation" required>
    </div>
    <div class="form-group">
        <label for="inputAddress">Physical Address</label>
        <input type="text" class="form-control"
               name="physical_address"  required>
    </div>
    <div class="form-group">
        <label for="inputAddress2">Postal Address</label>
        <input type="text" class="form-control"
               name="postal_address"  required>
    </div>
    <div class="form-row">
        <div class="form-group col-md-12">
            <label >Contacts (TEL|FAX|CELL)</label>
            <div class="input-group">
                <input type="tel" class="form-control"
                       name="tel">
                <input type="tel" class="form-control"
                       name="fax">
                <input type="tel" class="form-control"
                       name="cell" required>
            </div>
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-6">
            <label for="inputEmail">Email</label>
            <input type="email" class="form-control"
                   name="email" required>
        </div>
        <div class="form-group col-md-6">
            <label for="inputContact">Preferred Email</label>
            <input type="email" class="form-control"
                   name="preferred_email"
                   required>
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
                   name="marital_status"
                   required>
        </div>
    </div>
    <div class="form-group">
        <label for="inputAddress2">Name of Spouse (If applicable)</label>
        <input type="text" class="form-control"
               name="name_spouse"  required>
    </div>
    <div class="form-group">
        <label for="inputAddress2">Name of next of kin</label>
        <input type="text" class="form-control"
               name="name_next_kin"  required>
    </div>
    <div class="form-group">
        <label for="inputAddress2">Contact of Next of kin</label>
        <input type="text" class="form-control"
               name="contact_next_kin"  required>
    </div>
    <div class="form-group">
        <label for="inputAddress2">Preferred methods of receiving invoices</label>
        <select class="form-control form-control-md"
                name="preferred_invoice" required>
            <option disabled>Select</option>
            <option>contact</option>
            <option>email</option>
        </select>
    </div>
    <div class="form-group">
        <div class="custom-file">
            <input type="file"
                   name="docs[]" class="form-control-file" multiple>
            <label class="custom-file-label" for="validatedCustomFile">
                Upload supporting docs...</label>
            <div class="invalid-feedback">Scan Supporting Documents</div>
        </div>
    </div>
</div>
