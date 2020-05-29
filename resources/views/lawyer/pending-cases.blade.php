@extends('layouts.default')
@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="container-fluid">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('lawyer.dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Pending Cases</li>
                </ol>
            </nav>
        </div>
@endsection