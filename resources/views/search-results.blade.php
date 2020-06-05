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
                <li class="breadcrumb-item active" aria-current="page">Search</li>
                <li class="offset-11 d-sm-block" style="height: 10px;margin-top: -30px;">
                    <a href="{{ url()->previous() }}" title="Back">
                        <i class="fa fa-2x fa-chevron-circle-left"></i>
                    </a>
                </li>
            </ol>
        </nav>
    </div>
@endsection
@section('content')
    <div class="container-fluid">
        <h4>Search Results</h4>
        <div class="alert alert-primary alert-dismissible fade show" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                <span class="sr-only">Close</span>
            </button>
            <strong>Search complete!</strong> There are {{ $searchResults->count() }} results.
        </div>

        @foreach($searchResults->groupByType() as $type => $modelSearchResults)
            <div class="card shadow mb-4">
                <!-- Card Header - Accordion -->
                <a href="#collapseCardExample{{ $type }}" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardExample">
                    <h3 class="m-0 font-weight-bold text-primary">{{ $type }}</h3>
                </a>
                <!-- Card Content - Collapse -->
                <div class="collapse hide" id="collapseCardExample{{ $type }}">
                    <div class="card-body">
                        @foreach($modelSearchResults as $searchResult)
                            <ul>
                                <li>
                                    <div class="alert alert-secondary" role="alert">
                                        <a href="{{ $searchResult->url }}">{{ $searchResult->title }}</a>
                                    </div>
                                </li>
                            </ul>
                        @endforeach
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
