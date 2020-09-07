
<div class="container-fluid">
    <div class="form-row">
        <div class="form-group col-md-6">
            <label for="inputName">Name of Company</label>
            <input type="text" class="form-control"
                   name="cname" required>
        </div>
        <div class="form-group col-md-6">
            <label for="inputEntity">Nature of Entity</label>
            <input type="text" class="form-control"
                   name="entity" required>
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-12">
            <label for="inputAddress">Physical Address</label>
            <input type="text" class="form-control"
                   name="cphysical_address" required>
        </div>
    </div>
    <div class="form-row">
        <div class="form-group  col-md-12">
            <label for="inputAddress2">Postal Address</label>
            <input type="text" class="form-control"
                   name="cpostal_address"  required>
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-12">
            <div class="form-group">
                <label for="dob">Director (s) Names</label>
                <input type="text" class="form-control"
                       name="director_name"  required>
            </div>
        </div>
    </div>
    <div class="form-row">
        <div class="form-group  col-md-12">
            <label for="inputAddress">Physical Address</label>
            <input type="text" class="form-control"
                   name="director_physical_address" required>
        </div>
    </div>
    <div class="form-row">
        <div class="form-group  col-md-12">
            <label for="inputAddress2">Postal Address</label>
            <input type="text" class="form-control"
                   name="director_postal_address"  required>
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-12">
            <label >Contacts (TEL|FAX|CELL)</label>
            <div class="input-group">
                <input type="tel" class="form-control"
                       name="ctel">
                <input type="tel" class="form-control"
                       name="cfax">
                <input type="tel" class="form-control"
                       name="ccell" required>
            </div>
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-6">
            <label for="inputEmail">Email</label>
            <input type="email" class="form-control"
                   name="cemail" required>
        </div>
        <div class="form-group col-md-6">
            <label for="inputContact">Preferred Email</label>
            <input type="tel" class="form-control"
                   name="cpreferred_email"
                   required>
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-6">
            <div class="form-group">
                <label for="gender">Preferred method of contact</label>
                <select class="form-control form-control-md" name="cpreferred_contact" required>
                    <option disabled>Select</option>
                    <option>CELL</option>
                    <option>TEL</option>
                    <option>FAX</option>
                </select>
            </div>
        </div>
        <div class="form-group col-md-6">
            <label for="inputContact">Contact Person</label>
            <input type="tel" class="form-control"
                   name="ccontact_person"
                   required>
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-12">
            <label for="inputAddress2">Director (s) Postal Address</label>
            <input type="text" class="form-control"
                   name="directors_postal_address"  required>
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-12">
            <label for="inputAddress">Director (s) Physical Address</label>
            <input type="text" class="form-control" name="directors_physical_address" >
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-12">
            <label for="inputAddress2">Director (s) Alternative Contact</label>
            <input type="text" class="form-control"
                   name="calternative_contact" >
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-12">
            <label for="inputAddress2">Preferred methods of receiving invoices</label>
            <select class="form-control form-control-md" name="cpreferred_invoice" required>
                <option disabled>Select</option>
                <option>contact</option>
                <option>email</option>
            </select>
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-12">
            <div class="custom-file">
                <input type="file"
                       name="cdocs[]" class="form-control-file" multiple>
                <label class="custom-file-label" for="validatedCustomFile">
                    Upload supporting docs...</label>
                <div class="invalid-feedback">Scan Supporting Documents</div>
            </div>
        </div>
    </div>
</div>
