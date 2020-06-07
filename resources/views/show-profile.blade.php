@extends('layouts.default')
@section('custom-links')
    <link rel="stylesheet" href="{{ asset('css/profile.css') }}">
@endsection
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
                <li class="breadcrumb-item active" aria-current="page">
                   Profile
                </li>

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
    <div class="container-fluid emp-profile">
        <div class="row">
            <div class="col-md-2">
                <div class="profile-img">
                    <img src="{{ asset($user->profile->photo !== null? 'storage/'.$user->profile->photo: 'img/default-profile.jpg') }}"
                         alt=""/>
                </div>
            </div>
            <div class="col-md-8">
                <div class="profile-head">
                    <h5>
                        {{$user->name }} {{ $user->surname }}
                    </h5>
                    <h6>
                        {{ $user->roles->first()->title }}
                    </h6>
                    @if ($user->roles->first()->title === 'Lawyer')
                        <p class="proile-rating">RANKINGS : <span>{{ $user->profile->ranking }}/10</span></p>
                    @endif
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab"
                               aria-controls="home" aria-selected="true">About</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab"
                               aria-controls="profile" aria-selected="false">Timeline</a>
                        </li>
                    </ul>
                </div>
            </div>
            @if ($user->id === auth()->user()->id )
                <div class="col-md-2">
                    <a type="button" class="btn btn-secondary text-white"
                       href="{{ route('profile.edit',['profile' => $user->id]) }}">Edit Profile</a>
                </div>
                @can('user_edit')
                    <div class="col-md-2">
                        <a class="btn btn-secondary text-white"
                           href="{{ route('profile.edit',['profile' => $user->id]) }}">Edit Profile</a>
                    </div>
                @endcan
            @endif
        </div>
        <div class="row">
            <div class="col-md-3">
                <div class="profile-work">
                    <h4>Academic Awards</h4>
                    @forelse(json_decode($user->profile->academic_awards)??[] as $award)
                        @if ($award)
                            <span class="badge badge-success text-white">
                                <strong>{{ $award }}</strong>
                            </span><br>
                        @endif
                    @empty
                        <span class="badge badge-success text-white">
                            <strong>No available academic records!</strong>
                        </span>
                    @endforelse
                    <h4>Skills</h4>
                    @forelse(json_decode($user->profile->skills)??[] as $skill)
                        @if ($skill)
                            <span class="badge badge-success text-white">
                                <strong>{{ $skill }}</strong>
                            </span><br>
                        @endif
                    @empty
                        <span class="badge badge-success text-white">
                            <strong>No available skills!</strong>
                        </span>
                    @endforelse
                </div>
            </div>
            <div class="col-md-9">
                <div class="tab-content profile-tab" id="myTabContent">
                    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                        <div class="row">
                            <div class="col-md-4">
                                <label>Username</label>
                            </div>
                            <div class="col-md-4">
                                <p>{{ $user->profile->username }}</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <label>Name</label>
                            </div>
                            <div class="col-md-4">
                                <p>{{ $user->name }}</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <label>Surname</label>
                            </div>
                            <div class="col-md-4">
                                <p>{{ $user->surname }}</p>
                            </div>
                            <div class="col-md-4">

                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <label>Email</label>
                            </div>
                            <div class="col-md-4">
                                <p>{{ $user->email }}</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <label>Phone</label>
                            </div>
                            <div class="col-md-4">
                                <p>{{ $user->contact?? 'None' }}</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <label>Profession</label>
                            </div>
                            <div class="col-md-4">
                                @foreach ($user->roles as $role)
                                    <p>{{ $role->title }}</p>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                        <div class="row">
                            <div class="col-md-4">
                                <label>Experience</label>
                            </div>
                            <div class="col-md-4">
                                <p>{{ $user->profile->experience?? 'None' }}</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <label>Total Cases</label>
                            </div>
                            <div class="col-md-4">
                                <p><span class="badge badge-pill badge-secondary">{{ $user->cases_count }}</span> </p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <label>English Level</label>
                            </div>
                            <div class="col-md-4">
                                <p>Expert</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <label>Availability</label>
                            </div>
                            <div class="col-md-4">
                                <p><span class="badge badge-pill badge-primary">{{ $user->profile->availability?? 'Available' }}</span></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('custom-scripts')
@endsection
