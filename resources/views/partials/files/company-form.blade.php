
<div class="container-fluid">
    <div class="row mt-4">
        <div class="col col-12">
            <h6>Document Number: SA/ADMIN/CLI-INFO-FRM/01</h6>
        </div>
    </div>
    <hr>
    <div class="form-row">
        <div class="form-group col-md-6">
            <label for="inputName">Name of Company</label>
            <input type="text" class="form-control" id="name"
                   name="name" required>
        </div>
        <div class="form-group col-md-6">
            <label for="inputEntity">Nature of Entity</label>
            <input type="text" class="form-control" id="name"
                   name="entity" required>
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-12">
            <label for="inputAddress">Physical Address</label>
            <input type="text" class="form-control" id="physicalAddress"
                   name="physical_address" required>
        </div>
    </div>
    <div class="form-row">
        <div class="form-group  col-md-12">
            <label for="inputAddress2">Postal Address</label>
            <input type="text" class="form-control"
                   name="postal_address" id="PostalAddress" required>
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-12">
            <div class="form-group">
                <label for="dob">Director (s) Names</label>
                <input type="text" class="form-control"
                       name="director_name" id="director_name" required>
            </div>
        </div>
    </div>
    <div class="form-row">
        <div class="form-group  col-md-12">
            <label for="inputAddress">Physical Address</label>
            <input type="text" class="form-control" id="physicalAddress"
                   name="director_physical_address" placeholder="1234 Main St" required>
        </div>
    </div>
    <div class="form-row">
        <div class="form-group  col-md-12">
            <label for="inputAddress2">Postal Address</label>
            <input type="text" class="form-control"
                   name="director_postal_address" id="PostalAddress" required>
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-12">
            <label >Contacts (TEL|FAX|CELL)</label>
            <div class="input-group">
                <input type="tel" class="form-control" id="tel"
                       name="tel">
                <input type="tel" class="form-control"
                       name="cell" id="cell">
                <input type="tel" class="form-control" id="tel"
                       name="fax">
            </div>
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-6">
            <label for="inputEmail">Email</label>
            <input type="email" class="form-control" id="email"
                   name="email" required>
        </div>
        <div class="form-group col-md-6">
            <label for="inputContact">Preferred Email</label>
            <input type="tel" class="form-control"
                   name="preferred_email" id="preferred_email"
                   required>
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-6">
            <div class="form-group">
                <label for="gender">Preferred method of contact</label>
                <select class="form-control form-control-md"
                        name="gender" required>
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
                   name="contact_person" id="contact_person"
                   required>
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-12">
            <label for="inputAddress2">Director (s) Postal Address</label>
            <input type="text" class="form-control"
                   name="directors_postal_address" id="PostalAddress" required>
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-12">
            <label for="inputAddress">Director (s) Physical Address</label>
            <input type="text" class="form-control" id="physicalAddress"
                   name="directors_physical_address" >
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-12">
            <label for="inputAddress2">Director (s) Alternative Contact</label>
            <input type="text" class="form-control"
                   name="alternative_contact" id="alternative_contact">
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-12">
            <label for="inputAddress2">Preferred methods of receiving invoices</label>
            <select class="form-control form-control-md"
                    name="invoice_method" required>
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
                       name="docs[]" class="form-control-file"
                       id="validatedCustomFile" multiple>
                <label class="custom-file-label" for="validatedCustomFile">
                    Upload supporting docs...</label>
                <div class="invalid-feedback">Scan Supporting Documents</div>
            </div>
        </div>
    </div>
</div>
