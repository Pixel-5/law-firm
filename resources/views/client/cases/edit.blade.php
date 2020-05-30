@extends('layouts.default')

@section('breadcrumb')
    <div class="container-fluid">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a @php
                           $isLawyer =  auth()->user()->roles->first()->title === 'Lawyer'
                       @endphp
                       href="{{  route($isLawyer? 'lawyer.dashboard': 'admin.dashboard') }}">Home
                    </a>
                </li>
                <li class="breadcrumb-item"><a href="{{ route('lawyer.cases') }}">
                        Assigned cases
                    </a></li>
                <li class="breadcrumb-item active" aria-current="page">Edit</li>
            </ol>
        </nav>
    </div>
@endsection

@section('content')
        <div class="row">
            <div class="container-fluid">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="openClientCaseModalLabel"><b>Court Case Information</b></h5>
                        <a href="{{ route('admin.open.client.cases', $case->file->id) }}"
                           class="btn btn-outline-primary align-items-end"><i class="fa fa-folder-open"></i>
                            {{ $case->file->number }}
                        </a>
                    </div>
                    <div class="modal-body">
                        <div class="alert alert-primary" role="alert">
                            In the High Court of the Republic of Botswana
                        </div>
                        <form method="POST" action="{{ route('cases.update', ['case' => $case->id]) }}"
                              enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="form-group ">
                                <label for="inputCaseNumber">Case Number</label>
                                <input type="text" class="form-control" disabled
                                       value="{{ $case->number }}">
                            </div>
                            <div class="form-group ">
                                <label for="inputPlaintiffName">Plaintiff Name</label>
                                <input type="text" class="form-control" id="plaintiff" name="plaintiff"
                                       value="{{ $case->plaintiff }}">
                            </div>
                            <div class="form-group">
                                <label for="inputDefendantName">Defendant Name</label>
                                <input type="text" class="form-control" id="defendant" name="defendant"
                                       value="{{ $case->defendant }}">
                            </div>
                            <div class="form-group">
                                <label for="inputDetails">Case Details</label>
                                <textarea class="form-control rounded-lg z-depth-1" aria-label="With textarea" name="details"
                                          rows="10" cols="50">
                            {{ $case->details }}
                                </textarea>
                            </div>
                            <div class="modal-footer">
{{--                                <a href="" class="btn btn-secondary">Close</a>--}}
                                <button type="submit" class="btn btn-primary">Save case</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endsection
