@extends('layouts.default')
<!--  Content -->
@section('custom-links')
    <link href="{{ asset('css/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/responsive.bootstrap4.min.css') }}" rel="stylesheet">
@endsection

@section('content')
    <div class="container-fluid">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a @php
                           $isLawyer =  auth()->user()->roles->first()->title === 'Lawyer'
                       @endphp
                       href="{{  route($isLawyer? 'lawyer.dashboard': 'admin.dashboard') }}">Home
                    </a></li>
                <li class="breadcrumb-item">
                    <a href="{{ $isLawyer? route('lawyer.conveyancing.index'): route('files.index') }}">
                        {{ $isLawyer? 'Conveyancing': 'Files' }}
                    </a>
                </li>
                <li class="breadcrumb-item"><a>{{ $conveyancing->number }}</a></li>
                <li class="offset-11 d-sm-block" style="height: 10px;margin-top: -30px;">
                    <a href="{{ url()->previous() }}" title="Back">
                        <i class="fa fa-2x fa-chevron-circle-left"></i>
                    </a>
                </li>
            </ol>
        </nav>
        <div class="row-cols-1">
            <div class="alert alert-secondary" role="alert">
                TRANSACTION TYPE
            </div>
            <div class="form-row">
                <div class="form-group col-md-3">
                   <input type="radio" disabled checked><label class="text-dark ml-2 text-primary">{{ $conveyancing->transaction->transaction_type }}</label>
                </div>
            </div>

            <div class="card shadow mb-4">
                <!-- Card Header - Accordion -->
                <a href="#collapseCardExample1" class="d-block card-header py-2 alert alert-secondary" data-toggle="collapse" role="alert"
                   aria-expanded="true" aria-controls="collapseCardExample1" >
                    <div class="alert-secondary">
                        DETAILS OF SELLER/TRANSFEROR
                    </div>
                </a>
                <!-- Card Content - Collapse -->
                <div class="collapse hide" id="collapseCardExample1">
                    <div class="card-body">
                        <div id="transferor_individual_form_data">
                            @if($conveyancing->transaction->client_transaction_type == 'Transferor')
                                @if(class_basename($conveyancing->client->clientable) == 'Individual')
                                    <x-individualTransferorConveyanceForm :file="$conveyancing->client->clientable"/>
                                    @else
                                    <x-companyTransferorConveyanceForm :file="$conveyancing->client->clientable"/>
                                @endif
                            @else
                                @if(class_basename($conveyancing->other_type) == 'Individual')
                                    @inject('other','App\Repository\IndividualFileRepositoryInterface')
                                    <x-individualTransferorConveyanceForm :file="$other->getFile($conveyancing->other_id)"/>
                                @else
                                    @inject('other','App\Repository\CompanyFileRepositoryInterface')
                                    <x-companyTransferorConveyanceForm :file="$other->getFile($conveyancing->other_id)"/>
                                @endif
                            @endif
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
                <div class="collapse hide" id="collapseCardExample2">
                    <div class="card-body">
                        @if($conveyancing->transaction->client_transaction_type == 'Transferee')
                            @if(class_basename($conveyancing->client->clientable) == 'Individual')
                                <x-individualTransfereeConveyanceForm :file="$conveyancing->client->clientable"/>
                            @else
                                <x-companyTransfereeConveyanceForm :file="$conveyancing->client->clientable"/>
                            @endif
                        @else
                            @if(class_basename($conveyancing->other_type) == 'Individual')
                                @inject('other','App\Repository\IndividualFileRepositoryInterface')
                                <x-individualTransfereeConveyanceForm :file="$other->getFile($conveyancing->other_id)"/>
                            @else
                                @inject('other','App\Repository\CompanyFileRepositoryInterface')
                                <x-companyTransfereeConveyanceForm :file="$other->getFile($conveyancing->other_id)"/>
                            @endif
                        @endif
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
                                           name="plot_no" disabled value="{{ $conveyancing->transaction->plot->plot_no }}"
                                    >
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label for="gender">SITUATED AT</label>
                                    <input type="text" class="form-control"
                                           name="situated_at" disabled value="{{ $conveyancing->transaction->plot->situated_at }}">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label for="deed">TITLE DEED/CERTIFICATE NO</label>
                                    <input type="text" class="form-control"
                                           name="certificate" disabled value="{{ $conveyancing->transaction->plot->title_deed }}" >
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label for="property_bounded">Is property bounded?</label>
                                    <label class="radio-inline">
                                        <input type="radio" name="property_bounded" disabled checked>
                                        {{ $conveyancing->transaction->plot->property_bounded != 0? 'Yes':'No' }}
                                    </label>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label for="inputAddress">Purchase Price</label>
                                    <input type="text" class="form-control"
                                           name="price" disabled
                                           value="BWP {{ $conveyancing->transaction->plot->purchase_price }}">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label for="inputAddress">Initial Payment Amount</label>
                                    <input type="text" class="form-control"
                                           name="initial_payment" disabled
                                           value="BWP {{ $conveyancing->transaction->plot->initial_payment }}">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label for="inputAddress2">Other Notes</label>
                                    <textarea rows="5" cols="80" class="form-control"
                                              disabled>{{ $conveyancing->transaction->plot->notes }}</textarea>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
<!-- /.container-fluid -->
@section('custom-scripts')
    <script src="{{ asset('js/bootbox.min.js') }}"></script>
    <script type="application/javascript">
        $(document).ready(function () {
            $('.deleteLitigationNote').on('click',function () {
                let id;
                id = $(this).attr('id');
                bootbox.confirm({
                    title: "Delete Litigation File Note Form Record",
                    message: "Do you really want to delete this record?",
                    buttons: {
                        cancel: {
                            label: `<i class="fa fa-times"></i> Cancel`
                        },
                        confirm: {
                            label: `<i class="fa fa-check"></i> Confirm`
                        }
                    },
                    callback: function (result) {
                        let url = '{{ route("lawyer.note-form.destroy",["note_form"=> ":id"]) }}';
                        url = url.replace(':id', id);
                        console.log(url);
                        console.log($('input[name="_token"]').val());
                        if(result){
                            $(this).html(`<i class="fa fa-spinner fa-spin"></i> deleting...`);
                            $.ajax({
                                url: url,
                                type: 'POST',
                                data: {
                                    '_token' : $('input[name="_token"]').val(),
                                    _method: 'delete'
                                },
                                success: function(response){
                                    window.location.reload();
                                },
                                error: function (response) {
                                    console.log("error "+ response.data);
                                }
                            });
                        }
                    }
                });
            });
        })
    </script>
@endsection
