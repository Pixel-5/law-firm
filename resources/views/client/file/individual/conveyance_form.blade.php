
<div class="container-fluid">
    <div class="form-row">
        <div class="form-group col-10">
            <select class="form-control form-control-md" id="transferor_type" name="transferor_type" required>
                <option disabled selected value="">Select Transferor/Seller</option>
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
                <option disabled selected value="">Select Transferee/Purchaser/Mortgagor</option>
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

            <div class="form-group col-md-3">
                <label class="radio-inline"><input type="radio" name="transfer_type" value="Other"> Other</label>
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
                    <input type="hidden" name="client" value="Transferor">
                    <input type="hidden" name="client_id" value="{{ $file->id }}">
                    <div id="transferor_individual_form_data">
                        <x-individualTransferorConveyanceForm :file="$file->clientable"/>
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
                        <input type="hidden" name="other_type" value="Individual">
                        <input type="hidden" name="other" value="Transferee">
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
                    <x-plot-details-form/>
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
                        <input type="hidden" name="other_type" value="Individual">
                        <input type="hidden" name="other" value="Transferor">
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
                    <input type="hidden" name="client" value="Transferee">
                    <input type="hidden" name="client_id" value="{{ $file->id }}">
                    <div id="transferee_individual_form">
                        <x-individualTransfereeConveyanceForm :file="$file->clientable"/>
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
                    <x-plot-details-form/>
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
                    <input type="hidden" name="client" value="Transferor">
                    <input type="hidden" name="client_id" value="{{ $file->id }}">
                    <div id="transferor_company_form_data">
                        <x-companyTransferorConveyanceForm :file="$file->clientable"/>
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
                        <input type="hidden" name="other_type" value="Company">
                        <input type="hidden" name="other" value="Transferee">
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
                    <x-plot-details-form/>
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
                        <input type="hidden" name="other_type" value="Company">
                        <input type="hidden" name="other" value="Transferor">
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
                    <input type="hidden" name="client" value="Transferee">
                    <input type="hidden" name="client_id" value="{{ $file->id }}">
                    <div id="transferee_company_form_data">
                        <x-companyTransfereeConveyanceForm :file="$file->clientable"/>
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
                    <x-plot-details-form/>
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
                    <input type="hidden" name="client" value="Transferor">
                    <input type="hidden" name="client_id" value="{{ $file->id }}">
                    <div id="transferor_individual_form_data">
                        <x-individualTransferorConveyanceForm :file="$file->clientable"/>
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
                    <input type="hidden" name="other_type" value="Company">
                    <input type="hidden" name="other" value="Transferee">
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
                    <x-plot-details-form/>
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
                        <input type="hidden" name="other_type" value="Company">
                        <input type="hidden" name="other" value="Transferor">
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
                <input type="hidden" name="client" value="Transferee">
                <input type="hidden" name="client_id" value="{{ $file->id }}">
                <div id="transferee_individual_form_data">
                    <x-individualTransferorConveyanceForm :file="$file->clientable"/>
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
                    <x-plot-details-form/>
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
                    <input type="hidden" name="client" value="Transferor">
                    <input type="hidden" name="client_id" value="{{ $file->id }}">
                    <div id="transferor_company_form_data">
                        <x-companyTransferorConveyanceForm :file="$file->clientable"/>
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
                        <input type="hidden" name="other_type" value="Individual">
                        <input type="hidden" name="other" value="Transferee">
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
                    <x-plot-details-form/>
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
                    <input type="hidden" name="other_type" value="Individual">
                    <input type="hidden" name="other" value="Transferor">
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
                    <input type="hidden" name="client" value="Transferee">
                    <input type="hidden" name="client_id" value="{{ $file->id }}">
                    <div id="transferee_company_form_data">
                        <x-companyTransfereeConveyanceForm :file="$file->clientable"/>
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
                    <x-plot-details-form/>
                </div>
            </div>
        </div>
    </div>

    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save</button>
    </div>
</form>
