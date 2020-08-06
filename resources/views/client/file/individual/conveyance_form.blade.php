<div>
    <div class="container-fluid">
        <div class="alert alert-secondary" role="alert">
            TRANSACTION TYPE
        </div>
        <div class="form-row">
            <div class="form-group col-md-3">
                <label class="radio-inline"><input type="radio" name="transfer_type" checked> Deed of Sale</label>
            </div>
            <div class="form-group col-md-3">
                <label class="radio-inline"><input type="radio" name="transfer_type"> Transfer</label>
            </div>
            <div class="form-group col-md-3">
                <label class="radio-inline"><input type="radio" name="transfer_type"> Mortgage</label>
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
                    <div class="container-fluid">
                        <div class="form-row">
                            <div class="form-group col-10">
                                <select class="form-control form-control-md" id="transferor_type" name="transferor_type" required>
                                    <option disabled>Select Transferor Type</option>
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
                    <div id="transferor_individual_form">
                        <x-individualConveyanceForm file=""/>
                    </div>
                    <div id="transferor_company_form">
                        <x-companyConveyanceForm file=""/>
                    </div>
                    <div id="transferor_individual_form_data">
                        <x-individualConveyanceForm :file="$file"/>
                    </div>
                    <div id="transferor_company_form_data">
                        <x-companyConveyanceForm :file="$file"/>
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
                   <div class="container-fluid">
                       <div class="form-row">
                           <div class="form-group col-10">
                               <select class="form-control form-control-md" id="transferee_type" name="transferee_type" required>
                                   <option disabled>Select Transferee Type</option>
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
                    <div id="transferee_individual_form">
                        <x-individualConveyanceForm file="" />
                    </div>
                    <div id="transferee_company_form">
                        <x-companyConveyanceForm file=""/>
                    </div>
                    <div id="transferee_individual_form_data">
                        <x-individualConveyanceForm :file="$file"/>
                    </div>
                    <div id="transferee_company_form_data">
                        <x-companyConveyanceForm :file="$file"/>
                    </div>
                </div>
            </div>
        </div>

        <div class="card shadow mb-4">
            <!-- Card Header - Accordion -->
            <a href="#collapseCardExample3" class="d-block card-header py-2 alert alert-secondary" data-toggle="collapse" role="alert"
               aria-expanded="true" aria-controls="collapseCardExample1" >
                <div class="alert-secondary">
                    DETAILS OF A PLOT
                </div>
            </a>
            <!-- Card Content - Collapse -->
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
        </div>
    </div>
</div>
@section('custom-scripts')
    <script type="application/javascript">
        $(document).ready(function (){
            $('#transferor_company_form').hide();
            $('#transferee_company_form').hide();
            $('#transferor_individual_form_data').hide();
            $('#transferee_individual_form_data').hide();
            $('#transferor_company_form_data').hide();
            $('#transferee_company_form_data').hide();

            $("#transferor_type").change(function () {
                let clientType = $("#transferor_type :selected").text();
                console.log(clientType);
                switch (clientType) {
                    case 'Individual':
                        $('#transferor_individual_form').show();
                        $('#transferor_company_form').hide();
                        break;
                    case 'Company':
                        $('#transferor_company_form').show();
                        $('#transferor_individual_form').hide();
                        break;
                    default:
                        $('#transferor_company_form').hide();
                        $('#transferor_individual_form').hide();
                        break;
                }
            });
            $("#transferee_type").change(function () {
                let clientType = $("#transferee_type :selected").text();
                switch (clientType) {
                    case 'Individual':
                        $('#transferee_individual_form').show();
                        $('#transferee_company_form').hide();
                        break;
                    case 'Company':
                        $('#transferee_company_form').show();
                        $('#transferee_individual_form').hide();
                        break;
                    default:
                        $('#transferee_individual_form').hide();
                        $('#transferee_company_form').hide();
                        break;
                }
            });
            $("#client_info_transferor").on('click',function (){
                $('#client_info_transferee').hide();
                $('#transferee_client_info_clear').hide();
                let clientType = $("#transferor_type :selected").text();
                switch (clientType) {
                    case 'Individual':
                        $('#transferor_individual_form').hide();
                        $('#transferor_company_form').hide();
                        $('#transferor_company_form_data').hide();
                        $('#transferor_individual_form_data').show();
                        break;
                    case 'Company':
                        $('#transferor_individual_form').hide();
                        $('#transferor_individual_form_data').hide();
                        $('#transferor_company_form').hide();
                        $('#transferor_company_form_data').show();
                        break;
                }
            });
            $("#client_info_transferee").on('click',function (){
                $('#client_info_transferor').hide();
                $('#transferor_client_info_clear').hide();
                let clientType = $("#transferee_type :selected").text();
                switch (clientType) {
                    case 'Individual':
                        $('#transferee_individual_form').hide();
                        $('#transferee_company_form').hide();
                        $('#transferee_company_form_data').hide();
                        $('#transferee_individual_form_data').show();
                        break;
                    case 'Company':
                        $('#transferee_individual_form').hide();
                        $('#transferee_individual_form_data').hide();
                        $('#transferee_company_form').hide();
                        $('#transferee_company_form_data').show();
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
                        $('#transferor_individual_form').show();
                        $('#transferor_individual_form_data').hide();
                        $('#transferor_company_form').hide();
                        $('#transferor_company_form_data').hide();
                        break;
                    case 'Company':
                        $('#client_info_transferee').show();
                        $('#transferee_client_info_clear').hide();
                        $('#transferor_individual_form').hide();
                        $('#transferor_individual_form_data').hide();
                        $('#transferor_company_form').show();
                        $('#transferor_company_form_data').hide();
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
                        $('#transferee_individual_form').show();
                        $('#transferee_individual_form_data').hide();
                        $('#transferee_company_form').hide();
                        $('#transferee_company_form_data').hide();
                        break;
                    case 'Company':
                        $('#client_info_transferor').show();
                        $('#transferor_client_info_clear').show();
                        $('#transferee_individual_form').hide();
                        $('#transferee_individual_form_data').hide();
                        $('#transferee_company_form').show();
                        $('#transferee_company_form_data').hide();
                        break;
                }
            });
        });
    </script>
@endsection
