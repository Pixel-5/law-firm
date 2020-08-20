<style>
    .hidden
    {
        visibility: hidden;
        display: none;
    }

</style>
<div class="container-fluid">
    <div class="form-row">
        <div class="form-group col-10">
            <select class="form-control form-control-md" id="transferor_type" name="transferor_type" required>
                <option disabled selected value="">Select Transferor Type</option>
                <option>Individual</option>
                <option>Company</option>
            </select>
        </div>
        <div class="form-group col-2">
            <a class="btn btn-xs" id="client_info_transferor" title="Populate client information">
                <i class="fa fa-user-alt" style="color: #0b7dda"></i></a>
            <a class="btn btn-xs" id="transferor_client_info_clear" title="Clear client information">
                <i class="fa fa-times" style="color: red"></i></a>
        </div>
    </div>
</div>
<div class="container-fluid">
    <div class="form-row">
        <div class="form-group col-10">
            <select class="form-control form-control-md" id="transferee_type" name="transferee_type" required>
                <option disabled selected value="">Select Transferee Type</option>
                <option>Individual</option>
                <option>Company</option>
            </select>
        </div>
        <div class="form-group col-2">
            <a class="btn btn-xs" id="client_info_transferee" title="Populate client information">
                <i class="fa fa-user-alt" style="color: #0b7dda"></i></a>
            <a class="btn btn-xs" id="transferee_client_info_clear" title="Clear client information">
                <i class="fa fa-times" style="color: red"></i>
            </a>
        </div>
    </div>
</div>

<form id="individualsConveyancing" method="POST" action="{{ route('admin.conveyancing.store') }}"
      enctype="multipart/form-data">
    @honeypot
    @csrf
    <div class="container-fluid">
        <div class="alert alert-secondary" role="alert">
            TRANSACTION TYPE
        </div>
        <div class="form-row">
            <div class="form-group col-md-3">
                <label class="radio-inline"><input type="radio" name="transfer_type" value="Deed of Sale" checked> Deed of Sale</label>
            </div>
            <div class="form-group col-md-3">
                <label class="radio-inline"><input type="radio" name="transfer_type" value="Transfer"> Transfer</label>
            </div>
            <div class="form-group col-md-3">
                <label class="radio-inline"><input type="radio" name="transfer_type" value="Mortgage"> Mortgage</label>
            </div>
        </div>
        <div class="card mb-4">
            <!-- Card Header - Accordion -->
            <a href="#collapseCardExample1" class="d-block card-header py-2 alert alert-secondary" data-toggle="collapse" role="alert"
               aria-expanded="true" aria-controls="collapseCardExample1" >
                <div class="alert-secondary">
                    DETAILS OF SELLER/TRANSFEROR
                </div>
            </a>
            <!-- Card Content - Collapse -->
            <div class="collapse show" id="collapseCardExample1">
                <div class="card-body">
                    <div id="transferor_individual_form">
                        <x-individualTransferorConveyanceForm file=""/>
                    </div>
                </div>
            </div>
        </div>

        <div class="card shadow mb-4">
            <!-- Card Header - Accordion -->
            <a href="#collapseCardExample2" class="d-block card-header py-2 alert alert-secondary" data-toggle="collapse" role="alert"
               aria-expanded="true" aria-controls="collapseCardExample1" >
                <div class="alert-secondary">
                    DETAILS OF PURCHASER/TRANSFEREE/MORTGAGOR
                </div>
            </a>

            <!-- Card Content - Collapse -->
            <div class="collapse show" id="collapseCardExample2">
                <div class="card-body">
                    <div id="transferee_individual_form">
                        <x-individualTransfereeConveyanceForm file=""/>
                    </div>
                </div>
            </div>
        </div>

        <div class="card shadow mb-4">
            <!-- Card Header - Accordion -->
            <a href="#collapseCardExample3" class="d-block card-header py-2 alert alert-secondary"
               data-toggle="collapse" role="alert" aria-expanded="true" aria-controls="collapseCardExample1">
                <div class="alert-secondary">
                    DETAILS OF A PLOT
                </div>
            </a>
            <!-- Card Content - Collapse -->
            <div class="collapse hide" id="collapseCardExample3">
                <div class="card-body">
                    <div class="container-fluid">
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="dob">PLOT NO</label>
                                <input type="text" class="form-control"
                                       name="plot_no" id="plot_no" required>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="gender">SITUATED AT</label>
                                <input type="text" class="form-control" id="situated_at"
                                       name="situated_at" required>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="deed">TITLE DEED/CERTIFICATE NO</label>
                                <input type="text" class="form-control" id="certificate"
                                       name="certificate" required >
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="gender">Is property bounded?</label>
                                <label class="radio-inline"><input type="radio" name="optradio" value="Yes"> Yes</label>
                                <label class="radio-inline"><input type="radio" name="optradio" value="No" checked> No</label>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="inputAddress">Purchase Price</label>
                                <input type="text" class="form-control" id="price"
                                       name="price" required>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="inputAddress">Initial Payment Amount</label>
                                <input type="text" class="form-control" id="initial_payment"
                                       name="initial_payment" required>
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
            </div>
        </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save</button>
    </div>
    </div>
</form>
<form id="companiesConveyancing" method="POST" action="{{ route('admin.conveyancing.store') }}"
      enctype="multipart/form-data">
    @honeypot
    @csrf
    <div class="container-fluid">
        <div class="alert alert-secondary" role="alert">
            TRANSACTION TYPE
        </div>
        <div class="form-row">
            <div class="form-group col-md-3">
                <label class="radio-inline"><input type="radio" name="transfer_type" value="Deed of Sale" checked> Deed of Sale</label>
            </div>
            <div class="form-group col-md-3">
                <label class="radio-inline"><input type="radio" name="transfer_type" value="Transfer"> Transfer</label>
            </div>
            <div class="form-group col-md-3">
                <label class="radio-inline"><input type="radio" name="transfer_type" value="Mortgage"> Mortgage</label>
            </div>
        </div>

        <div class="card mb-4">
            <!-- Card Header - Accordion -->
            <a href="#collapseCardExample1" class="d-block card-header py-2 alert alert-secondary" data-toggle="collapse" role="alert"
               aria-expanded="true" aria-controls="collapseCardExample1" >
                <div class="alert-secondary">
                    DETAILS OF SELLER/TRANSFEROR
                </div>
            </a>
            <!-- Card Content - Collapse -->
            <div class="collapse show" id="collapseCardExample1">
                <div class="card-body">
                    <div id="transferor_company_form">
                        <x-companyTransferorConveyanceForm file=""/>
                    </div>
                </div>
            </div>
        </div>

        <div class="card shadow mb-4">
            <!-- Card Header - Accordion -->
            <a href="#collapseCardExample2" class="d-block card-header py-2 alert alert-secondary" data-toggle="collapse" role="alert"
               aria-expanded="true" aria-controls="collapseCardExample1" >
                <div class="alert-secondary">
                    DETAILS OF PURCHASER/TRANSFEREE/MORTGAGOR
                </div>
            </a>

            <!-- Card Content - Collapse -->
            <div class="collapse show" id="collapseCardExample2">
                <div class="card-body">
                    <div id="transferee_company_form">
                        <x-companyTransfereeConveyanceForm file=""/>
                    </div>
                </div>
            </div>
        </div>
        <div class="card shadow mb-4">
            <!-- Card Header - Accordion -->
            <a href="#collapseCardExample3" class="d-block card-header py-2 alert alert-secondary"
               data-toggle="collapse" role="alert" aria-expanded="true" aria-controls="collapseCardExample1">
                <div class="alert-secondary">
                    DETAILS OF A PLOT
                </div>
            </a>
            <!-- Card Content - Collapse -->
            <div class="collapse hide" id="collapseCardExample3">
                <div class="card-body">
                    <div class="container-fluid">
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="dob">PLOT NO</label>
                                <input type="text" class="form-control"
                                       name="plot_no" id="plot_no" required>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="gender">SITUATED AT</label>
                                <input type="text" class="form-control" id="situated_at"
                                       name="situated_at" required>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="deed">TITLE DEED/CERTIFICATE NO</label>
                                <input type="text" class="form-control" id="certificate"
                                       name="certificate" required >
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="gender">Is property bounded?</label>
                                <label class="radio-inline"><input type="radio" name="optradio" value="Yes"> Yes</label>
                                <label class="radio-inline"><input type="radio" name="optradio" value="No" checked> No</label>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="inputAddress">Purchase Price</label>
                                <input type="text" class="form-control" id="price"
                                       name="price" required>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="inputAddress">Initial Payment Amount</label>
                                <input type="text" class="form-control" id="initial_payment"
                                       name="initial_payment" required>
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
            </div>
        </div>
    </div>

    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save</button>
    </div>
</form>
<form id="individualCompanyconveyancing" method="POST" action="{{ route('admin.conveyancing.store') }}"
      enctype="multipart/form-data">
    @honeypot
    @csrf
    <div class="container-fluid">
        <div class="alert alert-secondary" role="alert">
            TRANSACTION TYPE
        </div>
        <div class="form-row">
            <div class="form-group col-md-3">
                <label class="radio-inline"><input type="radio" name="transfer_type" value="Deed of Sale" checked> Deed of Sale</label>
            </div>
            <div class="form-group col-md-3">
                <label class="radio-inline"><input type="radio" name="transfer_type" value="Transfer"> Transfer</label>
            </div>
            <div class="form-group col-md-3">
                <label class="radio-inline"><input type="radio" name="transfer_type" value="Mortgage"> Mortgage</label>
            </div>
        </div>

        <div class="card mb-4">
            <!-- Card Header - Accordion -->
            <a href="#collapseCardExample1" class="d-block card-header py-2 alert alert-secondary" data-toggle="collapse" role="alert"
               aria-expanded="true" aria-controls="collapseCardExample1" >
                <div class="alert-secondary">
                    DETAILS OF SELLER/TRANSFEROR
                </div>
            </a>
            <!-- Card Content - Collapse -->
            <div class="collapse show" id="collapseCardExample1">
                <div class="card-body">
                    <div id="transferor_individual_form">
                        <x-individualTransferorConveyanceForm file=""/>
                    </div>
                </div>
            </div>
        </div>

        <div class="card shadow mb-4">
            <!-- Card Header - Accordion -->
            <a href="#collapseCardExample2" class="d-block card-header py-2 alert alert-secondary" data-toggle="collapse" role="alert"
               aria-expanded="true" aria-controls="collapseCardExample1" >
                <div class="alert-secondary">
                    DETAILS OF PURCHASER/TRANSFEREE/MORTGAGOR
                </div>
            </a>
            <!-- Card Content - Collapse -->
            <div class="collapse show" id="collapseCardExample2">
                <div id="transferee_company_form">
                    <x-companyTransfereeConveyanceForm file=""/>
                </div>
            </div>
        </div>
        <div class="card shadow mb-4">
            <!-- Card Header - Accordion -->
            <a href="#collapseCardExample3" class="d-block card-header py-2 alert alert-secondary"
               data-toggle="collapse" role="alert" aria-expanded="true" aria-controls="collapseCardExample1">
                <div class="alert-secondary">
                    DETAILS OF A PLOT
                </div>
            </a>
            <!-- Card Content - Collapse -->
            <div class="collapse hide" id="collapseCardExample3">
                <div class="card-body">
                    <div class="container">
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="dob">PLOT NO</label>
                                <input type="text" class="form-control"
                                       name="plot_no" id="plot_no" required>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="gender">SITUATED AT</label>
                                <input type="text" class="form-control" id="situated_at"
                                       name="situated_at" required>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="deed">TITLE DEED/CERTIFICATE NO</label>
                                <input type="text" class="form-control" id="certificate"
                                       name="certificate" required >
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="gender">Is property bounded?</label>
                                <label class="radio-inline"><input type="radio" name="optradio" value="Yes"> Yes</label>
                                <label class="radio-inline"><input type="radio" name="optradio" value="No" checked> No</label>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="inputAddress">Purchase Price</label>
                                <input type="text" class="form-control" id="price"
                                       name="price" required>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="inputAddress">Initial Payment Amount</label>
                                <input type="text" class="form-control" id="initial_payment"
                                       name="initial_payment" required>
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
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save</button>
    </div>
</form>
<form id="companyIndividualconveyancing" method="POST" action="{{ route('admin.conveyancing.store') }}"
      enctype="multipart/form-data">
    @honeypot
    @csrf
    <div class="container-fluid">
        <div class="alert alert-secondary" role="alert">
            TRANSACTION TYPE
        </div>
        <div class="form-row">
            <div class="form-group col-md-3">
                <label class="radio-inline"><input type="radio" name="transfer_type" value="Deed of Sale" checked> Deed of Sale</label>
            </div>
            <div class="form-group col-md-3">
                <label class="radio-inline"><input type="radio" name="transfer_type" value="Transfer"> Transfer</label>
            </div>
            <div class="form-group col-md-3">
                <label class="radio-inline"><input type="radio" name="transfer_type" value="Mortgage"> Mortgage</label>
            </div>
        </div>
        <div class="card mb-4">
            <!-- Card Header - Accordion -->
            <a href="#collapseCardExample1" class="d-block card-header py-2 alert alert-secondary" data-toggle="collapse" role="alert"
               aria-expanded="true" aria-controls="collapseCardExample1" >
                <div class="alert-secondary">
                    DETAILS OF SELLER/TRANSFEROR
                </div>
            </a>
            <!-- Card Content - Collapse -->
            <div class="collapse show" id="collapseCardExample1">
                <div class="card-body">
                    <div id="transferor_company_form">
                        <x-companyTransferorConveyanceForm file=""/>
                    </div>
                </div>
            </div>
        </div>

        <div class="card shadow mb-4">
            <!-- Card Header - Accordion -->
            <a href="#collapseCardExample2" class="d-block card-header py-2 alert alert-secondary" data-toggle="collapse" role="alert"
               aria-expanded="true" aria-controls="collapseCardExample1" >
                <div class="alert-secondary">
                    DETAILS OF PURCHASER/TRANSFEREE/MORTGAGOR
                </div>
            </a>
            <!-- Card Content - Collapse -->
            <div class="collapse show" id="collapseCardExample2">
                <div class="card-body">
                    <div id="transferee_company_form">
                        <x-individualTransfereeConveyanceForm file=""/>
                    </div>
                </div>
            </div>
        </div>
        <div class="card shadow mb-4">
            <!-- Card Header - Accordion -->
            <a href="#collapseCardExample3" class="d-block card-header py-2 alert alert-secondary"
               data-toggle="collapse" role="alert" aria-expanded="true" aria-controls="collapseCardExample1">
                <div class="alert-secondary">
                    DETAILS OF A PLOT
                </div>
            </a>
            <!-- Card Content - Collapse -->
            <div class="collapse hide" id="collapseCardExample3">
                <div class="card-body">
                    <div class="container">
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="dob">PLOT NO</label>
                                <input type="text" class="form-control"
                                       name="plot_no" id="plot_no" required>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="gender">SITUATED AT</label>
                                <input type="text" class="form-control" id="situated_at"
                                       name="situated_at" required>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="deed">TITLE DEED/CERTIFICATE NO</label>
                                <input type="text" class="form-control" id="certificate"
                                       name="certificate" required >
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="gender">Is property bounded?</label>
                                <label class="radio-inline"><input type="radio" name="optradio" value="Yes"> Yes</label>
                                <label class="radio-inline"><input type="radio" name="optradio" value="No" checked> No</label>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="inputAddress">Purchase Price</label>
                                <input type="text" class="form-control" id="price"
                                       name="price" required>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="inputAddress">Initial Payment Amount</label>
                                <input type="text" class="form-control" id="initial_payment"
                                       name="initial_payment" required>
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
            </div>
        </div>
    </div>

    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save</button>
    </div>
</form>

<form id="individualsTransferorConveyancing_data" method="POST" action="{{ route('admin.conveyancing.store') }}"
      enctype="multipart/form-data">
    @honeypot
    @csrf
    <div class="container-fluid">
        <div class="alert alert-secondary" role="alert">
            TRANSACTION TYPE
        </div>
        <div class="form-row">
            <div class="form-group col-md-3">
                <label class="radio-inline"><input type="radio" name="transfer_type" value="Deed of Sale" checked> Deed of Sale</label>
            </div>
            <div class="form-group col-md-3">
                <label class="radio-inline"><input type="radio" name="transfer_type" value="Transfer"> Transfer</label>
            </div>
            <div class="form-group col-md-3">
                <label class="radio-inline"><input type="radio" name="transfer_type" value="Mortgage"> Mortgage</label>
            </div>
        </div>

        <div class="card mb-4">
            <!-- Card Header - Accordion -->
            <a href="#collapseCardExample1" class="d-block card-header py-2 alert alert-secondary" data-toggle="collapse" role="alert"
               aria-expanded="true" aria-controls="collapseCardExample1" >
                <div class="alert-secondary">
                    DETAILS OF SELLER/TRANSFEROR
                </div>
            </a>
            <!-- Card Content - Collapse -->
            <div class="collapse show" id="collapseCardExample1">
                <div class="card-body">
                    <div id="transferor_individual_form_data">
                        <x-individualTransferorConveyanceForm :file="$file"/>
                    </div>
                </div>
            </div>
        </div>

        <div class="card shadow mb-4">
            <!-- Card Header - Accordion -->
            <a href="#collapseCardExample2" class="d-block card-header py-2 alert alert-secondary" data-toggle="collapse" role="alert"
               aria-expanded="true" aria-controls="collapseCardExample1" >
                <div class="alert-secondary">
                    DETAILS OF PURCHASER/TRANSFEREE/MORTGAGOR
                </div>
            </a>

            <!-- Card Content - Collapse -->
            <div class="collapse show" id="collapseCardExample2">
                <div class="card-body">
                    <div id="transferee_individual_form">
                        <x-individualTransfereeConveyanceForm file=""/>
                    </div>
                </div>
            </div>
        </div>
        <div class="card shadow mb-4">
            <!-- Card Header - Accordion -->
            <a href="#collapseCardExample3" class="d-block card-header py-2 alert alert-secondary"
               data-toggle="collapse" role="alert" aria-expanded="true" aria-controls="collapseCardExample1">
                <div class="alert-secondary">
                    DETAILS OF A PLOT
                </div>
            </a>
            <!-- Card Content - Collapse -->
            <div class="collapse hide" id="collapseCardExample3">
                <div class="card-body">
                    <div class="container">
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="dob">PLOT NO</label>
                                <input type="text" class="form-control"
                                       name="plot_no" id="plot_no" required>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="gender">SITUATED AT</label>
                                <input type="text" class="form-control" id="situated_at"
                                       name="situated_at" required>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="deed">TITLE DEED/CERTIFICATE NO</label>
                                <input type="text" class="form-control" id="certificate"
                                       name="certificate" required >
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="gender">Is property bounded?</label>
                                <label class="radio-inline"><input type="radio" name="optradio" value="Yes"> Yes</label>
                                <label class="radio-inline"><input type="radio" name="optradio" value="No" checked> No</label>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="inputAddress">Purchase Price</label>
                                <input type="text" class="form-control" id="price"
                                       name="price" required>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="inputAddress">Initial Payment Amount</label>
                                <input type="text" class="form-control" id="initial_payment"
                                       name="initial_payment" required>
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
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save</button>
    </div>
</form>
<form id="individualsTransfereeConveyancing_data" method="POST" action="{{ route('admin.conveyancing.store') }}"
      enctype="multipart/form-data">
    @honeypot
    @csrf
    <div class="container-fluid">
        <div class="alert alert-secondary" role="alert">
            TRANSACTION TYPE
        </div>
        <div class="form-row">
            <div class="form-group col-md-3">
                <label class="radio-inline"><input type="radio" name="transfer_type" value="Deed of Sale" checked> Deed of Sale</label>
            </div>
            <div class="form-group col-md-3">
                <label class="radio-inline"><input type="radio" name="transfer_type" value="Transfer"> Transfer</label>
            </div>
            <div class="form-group col-md-3">
                <label class="radio-inline"><input type="radio" name="transfer_type" value="Mortgage"> Mortgage</label>
            </div>
        </div>

        <div class="card mb-4">
            <!-- Card Header - Accordion -->
            <a href="#collapseCardExample1" class="d-block card-header py-2 alert alert-secondary" data-toggle="collapse" role="alert"
               aria-expanded="true" aria-controls="collapseCardExample1" >
                <div class="alert-secondary">
                    DETAILS OF SELLER/TRANSFEROR
                </div>
            </a>
            <!-- Card Content - Collapse -->
            <div class="collapse show" id="collapseCardExample1">
                <div class="card-body">
                    <div id="transferor_individual_form_data">
                        <x-individualTransferorConveyanceForm file=""/>
                    </div>
                </div>
            </div>
        </div>

        <div class="card shadow mb-4">
            <!-- Card Header - Accordion -->
            <a href="#collapseCardExample2" class="d-block card-header py-2 alert alert-secondary" data-toggle="collapse" role="alert"
               aria-expanded="true" aria-controls="collapseCardExample1" >
                <div class="alert-secondary">
                    DETAILS OF PURCHASER/TRANSFEREE/MORTGAGOR
                </div>
            </a>

            <!-- Card Content - Collapse -->
            <div class="collapse show" id="collapseCardExample2">
                <div class="card-body">
                    <div id="transferee_individual_form">
                        <x-individualTransfereeConveyanceForm :file="$file"/>
                    </div>
                </div>
            </div>
        </div>
        <div class="card shadow mb-4">
            <!-- Card Header - Accordion -->
            <a href="#collapseCardExample3" class="d-block card-header py-2 alert alert-secondary"
               data-toggle="collapse" role="alert" aria-expanded="true" aria-controls="collapseCardExample1">
                <div class="alert-secondary">
                    DETAILS OF A PLOT
                </div>
            </a>
            <!-- Card Content - Collapse -->
            <div class="collapse hide" id="collapseCardExample3">
                <div class="card-body">
                    <div class="container">
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="dob">PLOT NO</label>
                                <input type="text" class="form-control"
                                       name="plot_no" id="plot_no" required>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="gender">SITUATED AT</label>
                                <input type="text" class="form-control" id="situated_at"
                                       name="situated_at" required>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="deed">TITLE DEED/CERTIFICATE NO</label>
                                <input type="text" class="form-control" id="certificate"
                                       name="certificate" required >
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="gender">Is property bounded?</label>
                                <label class="radio-inline"><input type="radio" name="optradio" value="Yes"> Yes</label>
                                <label class="radio-inline"><input type="radio" name="optradio" value="No" checked> No</label>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="inputAddress">Purchase Price</label>
                                <input type="text" class="form-control" id="price"
                                       name="price" required>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="inputAddress">Initial Payment Amount</label>
                                <input type="text" class="form-control" id="initial_payment"
                                       name="initial_payment" required>
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
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save</button>
    </div>
</form>

<form id="companiesTransferorConveyancing_data" method="POST" action="{{ route('admin.conveyancing.store') }}"
      enctype="multipart/form-data">
    @honeypot
    @csrf
    <div class="container-fluid">
        <div class="alert alert-secondary" role="alert">
            TRANSACTION TYPE
        </div>
        <div class="form-row">
            <div class="form-group col-md-3">
                <label class="radio-inline"><input type="radio" name="transfer_type" value="Deed of Sale" checked> Deed of Sale</label>
            </div>
            <div class="form-group col-md-3">
                <label class="radio-inline"><input type="radio" name="transfer_type" value="Transfer"> Transfer</label>
            </div>
            <div class="form-group col-md-3">
                <label class="radio-inline"><input type="radio" name="transfer_type" value="Mortgage"> Mortgage</label>
            </div>
        </div>
        <div class="card mb-4">
            <!-- Card Header - Accordion -->
            <a href="#collapseCardExample1" class="d-block card-header py-2 alert alert-secondary" data-toggle="collapse" role="alert"
               aria-expanded="true" aria-controls="collapseCardExample1" >
                <div class="alert-secondary">
                    DETAILS OF SELLER/TRANSFEROR
                </div>
            </a>
            <!-- Card Content - Collapse -->
            <div class="collapse show" id="collapseCardExample1">
                <div class="card-body">
                    <div id="transferor_company_form_data">
                        <x-companyTransferorConveyanceForm :file="$file"/>
                    </div>
                </div>
            </div>
        </div>
        <div class="card shadow mb-4">
            <!-- Card Header - Accordion -->
            <a href="#collapseCardExample2" class="d-block card-header py-2 alert alert-secondary" data-toggle="collapse" role="alert"
               aria-expanded="true" aria-controls="collapseCardExample1" >
                <div class="alert-secondary">
                    DETAILS OF PURCHASER/TRANSFEREE/MORTGAGOR
                </div>
            </a>

            <!-- Card Content - Collapse -->
            <div class="collapse show" id="collapseCardExample2">
                <div class="card-body">
                    <div id="transferee_company_form_data">
                        <x-companyTransfereeConveyanceForm file=""/>
                    </div>
                </div>
            </div>
        </div>
        <div class="card shadow mb-4">
            <!-- Card Header - Accordion -->
            <a href="#collapseCardExample3" class="d-block card-header py-2 alert alert-secondary"
               data-toggle="collapse" role="alert" aria-expanded="true" aria-controls="collapseCardExample1">
                <div class="alert-secondary">
                    DETAILS OF A PLOT
                </div>
            </a>
            <!-- Card Content - Collapse -->
            <div class="collapse hide" id="collapseCardExample3">
                <div class="card-body">
                    <div class="container">
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="dob">PLOT NO</label>
                                <input type="text" class="form-control"
                                       name="plot_no" id="plot_no" required>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="gender">SITUATED AT</label>
                                <input type="text" class="form-control" id="situated_at"
                                       name="situated_at" required>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="deed">TITLE DEED/CERTIFICATE NO</label>
                                <input type="text" class="form-control" id="certificate"
                                       name="certificate" required >
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="gender">Is property bounded?</label>
                                <label class="radio-inline"><input type="radio" name="optradio" value="Yes"> Yes</label>
                                <label class="radio-inline"><input type="radio" name="optradio" value="No" checked> No</label>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="inputAddress">Purchase Price</label>
                                <input type="text" class="form-control" id="price"
                                       name="price" required>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="inputAddress">Initial Payment Amount</label>
                                <input type="text" class="form-control" id="initial_payment"
                                       name="initial_payment" required>
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
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save</button>
    </div>
</form>
<form id="companiesTransfereeConveyancing_data" method="POST" action="{{ route('admin.conveyancing.store') }}"
      enctype="multipart/form-data">
    @honeypot
    @csrf
    <div class="container-fluid">
        <div class="alert alert-secondary" role="alert">
            TRANSACTION TYPE
        </div>
        <div class="form-row">
            <div class="form-group col-md-3">
                <label class="radio-inline"><input type="radio" name="transfer_type" value="Deed of Sale" checked> Deed of Sale</label>
            </div>
            <div class="form-group col-md-3">
                <label class="radio-inline"><input type="radio" name="transfer_type" value="Transfer"> Transfer</label>
            </div>
            <div class="form-group col-md-3">
                <label class="radio-inline"><input type="radio" name="transfer_type" value="Mortgage"> Mortgage</label>
            </div>
        </div>

        <div class="card mb-4">
            <!-- Card Header - Accordion -->
            <a href="#collapseCardExample1" class="d-block card-header py-2 alert alert-secondary" data-toggle="collapse" role="alert"
               aria-expanded="true" aria-controls="collapseCardExample1" >
                <div class="alert-secondary">
                    DETAILS OF SELLER/TRANSFEROR
                </div>
            </a>
            <!-- Card Content - Collapse -->
            <div class="collapse show" id="collapseCardExample1">
                <div class="card-body">
                    <div id="transferor_company_form_data">
                        <x-companyTransferorConveyanceForm file=""/>
                    </div>
                </div>
            </div>
        </div>

        <div class="card shadow mb-4">
            <!-- Card Header - Accordion -->
            <a href="#collapseCardExample2" class="d-block card-header py-2 alert alert-secondary" data-toggle="collapse" role="alert"
               aria-expanded="true" aria-controls="collapseCardExample1" >
                <div class="alert-secondary">
                    DETAILS OF PURCHASER/TRANSFEREE/MORTGAGOR
                </div>
            </a>

            <!-- Card Content - Collapse -->
            <div class="collapse show" id="collapseCardExample2">
                <div class="card-body">
                    <div id="transferee_company_form_data">
                        <x-companyTransfereeConveyanceForm :file="$file"/>
                    </div>
                </div>
            </div>
        </div>
        <div class="card shadow mb-4">
            <!-- Card Header - Accordion -->
            <a href="#collapseCardExample3" class="d-block card-header py-2 alert alert-secondary"
               data-toggle="collapse" role="alert" aria-expanded="true" aria-controls="collapseCardExample1">
                <div class="alert-secondary">
                    DETAILS OF A PLOT
                </div>
            </a>
            <!-- Card Content - Collapse -->
            <div class="collapse hide" id="collapseCardExample3">
                <div class="card-body">
                    <div class="container">
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="dob">PLOT NO</label>
                                <input type="text" class="form-control"
                                       name="plot_no" id="plot_no" required>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="gender">SITUATED AT</label>
                                <input type="text" class="form-control" id="situated_at"
                                       name="situated_at" required>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="deed">TITLE DEED/CERTIFICATE NO</label>
                                <input type="text" class="form-control" id="certificate"
                                       name="certificate" required >
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="gender">Is property bounded?</label>
                                <label class="radio-inline"><input type="radio" name="optradio" value="Yes"> Yes</label>
                                <label class="radio-inline"><input type="radio" name="optradio" value="No" checked> No</label>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="inputAddress">Purchase Price</label>
                                <input type="text" class="form-control" id="price"
                                       name="price" required>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="inputAddress">Initial Payment Amount</label>
                                <input type="text" class="form-control" id="initial_payment"
                                       name="initial_payment" required>
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
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save</button>
    </div>
</form>

<form id="individualTransferorCompanyconveyancing_data" method="POST" action="{{ route('admin.conveyancing.store') }}"
      enctype="multipart/form-data">
    @honeypot
    @csrf
    <div class="container-fluid">
        <div class="alert alert-secondary" role="alert">
            TRANSACTION TYPE
        </div>
        <div class="form-row">
            <div class="form-group col-md-3">
                <label class="radio-inline"><input type="radio" name="transfer_type" value="Deed of Sale" checked> Deed of Sale</label>
            </div>
            <div class="form-group col-md-3">
                <label class="radio-inline"><input type="radio" name="transfer_type" value="Transfer"> Transfer</label>
            </div>
            <div class="form-group col-md-3">
                <label class="radio-inline"><input type="radio" name="transfer_type" value="Mortgage"> Mortgage</label>
            </div>
        </div>
        <div class="card mb-4">
            <!-- Card Header - Accordion -->
            <a href="#collapseCardExample1" class="d-block card-header py-2 alert alert-secondary" data-toggle="collapse" role="alert"
               aria-expanded="true" aria-controls="collapseCardExample1" >
                <div class="alert-secondary">
                    DETAILS OF SELLER/TRANSFEROR
                </div>
            </a>
            <!-- Card Content - Collapse -->
            <div class="collapse show" id="collapseCardExample1">
                <div class="card-body">
                    <div id="transferor_individual_form_data">
                        <x-individualTransferorConveyanceForm :file="$file"/>
                    </div>
                </div>
            </div>
        </div>
        <div class="card shadow mb-4">
            <!-- Card Header - Accordion -->
            <a href="#collapseCardExample2" class="d-block card-header py-2 alert alert-secondary" data-toggle="collapse" role="alert"
               aria-expanded="true" aria-controls="collapseCardExample1" >
                <div class="alert-secondary">
                    DETAILS OF PURCHASER/TRANSFEREE/MORTGAGOR
                </div>
            </a>
            <!-- Card Content - Collapse -->
            <div class="collapse show" id="collapseCardExample2">
                <div id="transferee_company_form">
                    <x-companyTransfereeConveyanceForm file=""/>
                </div>
            </div>
        </div>
        <div class="card shadow mb-4">
            <!-- Card Header - Accordion -->
            <a href="#collapseCardExample3" class="d-block card-header py-2 alert alert-secondary"
               data-toggle="collapse" role="alert" aria-expanded="true" aria-controls="collapseCardExample1">
                <div class="alert-secondary">
                    DETAILS OF A PLOT
                </div>
            </a>
            <!-- Card Content - Collapse -->
            <div class="collapse hide" id="collapseCardExample3">
                <div class="card-body">
                    <div class="container">
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="dob">PLOT NO</label>
                                <input type="text" class="form-control"
                                       name="plot_no" id="plot_no" required>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="gender">SITUATED AT</label>
                                <input type="text" class="form-control" id="situated_at"
                                       name="situated_at" required>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="deed">TITLE DEED/CERTIFICATE NO</label>
                                <input type="text" class="form-control" id="certificate"
                                       name="certificate" required >
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="gender">Is property bounded?</label>
                                <label class="radio-inline"><input type="radio" name="optradio" value="Yes"> Yes</label>
                                <label class="radio-inline"><input type="radio" name="optradio" value="No" checked> No</label>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="inputAddress">Purchase Price</label>
                                <input type="text" class="form-control" id="price"
                                       name="price" required>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="inputAddress">Initial Payment Amount</label>
                                <input type="text" class="form-control" id="initial_payment"
                                       name="initial_payment" required>
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
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save</button>
    </div>
</form>
<form id="individualTransfereeCompanyconveyancing_data" method="POST" action="{{ route('admin.conveyancing.store') }}"
      enctype="multipart/form-data">
    @honeypot
    @csrf
    <div class="container-fluid">
        <div class="alert alert-secondary" role="alert">
            TRANSACTION TYPE
        </div>
        <div class="form-row">
            <div class="form-group col-md-3">
                <label class="radio-inline"><input type="radio" name="transfer_type" value="Deed of Sale" checked> Deed of Sale</label>
            </div>
            <div class="form-group col-md-3">
                <label class="radio-inline"><input type="radio" name="transfer_type" value="Transfer"> Transfer</label>
            </div>
            <div class="form-group col-md-3">
                <label class="radio-inline"><input type="radio" name="transfer_type" value="Mortgage"> Mortgage</label>
            </div>
        </div>

        <div class="card mb-4">
            <!-- Card Header - Accordion -->
            <a href="#collapseCardExample1" class="d-block card-header py-2 alert alert-secondary" data-toggle="collapse" role="alert"
               aria-expanded="true" aria-controls="collapseCardExample1" >
                <div class="alert-secondary">
                    DETAILS OF SELLER/TRANSFEROR
                </div>
            </a>
            <!-- Card Content - Collapse -->
            <div class="collapse show" id="collapseCardExample1">
                <div class="card-body">
                    <div id="transferor_company_form_data">
                        <x-companyTransfereeConveyanceForm file=""/>
                    </div>
                </div>
            </div>
        </div>

        <div class="card shadow mb-4">
            <!-- Card Header - Accordion -->
            <a href="#collapseCardExample2" class="d-block card-header py-2 alert alert-secondary" data-toggle="collapse" role="alert"
               aria-expanded="true" aria-controls="collapseCardExample1" >
                <div class="alert-secondary">
                    DETAILS OF PURCHASER/TRANSFEREE/MORTGAGOR
                </div>
            </a>
            <!-- Card Content - Collapse -->
            <div class="collapse show" id="collapseCardExample2">
                <div id="transferee_individual_form_data">
                    <x-individualTransferorConveyanceForm :file="$file"/>
                </div>
            </div>
        </div>
        <div class="card shadow mb-4">
            <!-- Card Header - Accordion -->
            <a href="#collapseCardExample3" class="d-block card-header py-2 alert alert-secondary"
               data-toggle="collapse" role="alert" aria-expanded="true" aria-controls="collapseCardExample1">
                <div class="alert-secondary">
                    DETAILS OF A PLOT
                </div>
            </a>
            <!-- Card Content - Collapse -->
            <div class="collapse hide" id="collapseCardExample3">
                <div class="card-body">
                    <div class="container">
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="dob">PLOT NO</label>
                                <input type="text" class="form-control"
                                       name="plot_no" id="plot_no" required>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="gender">SITUATED AT</label>
                                <input type="text" class="form-control" id="situated_at"
                                       name="situated_at" required>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="deed">TITLE DEED/CERTIFICATE NO</label>
                                <input type="text" class="form-control" id="certificate"
                                       name="certificate" required >
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="gender">Is property bounded?</label>
                                <label class="radio-inline"><input type="radio" name="optradio" value="Yes"> Yes</label>
                                <label class="radio-inline"><input type="radio" name="optradio" value="No" checked> No</label>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="inputAddress">Purchase Price</label>
                                <input type="text" class="form-control" id="price"
                                       name="price" required>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="inputAddress">Initial Payment Amount</label>
                                <input type="text" class="form-control" id="initial_payment"
                                       name="initial_payment" required>
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
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save</button>
    </div>
</form>

<form id="companyTransferorIndividualconveyancing_data" method="POST" action=" {{ route('admin.conveyancing.store') }}"
      enctype="multipart/form-data">
    @honeypot
    @csrf
    <div class="container-fluid">
        <div class="alert alert-secondary" role="alert">
            TRANSACTION TYPE
        </div>
        <div class="form-row">
            <div class="form-group col-md-3">
                <label class="radio-inline"><input type="radio" name="transfer_type" value="Deed of Sale" checked> Deed of Sale</label>
            </div>
            <div class="form-group col-md-3">
                <label class="radio-inline"><input type="radio" name="transfer_type" value="Transfer"> Transfer</label>
            </div>
            <div class="form-group col-md-3">
                <label class="radio-inline"><input type="radio" name="transfer_type" value="Mortgage"> Mortgage</label>
            </div>
        </div>

        <div class="card mb-4">
            <!-- Card Header - Accordion -->
            <a href="#collapseCardExample1" class="d-block card-header py-2 alert alert-secondary" data-toggle="collapse" role="alert"
               aria-expanded="true" aria-controls="collapseCardExample1" >
                <div class="alert-secondary">
                    DETAILS OF SELLER/TRANSFEROR
                </div>
            </a>
            <!-- Card Content - Collapse -->
            <div class="collapse show" id="collapseCardExample1">
                <div class="card-body">
                    <div id="transferor_company_form_data">
                        <x-companyTransferorConveyanceForm :file="$file"/>
                    </div>
                </div>
            </div>
        </div>

        <div class="card shadow mb-4">
            <!-- Card Header - Accordion -->
            <a href="#collapseCardExample2" class="d-block card-header py-2 alert alert-secondary" data-toggle="collapse" role="alert"
               aria-expanded="true" aria-controls="collapseCardExample1" >
                <div class="alert-secondary">
                    DETAILS OF PURCHASER/TRANSFEREE/MORTGAGOR
                </div>
            </a>
            <!-- Card Content - Collapse -->
            <div class="collapse show" id="collapseCardExample2">
                <div class="card-body">
                    <div id="transferor_individual_form">
                        <x-individualTransferorConveyanceForm file=""/>
                    </div>
                </div>
            </div>
        </div>
        <div class="card shadow mb-4">
            <!-- Card Header - Accordion -->
            <a href="#collapseCardExample3" class="d-block card-header py-2 alert alert-secondary"
               data-toggle="collapse" role="alert" aria-expanded="true" aria-controls="collapseCardExample1">
                <div class="alert-secondary">
                    DETAILS OF A PLOT
                </div>
            </a>
            <!-- Card Content - Collapse -->
            <div class="collapse hide" id="collapseCardExample3">
                <div class="card-body">
                    <div class="container">
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="dob">PLOT NO</label>
                                <input type="text" class="form-control"
                                       name="plot_no" id="plot_no" required>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="gender">SITUATED AT</label>
                                <input type="text" class="form-control" id="situated_at"
                                       name="situated_at" required>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="deed">TITLE DEED/CERTIFICATE NO</label>
                                <input type="text" class="form-control" id="certificate"
                                       name="certificate" required >
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="gender">Is property bounded?</label>
                                <label class="radio-inline"><input type="radio" name="optradio" value="Yes"> Yes</label>
                                <label class="radio-inline"><input type="radio" name="optradio" value="No" checked> No</label>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="inputAddress">Purchase Price</label>
                                <input type="text" class="form-control" id="price"
                                       name="price" required>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="inputAddress">Initial Payment Amount</label>
                                <input type="text" class="form-control" id="initial_payment"
                                       name="initial_payment" required>
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
            </div>
        </div>
    </div>

    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save</button>
    </div>
</form>
<form id="companyTransfereeIndividualconveyancing_data" method="POST" action=" {{ route('admin.conveyancing.store') }}"
      enctype="multipart/form-data">
    @honeypot
    @csrf
    <div class="container-fluid">
        <div class="alert alert-secondary" role="alert">
            TRANSACTION TYPE
        </div>
        <div class="form-row">
            <div class="form-group col-md-3">
                <label class="radio-inline"><input type="radio" name="transfer_type" value="Deed of Sale" checked> Deed of Sale</label>
            </div>
            <div class="form-group col-md-3">
                <label class="radio-inline"><input type="radio" name="transfer_type" value="Transfer"> Transfer</label>
            </div>
            <div class="form-group col-md-3">
                <label class="radio-inline"><input type="radio" name="transfer_type" value="Mortgage"> Mortgage</label>
            </div>
        </div>

        <div class="card mb-4">
            <!-- Card Header - Accordion -->
            <a href="#collapseCardExample1" class="d-block card-header py-2 alert alert-secondary" data-toggle="collapse" role="alert"
               aria-expanded="true" aria-controls="collapseCardExample1" >
                <div class="alert-secondary">
                    DETAILS OF SELLER/TRANSFEROR
                </div>
            </a>
            <!-- Card Content - Collapse -->
            <div class="collapse show" id="collapseCardExample1">
                <div class="card-body">
                    <div id="transferor_company_form_data">
                        <x-individualTransferorConveyanceForm file=""/>
                    </div>
                </div>
            </div>
        </div>

        <div class="card shadow mb-4">
            <!-- Card Header - Accordion -->
            <a href="#collapseCardExample2" class="d-block card-header py-2 alert alert-secondary" data-toggle="collapse" role="alert"
               aria-expanded="true" aria-controls="collapseCardExample1" >
                <div class="alert-secondary">
                    DETAILS OF PURCHASER/TRANSFEREE/MORTGAGOR
                </div>
            </a>

            <!-- Card Content - Collapse -->
            <div class="collapse show" id="collapseCardExample2">
                <div class="card-body">
                    <div id="transferee_company_form_data">
                        <x-companyTransfereeConveyanceForm :file="$file"/>
                    </div>
                </div>
            </div>
        </div>
        <div class="card shadow mb-4">
            <!-- Card Header - Accordion -->
            <a href="#collapseCardExample3" class="d-block card-header py-2 alert alert-secondary"
               data-toggle="collapse" role="alert" aria-expanded="true" aria-controls="collapseCardExample1">
                <div class="alert-secondary">
                    DETAILS OF A PLOT
                </div>
            </a>
            <!-- Card Content - Collapse -->
            <div class="collapse hide" id="collapseCardExample3">
                <div class="card-body">
                    <div class="container">
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="dob">PLOT NO</label>
                                <input type="text" class="form-control"
                                       name="plot_no" id="plot_no" required>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="gender">SITUATED AT</label>
                                <input type="text" class="form-control" id="situated_at"
                                       name="situated_at" required>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="deed">TITLE DEED/CERTIFICATE NO</label>
                                <input type="text" class="form-control" id="certificate"
                                       name="certificate" required >
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="gender">Is property bounded?</label>
                                <label class="radio-inline"><input type="radio" name="optradio" value="Yes"> Yes</label>
                                <label class="radio-inline"><input type="radio" name="optradio" value="No" checked> No</label>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="inputAddress">Purchase Price</label>
                                <input type="text" class="form-control" id="price"
                                       name="price" required>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="inputAddress">Initial Payment Amount</label>
                                <input type="text" class="form-control" id="initial_payment"
                                       name="initial_payment" required>
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
            </div>
        </div>
    </div>

    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save</button>
    </div>
</form>

@section('custom-scripts')
    <script type="application/javascript">
        $(document).ready(function (){
            $('#individualsConveyancing').addClass('hidden');
            $('#companiesConveyancing').addClass('hidden');
            $('#individualCompanyconveyancing').addClass('hidden');
            $('#companyIndividualconveyancing').addClass('hidden');

            $('#individualsTransferorConveyancing_data').addClass('hidden');
            $('#individualsTransfereeConveyancing_data').addClass('hidden');

            $('#companiesTransferorConveyancing_data').addClass('hidden');
            $('#companiesTransfereeConveyancing_data').addClass('hidden');

            $('#individualTransferorCompanyconveyancing_data').addClass('hidden');
            $('#individualTransfereeCompanyconveyancing_data').addClass('hidden');

            $('#companyTransferorIndividualconveyancing_data').addClass('hidden');
            $('#companyTransfereeIndividualconveyancing_data').addClass('hidden');

            $("#transferor_type").change(function () {

                $('#individualsConveyancing').addClass('hidden');
                $('#companiesConveyancing').addClass('hidden');
                $('#individualCompanyconveyancing').addClass('hidden');
                $('#companyIndividualconveyancing').addClass('hidden');

                let transferorType = $("#transferor_type :selected").text();
                let transfereeType = $("#transferee_type :selected").text();
                switch (transferorType) {
                    case 'Individual':
                        if (transfereeType == 'Individual' || transfereeType == 'Select Transferee Type'){
                            $('#individualsConveyancing').removeClass('hidden');
                        }else if (transfereeType == 'Company'){
                            $('#individualCompanyconveyancing').removeClass('hidden');
                        }
                        break;
                    case 'Company':
                        if (transfereeType == 'Individual' || transfereeType == 'Select Transferee Type'){
                            $('#companyIndividualconveyancing').removeClass('hidden');
                        }else if (transfereeType == 'Company'){
                            $('#companiesConveyancing').removeClass('hidden');
                        }
                        break;
                }
            });
            $("#transferee_type").change(function () {

                $('#individualsConveyancing').addClass('hidden');
                $('#companiesConveyancing').addClass('hidden');
                $('#individualCompayconveyancing').addClass('hidden');
                $('#companyIndividualconveyancing').addClass('hidden');

                let transferorType = $("#transferor_type :selected").text();
                let transfereeType = $("#transferee_type :selected").text();
                switch (transfereeType) {
                    case 'Individual':
                        if (transferorType == 'Individual' || transferorType == 'Select Transferee Type'){
                            $('#individualsConveyancing').removeClass('hidden');
                        }else if (transferorType == 'Company' || transferorType == 'Select Transferee Type'){
                            $('#companyIndividualconveyancing').removeClass('hidden');
                        }
                        break;
                    case 'Company':
                        if (transferorType == 'Company' || transferorType == 'Select Transferee Type'){
                            $('#companiesConveyancing').removeClass('hidden');
                        }else if (transferorType == 'Individual' || transferorType == 'Select Transferee Type'){
                            $('#individualCompanyconveyancing').removeClass('hidden');
                        }
                        break;
                }
            });

            $("#client_info_transferor").on('click',function (){

                $('#client_info_transferee').hide();
                $('#transferee_client_info_clear').hide();

                let transferorType = $("#transferor_type :selected").text();
                let transfereeType = $("#transferor_type :selected").text();

                $('#individualsConveyancing').addClass('hidden');
                $('#companiesConveyancing').addClass('hidden');

                $('#individualCompanyconveyancing').addClass('hidden');
                $('#companyIndividualconveyancing').addClass('hidden');

                $('#individualsTransferorConveyancing_data').addClass('hidden');
                $('#individualsTransfereeConveyancing_data').addClass('hidden');

                $('#companiesTransferorConveyancing_data').addClass('hidden');
                $('#companiesTransfereeConveyancing_data').addClass('hidden');

                $('#individualTransferorCompanyconveyancing_data').addClass('hidden');
                $('#individualTransfereeCompanyconveyancing_data').addClass('hidden');

                $('#companyTransferorIndividualconveyancing_data').addClass('hidden');
                $('#companyTransfereeIndividualconveyancing_data').addClass('hidden');

                switch (transferorType) {
                    case 'Individual':
                        if (transfereeType== 'Individual'){
                            $('#individualsConveyancing').addClass('hidden');
                            $("#individualsTransferorConveyancing_data").removeClass('hidden');
                        }else if (transfereeType== 'Company'){
                            $('#individualCompanyconveyancing').addClass('hidden');
                            $("#individualTransferorCompanyconveyancing_data").removeClass('hidden');
                        }
                        break;
                    case 'Company':
                        if (transfereeType== 'Individual'){
                            $('#companyIndividualconveyancing').addClass('hidden');
                            $("#companyTransferorIndividualconveyancing_data").removeClass('hidden');
                        }else if (transfereeType== 'Company'){
                            $('#individualCompanyconveyancing').addClass('hidden');
                            $("#companiesTransferorConveyancing_data").removeClass('hidden');
                        }
                        break;
                }
            });
            $("#client_info_transferee").on('click',function (){

                $('#client_info_transferor').hide();
                $('#transferor_client_info_clear').hide();

                let transferorType = $("#transferor_type :selected").text();
                let transfereeType = $("#transferee_type :selected").text();

                switch (transfereeType) {
                    case 'Individual':
                        if (transferorType == 'Individual'){
                            $('#individualsConveyancing').addClass('hidden');
                            $("#individualsTransfereeConveyancing_data").removeClass('hidden');

                        }else if (transferorType == 'Company'){
                            $('#companyIndividualconveyancing').addClass('hidden');
                            $("#individualTransfereeCompanyconveyancing_data").removeClass('hidden');
                        }
                        break;
                    case 'Company':
                        if (transferorType== 'Individual'){
                            $('#individualCompanyconveyancing').addClass('hidden');
                            $("#companyTransfereeIndividualconveyancing_data").removeClass('hidden');

                        }else if (transferorType== 'Company'){

                            $('#companiesConveyancing').addClass('hidden');
                            $("#companiesTransfereeConveyancing_data").removeClass('hidden');
                        }
                        break;
                }
            });

            $('#transferor_client_info_clear').on('click',function (){
                let clientType = $("#transferor_type :selected").text();
                $('#client_info_transferee').show();
                $('#transferee_client_info_clear').show();
                switch (clientType) {
                    case 'Individual':
                        $('#client_info_transferee').show();
                        $('#transferee_client_info_clear').show();
                        break;
                    case 'Company':
                        $('#client_info_transferee').show();
                        $('#transferee_client_info_clear').hide();

                        break;
                }

            });
            $('#transferee_client_info_clear').on('click',function (){
                let clientType = $("#transferee_type :selected").text();
                $('#client_info_transferor').show();
                $('#transferor_client_info_clear').show();
                switch (clientType) {
                    case 'Individual':
                        $('#client_info_transferor').show();
                        $('#transferor_client_info_clear').show();

                        break;
                    case 'Company':
                        $('#client_info_transferor').show();
                        $('#transferor_client_info_clear').show();
                        break;
                }
            });
        });
    </script>
@endsection
