<div>
    <div class="container-fluid">
        <div class="form-row">
            <div class="form-group col-md-12">
                <label for="companyName">Company Name</label>
                <input type="text" class="form-control" id="name"
                       name="name" required  @if($file != null) value="{{ $file->name }}" @endif>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-12">
                <div class="form-group">
                    <label for="companyNo">Company No</label>
                    <input type="text" class="form-control"
                           name="c_no" id="c_no" required
                           @if($file != null) value="{{ $file->c_no }}" @endif>
                </div>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-12">
                <div class="form-group">
                    <label for="doi">Date of Incorporation</label>
                    <input type="date" class="form-control"
                           name="doi" id="dob" required
                           @if($file != null) value="{{ $file->doi }}" @endif>
                </div>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-12">
                <label for="shareholders">Names of Shareholder</label>
                <input type="text" class="form-control"
                       name="shareholders" id="shareholders"
                       required @if($file != null) value="{{ $file->shareholders }}" @endif>
            </div>
        </div>

        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="inputAddress">Physical Address</label>
                <input type="text" class="form-control" id="physicalAddress"
                       name="physical_address" placeholder="1234 Main St" required
                       @if($file != null) value="{{ $file->physical_address }}" @endif>
            </div>
            <div class="form-group col-md-6">
                <label for="inputAddress2">Postal Address</label>
                <input type="text" class="form-control"
                       name="postal_address" id="PostalAddress" required
                       @if($file != null) value="{{ $file->postal_address }}" @endif>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-12">
                <label >Contacts (TEL|CELL|ALTERNATIVE NO)</label>
                <div class="input-group">
                    <input type="tel" @if($file != null) value="{{ $file->tel }}" @endif
                    class="form-control" id="tel" name="tel">
                    <input type="tel" @if($file != null) value="{{ $file->cell }}" @endif
                    class="form-control" name="cell" id="cell">
                    <input type="tel" @if($file != null) value="{{ $file->alt_contact }}" @endif
                    class="form-control" id="tel" name="alt_contact">
                </div>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-12">
                <label for="inputEmail">Email</label>
                <input type="email" class="form-control" id="email"
                       name="email" required @if($file != null) value="{{ $file->email }}" @endif>
            </div>
        </div>

    </div>
</div>
