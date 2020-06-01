@extends('layouts.default')
<!--  Content -->
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
            <li class="breadcrumb-item"><a href="{{ route('files.index') }}">Files</a></li>
            <li class="breadcrumb-item"><a>{{ $file->number }}</a></li>
            <li class="offset-11 d-sm-block" style="height: 10px;margin-top: -30px;">
                <a href="{{ url()->previous() }}" title="Back">
                    <i class="fa fa-2x fa-chevron-circle-left"></i>
                </a>
            </li>
        </ol>
    </nav>
    <div class="alert alert-info fade show" role="alert">
        <strong>Client has {{ $file->cases->count() }} cases recorded!</strong> Click the button to register a new case.
        @can('case_create')
        <a href="#" class="btn btn-md btn-outline-primary shadow-sm" data-toggle="modal" data-target="#openClientCaseModal">
            <i class="fa fa-file-contract fa-sm text-dark-100"></i> open a new case</a>
        <!-- Modal -->
        <div class="modal fade" id="openClientCaseModal" tabindex="-1" role="dialog"
             aria-labelledby="openClientCaseModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="openClientCaseModalLabel">Court Case Information</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="alert alert-primary" role="alert">
                            In the High Court of the Republic of Botswana
                        </div>
                        <form method="POST" action="{{ route('cases.store') }}"
                              enctype="multipart/form-data">
                            @csrf
                            <div class="form-group ">
                                <label for="inputCaseNumber">Case Number</label>
                                <input type="text" class="form-control" disabled
                                       value="{{ \Illuminate\Support\Str::caseNumber() }}">
                                <input type="hidden" name="number" class="form-control"
                                       id="number"  value="{{ \Illuminate\Support\Str::caseNumber() }}">
                                <input type="hidden" name="file_id" class="form-control"
                                       id="file_id"  value="{{ $file->id }}">
                            </div>
                            <div class="form-group ">
                                <label for="inputPlaintiffName">Plaintiff Name</label>
                                <input type="text" class="form-control" id="plaintiff" name="plaintiff"
                                required>
                            </div>
                            <div class="form-group">
                                <label for="inputDefendantName">Defendant Name</label>
                                <input type="text" class="form-control" id="defendant" name="defendant"
                                       required>
                            </div>
                            <div class="form-group">
                                <label for="inputDetails">Case Details</label>
                                <textarea class="form-control text-left" aria-label="With textarea" name="details"
                                          rows="10" cols="50"  required>
                                </textarea>
                            </div>
                            <div class="form-group">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="validatedCustomFile"
                                    name="docs[]" multiple>
                                    <label class="custom-file-label"
                                           for="validatedCustomFile">Upload Supporting
                                        Docs...</label>
                                    <div class="invalid-feedback">Scan Supporting Documents</div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Save case</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @endcan
    </div>
    <div class="alert alert-primary alert-dismissible fade show" role="alert">
        <input type="hidden" name="_token" value="{{ @csrf_token() }}">
        @foreach($file->cases as $case)
            <div class="card shadow mb-4">
            <!-- Card Header - Accordion -->
            <a href="#{{ $case->number }}" class="d-block card-header py-3" data-toggle="collapse"
               role="button" aria-expanded="true" aria-controls="collapseCardExample">
                <h6 class="m-0 font-weight-bold text-primary">Case {{ $case->number }}
                    <span class="badge badge-info ">{{ $case->status }}</span>
                </h6>
            </a>
            <!-- Card Content - Collapse -->
            <div class="collapse hide" id="{{ $case->number }}">
                <div class="card-body">
                    <div class="jumbotron jumbotron-fluid">
                        <div class="container">
                            <h4 class="font-weight-bold">Court Case Information</h4>
                            <p class="lead">This is a modified jumbotron that occupies the entire horizontal space of its parent.</p>
                        </div>
                    </div>
                    <div class="row">
                       <div class="col-md-2 col-sm-6">
                           <div class="d-flex p-2 font-weight-bold">
                               <h5>Defendant: <span> {{ $case->defendant }}</span>
                               </h5>
                           </div>
                       </div>
                        <div class="col-md-1 col-sm-2">
                            <div class="d-flex p-2 font-weight-bold">
                                VS
                            </div>
                        </div>
                        <div class="col-md-2 col-sm-6">
                            <div class="d-flex p-2 font-weight-bold">
                                <h5>Plaintiff: <span> {{ $case->plaintiff }}</span>
                                </h5>
                            </div>
                        </div>
                        <div class="col-md-7 align-items-end">

                           <div class="" style="float: right;">
                               <div class="d-block p-2 font-weight-bold offset-1">Supporting Docs</div>
                               <ul>
                                   @foreach(explode(",", $case->docs) as $doc)
                                       <div class="alert alert-sm-light  alert-dismissible fade show"
                                            role="alert" style="height: 20px">
                                           <li class="" style="margin: 0;"><a href="#">{{ $doc }}</a>
                                               <button type="button" class="close" data-dismiss="alert"
                                                       aria-label="Close">
                                                   <span aria-hidden="true" style="color: red;">&times;</span>
                                               </button>
                                            </li>
                                        </div>
                                       @endforeach
                               </ul>
                           </div>
                        </div>
                    </div>
                    <div class="row">
                       <div class="col-md-4"></div>
                    </div>
                    <div class="d-flex p-2 font-weight-bold"><h5>Case Details</h5></div>
                    <div class="d-flex p-2">
                        {{ $case->details }}
                    </div>
                    <div class="clearfix"></div>

                    <div class="row">
                        <div class="col-md-6">
                                @can('case_edit')
                            <a class="btn btn-info btn-sm  text-center text-white"
                                    href="{{ route('cases.show', $case->id) }}">
                                <i class="fa fa-file-contract"></i> Edit Case
                            </a>
                                @endcan
                                @can('case_delete')
                            <button class="delete btn btn-danger btn-sm  text-center text-white"
                                    data-toggle="modal" data-target="#" id="{{ $case->id }}">
                                <i class="fa fa-trash"></i> Delete Case
                            </button>
                                @endcan
                                @can('case_assign')
                            <a class="btn {{ $case->user == null ? 'btn-outline-info': 'btn-outline-success'}}
                                btn-sm  text-center
                                dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                               data-toggle="dropdown" aria-haspopup="true"
                               aria-expanded="false"><i class="fa fa-user-circle">
                                </i>
                                @if($case->user != null)
                                    Re-assign
                                @else Assign
                                @endif
                            </a>
                                @endcan
                            @include('partials.dropdown-lawyers')
                            <button class="attach btn btn-secondary btn-sm text-center text-white"
                                    id="{{ $case->id }}"
                                    data-id='{{ $case->id }}'>
                                <i class="fa fa-paperclip"></i> Attach Docs
                            </button>
                        </div>
                        <div class="col-md-6 align-items-end">
                            @if($case->user != null)
                                <div class="row">
                                    <div class="col-md-11">
                                        <div class="d-flex p-2 font-weight-bold" style="float: right;">
                                            <span >Assigned Lawyer:  {{ $case->user->name }}</span>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="d-flex p-2 font-weight-bold" style="float: right;">
{{--                                        <span >Date of Court Appeal:  {{ $case ?? ''->date_appeal }}</span>--}}
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
<!-- /.container-fluid -->
@section('custom-scripts')
@include('partials.case-delete-btn')
<script type="application/javascript">
    $(document).ready(function() {
        $('.dropdown-item').on('click', function(){

            //Update id
            let user_id = $(this).attr('id');
            let case_id = '{{ $case->id ?? null }}';
            let url = '{{ route("cases.update",["case"=> ":id"]) }}';
            let token = $('input[name="_token"]').val();

            if(case_id != null)
            {
                url = url.replace(':id', case_id);
                $.ajax({
                    url: url,
                    type: 'POST',
                    data: {
                        '_token' : token,
                        _method: 'PUT',
                        'user_id': user_id
                    },
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response){
                        console.log("Successfully updated client case");
                        window.location.reload();
                    },
                    error: function (response) {
                        console.log("error "+ response.data);
                    }
                });
            }
        });
    } );
</script>
@endsection
