<div class="collapse hide" id="collapseCardExample3">
    <div class="card-body">
        <div class="form-row">
            <div class="form-group col-md-12">
                <label for="dob">PLOT NO</label>
                <input type="text" class="form-control"
                       name="plot_no" id="plot_no" required
                       @if($file != null) value="{{ $file->plot_no }}" @endif>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-12">
                <label for="gender">SITUATED AT</label>
                <input type="text" class="form-control" id="situated_at"
                       name="situated_at" required @if($file != null) value="{{ $file->situated_at }}" @endif>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-12">
                <label for="deed">TITLE DEED/CERTIFICATE NO</label>
                <input type="text" class="form-control" id="certificate"
                       name="certificate" required @if($file != null) value="{{ $file->certificate }}" @endif>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-12">
                <label for="gender">Is property bounded?</label>
                <label class="radio-inline"><input type="radio" name="optradio" checked> Yes</label>
                <label class="radio-inline"><input type="radio" name="optradio"> No</label>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-12">
                <label for="inputAddress">Purchase Price</label>
                <input type="text" class="form-control" id="price"
                       name="price" required @if($file != null) value="{{ $file->price }}" @endif>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-12">
                <label for="inputAddress">Initial Payment Amount</label>
                <input type="text" class="form-control" id="initial_payment"
                       name="initial_payment" required
                       @if($file != null) value="{{ $file->initial_payment }}" @endif>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-12">
                <label for="inputAddress2">Other Notes</label>
                <textarea rows="5" cols="80"></textarea>
            </div>
        </div>
    </div>
</div>
