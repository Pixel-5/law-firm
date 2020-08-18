<div class="container-fluid">
    <div class="form-row">
        <div class="form-group col-md-12">
            <label for="inputSurname">Surname</label>
            <input type="text" class="form-control" id="transferee_surname"
                   name="transferee_surname"  @if($file != null) value="{{ $file->surname }}" @endif >
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-12">
            <label for="inputName">Name</label>
            <input type="text" class="form-control" id="transferee_name"
                   name="transferee_name"   @if($file != null) value="{{ $file->name }}" @endif>
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-12">
            <div class="form-group">
                <label for="gender">ID/Passport Number</label>
                <input type="text" class="form-control"
                       name="transferee_identifier" id="transferee_identifier"
                       @if($file != null) value="{{ $file->identifier }}" @endif>
            </div>
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-12">
            <div class="form-group">
                <label for="dob">Date of Birth</label>
                <input type="date" class="form-control"
                       name="transferee_dob" id="transferee_dob"
                       @if($file != null) value="{{ $file->dob }}" @endif>
            </div>
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-12">
            <label for="inputContact">Marital Status</label>
            <input type="text" class="form-control"
                   name="transferee_marital_status" id="transferee_marital_status"
                    @if($file != null) value="{{ $file->marital_status }}" @endif>
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-12">
            <label for="inputAddress">NAME OF SPOUSE</label>
            <input type="text" class="form-control" id="transferee_spouse"
                   name="transferee_spouse"  @if($file != null) value="{{ $file->spouse }}" @endif>
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-6">
            <label for="inputAddress">Physical Address</label>
            <input type="text" class="form-control" id="transferee_physicalAddress"
                   name="transferee_physical_address"
                   @if($file != null) value="{{ $file->physical_address }}" @endif>
        </div>
        <div class="form-group col-md-6">
            <label for="inputAddress2">Postal Address</label>
            <input type="text" class="form-control"
                   name="transferee_postal_address" id="PostalAddress"
                   @if($file != null) value="{{ $file->postal_address }}" @endif>
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-12">
            <label >Contacts (TEL|CELL|ALTERNATIVE)</label>
            <div class="input-group">
                <input type="tel" @if($file != null) value="{{ $file->tel }}" @endif
                class="form-control" id="tel" name="transferee_tel">
                <input type="tel" @if($file != null) value="{{ $file->cell }}" @endif
                class="form-control" name="transferee_cell" id="cell">
                <input type="tel" class="form-control" id="tel" name="transferee_alt">
            </div>
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-12">
            <label for="inputEmail">Email</label>
            <input type="email" class="form-control" id="transferee_email"
                   name="transferee_email"  @if($file != null) value="{{ $file->email }}" @endif>
        </div>
    </div>
</div>
