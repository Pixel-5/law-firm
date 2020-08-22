<div>
    <div class="container-fluid">
        <div class="form-row">
            <div class="form-group col-md-4">
                <label for="inputSurname">Surname</label>
                <input type="text" class="form-control"
                       name="surname" required @if($file != null) value="{{ $file->surname }}" @endif >
            </div>
            <div class="form-group col-md-4">
                <label for="inputName">Name</label>
                <input type="text" class="form-control"
                       name="name" required  @if($file != null) value="{{ $file->name }}" @endif>
            </div>
            <div class="form-group col-md-4">
                <div class="form-group">
                    <label for="gender">ID/Passport Number</label>
                    <input type="text" class="form-control"
                           name="identifier"  required
                           @if($file != null) value="{{ $file->identifier }}" @endif>
                </div>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-4">
                <div class="form-group">
                    <label for="dob">Date of Birth</label>
                    <input type="date" class="form-control"
                           name="dob"
                           @if($file != null) value="{{ $file->dob }}" @endif>
                </div>
            </div>
            <div class="form-group col-md-4">
                <div class="form-group">
                    <label for="gender">Gender</label>
                    <select class="form-control form-control-md"
                            name="gender" >
                        <option disabled>Select</option>
                        <option>@if($file != null) {{ $file->gender == 'Male'? 'Male':'Female' }} @else {{ 'Male' }}@endif</option>
                        <option>@if($file != null) {{ $file->gender == 'Male'? 'Female':'Male' }} @else {{ 'Female' }}@endif </option>
                    </select>
                </div>
            </div>
            <div class="form-group col-md-4">
                <div class="form-group">
                    <label for="gender">Is Citizen?</label>
                    <select class="form-control form-control-md" name="is_citizen" >
                        <option disabled>Select</option>
                        <option>
                            @if($file != null) {{ $file->is_citizen == 1? 'Yes':'No' }} @else {{ 'Yes' }} @endif</option>
                        <option>@if($file != null) {{ $file->is_citizen == 1? 'No':'Yes' }} @else {{ 'No' }} @endif</option>
                    </select>
                </div>
            </div>
        </div>
       <div class="form-row">
           <div class="form-group col-md-4">
               <label for="inputAddress">Nationality</label>
               <input type="text" class="form-control"
                      name="nationality"  @if($file != null) value="{{ $file->nationality }}" @endif>
           </div>
           <div class="form-group col-md-4">
               <label for="inputContact">Marital Status</label>
               <input type="text" class="form-control"
                      name="marital_status"
                       @if($file != null) value="{{ $file->marital_status }}" @endif>
           </div>
       </div>
       <div class="form-row">
           <div class="form-group col-md-4">
               <label for="inputAddress">Occupation</label>
               <input type="text" class="form-control"
                      name="occupation"  @if($file != null) value="{{ $file->occupation }}" @endif>
           </div>
           <div class="form-group col-md-4">
               <label for="inputAddress">Physical Address</label>
               <input type="text" class="form-control"
                      name="physical_address" placeholder="1234 Main St"
                      @if($file != null) value="{{ $file->physical_address }}" @endif>
           </div>
           <div class="form-group col-md-4">
               <label for="inputAddress2">Postal Address</label>
               <input type="text" class="form-control"
                      name="postal_address"
                      @if($file != null) value="{{ $file->postal_address }}" @endif>
           </div>
       </div>
        <div class="form-row">
            <div class="form-group col-md-12">
                <label >Contacts (TEL|FAX|CELL)</label>
                <div class="input-group">
                    <input type="tel" @if($file != null) value="{{ $file->tel }}" @endif
                    class="form-control" name="tel">
                    <input type="tel" @if($file != null) value="{{ $file->fax }}" @endif
                    class="form-control"  name="fax">
                    <input type="tel" @if($file != null) value="{{ $file->cell }}" @endif
                    class="form-control" name="cell">
                </div>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="inputEmail">Email</label>
                <input type="email" class="form-control"
                       name="email"  @if($file != null) value="{{ $file->email }}" @endif>
            </div>
            <div class="form-group col-md-6">
                <label for="inputContact">Preferred Email</label>
                <input type="email" class="form-control"
                       name="preferred_email"
                        @if($file != null) value="{{ $file->preferred_email }}" @endif>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <div class="form-group">
                    <label for="gender">Preferred method of contact</label>
                    <select class="form-control form-control-md"
                            name="preferred_contact" >
                        <option disabled>Select</option>
                        <option>@if($file != null) {{ $file->preferred_contact =='CELL'?'CELL':'TEL' }} @else {{ 'CELL' }} @endif</option>
                        <option>@if($file != null) {{ $file->preferred_contact =='TEL'?'CELL':'FAX' }} @else {{ 'TEL' }} @endif</option>
                        <option>@if($file != null) {{ $file->preferred_contact =='CELL'?'CELL': ($file->preferred_contact =='FAX'? 'CELL':'FAX') }} @else {{ 'FAX' }} @endif</option>
                    </select>
                </div>
            </div>
            <div class="form-group col-md-6">
                <label for="inputAddress2">Preferred methods of receiving invoices</label>
                <select class="form-control form-control-md"
                        name="preferred_invoice" >
                    <option disabled>Select</option>
                    <option>@if($file != null) {{ $file->preferred_invoice == 'contact'?'contact':'email' }} @else {{ 'contact' }} @endif</option>
                    <option>@if($file != null) {{ $file->preferred_invoice == 'contact'?'email':'contact' }} @else {{ 'email' }} @endif</option>
                </select>
            </div>
        </div>
        <div class="form-group">
            <label for="inputAddress2">Name of Spouse (If applicable)</label>
            <input type="text" class="form-control"
                   name="name_spouse"  @if($file != null) value="{{ $file->name_spouse }} @endif">
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="inputAddress2">Name of next of kin</label>
                <input type="text" class="form-control"
                       name="name_next_kin" @if($file != null) value="{{ $file->name_next_kin }}" @endif>
            </div>
            <div class="form-group col-md-6">
                <label for="inputAddress2">Contact of Next of kin</label>
                <input type="text" class="form-control"
                       name="contact_next_kin"  @if($file != null) value="{{ $file->contact_next_kin }}" @endif>
            </div>
        </div>
        @if($file == null)
            <div class="form-group">
                <div class="custom-file">
                    <input type="file"
                           name="docs[]" class="form-control-file"
                            multiple>
                    <label class="custom-file-label" for="validatedCustomFile">
                        Upload supporting docs...</label>
                    <div class="invalid-feedback">Scan Supporting Documents</div>
                </div>
            </div>
        @endif
    </div>
</div>
