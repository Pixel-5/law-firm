<div class="container-fluid">
    <div class="form-row">
        <div class="form-group col-md-12">
            <label for="inputSurname">Surname</label>
            <input type="text" class="form-control" id="transferor_surname"
                   name="transferor_surname"  @if($file != null) value="{{ $file->surname }}" @endif >
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-12">
            <label for="inputName">Name</label>
            <input type="text" class="form-control" id="transferor_name"
                   name="transferor_name"   @if($file != null) value="{{ $file->name }}" @endif>
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-12">
            <div class="form-group">
                <label for="gender">ID/Passport Number</label>
                <input type="text" class="form-control"
                       name="transferor_identifier" id="transferor_identifier"
                       @if($file != null) value="{{ $file->identifier }}" @endif>
            </div>
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-12">
            <div class="form-group">
                <label for="dob">Date of Birth</label>
                <input type="date" class="form-control"
                       name="transferor_dob" id="transferor_dob"
                       @if($file != null) value="{{ $file->dob }}" @endif>
            </div>
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-12">
            <label for="inputContact">Marital Status</label>
            <input type="text" class="form-control"
                   name="transferor_marital_status" id="transferor_marital_status"
                    @if($file != null) value="{{ $file->marital_status }}" @endif>
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-12">
            <label for="inputAddress">NAME OF SPOUSE</label>
            <input type="text" class="form-control" id="transferor_spouse"
                   name="transferor_spouse"  @if($file != null) value="{{ $file->spouse }}" @endif>
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-6">
            <label for="inputAddress">Physical Address</label>
            <input type="text" class="form-control" id="physicalAddress"
                   name="transferor_physical_address"
                   @if($file != null) value="{{ $file->physical_address }}" @endif>
        </div>
        <div class="form-group col-md-6">
            <label for="inputAddress2">Postal Address</label>
            <input type="text" class="form-control"
                   name="transferor_postal_address" id="PostalAddress"
                   @if($file != null) value="{{ $file->postal_address }}" @endif>
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-12">
            <label >Contacts (TEL|CELL|ALTENATIVE NUMBER)</label>
            <div class="input-group">
                <input type="tel" @if($file != null) value="{{ $file->tel }}" @endif
                class="form-control" id="tel" name="transferor_tel">
                <input type="tel" @if($file != null) value="{{ $file->cell }}" @endif
                class="form-control" name="transferor_cell" id="cell">
                <input type="tel" @if($file != null) value="{{ $file->fax }}" @endif
                class="form-control" id="tel" name="transferor_alt">
            </div>
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-12">
            <label for="inputEmail">Email</label>
            <input type="email" class="form-control" id="transferor_email"
                   name="transferor_email"  @if($file != null) value="{{ $file->email }}" @endif>
        </div>
    </div>
</div>
