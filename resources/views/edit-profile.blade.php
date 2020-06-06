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
                <li class="breadcrumb-item active" aria-current="page">
                    <a href="{{ route('profile.show', ['profile'=>auth()->user()->id]) }}">Profile</a></li>
                <li class="breadcrumb-item active" aria-current="page">Edit</li>
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
        <div class="row">
            <div class="col-sm-3"><!--left col-->
                <div class="text-center">
                    <img src="http://ssl.gstatic.com/accounts/ui/avatar_2x.png" class="avatar img-circle img-thumbnail" alt="avatar">
                    <h6>Upload a different photo...</h6>
                    <input type="file" class="text-center center-block file-upload">
                </div>
                </hr>
                <br>
            </div><!--/col-3-->
            <div class="col-sm-9">
                <div class="tab-content">
                    <div class="tab-pane active" id="home">
                        <hr>
                        <form class="form" action="##" method="post" id="registrationForm">
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <div class="col-xs-6">
                                            <label for="first_name"><h4>First name</h4></label>
                                            <input type="text" class="form-control" name="first_name" id="first_name"
                                                   value="{{ old('name', (string) $user->name) }}"
                                                   placeholder="first name" title="enter your first name if any.">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-xs-6">
                                            <label for="last_name"><h4>Last name</h4></label>
                                            <input type="text" class="form-control" name="surname" id="last_name"
                                                   value="{{ old('surname', (string)$user->surname) }}"
                                                   placeholder="last name" title="enter your last name if any.">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-xs-6">
                                            <label for="mobile"><h4>Mobile</h4></label>
                                            <input type="text" class="form-control" name="mobile" id="mobile"
                                                   value="{{ old('name', (string) $user->contact) }}"
                                                   placeholder="enter mobile number" title="enter your mobile number if any.">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <div class="col-xs-6">
                                            <label for="email"><h4>Email</h4></label>
                                            <input type="email" class="form-control" name="email" id="email"
                                                   value="{{ old('email', (string) $user->email) }}"
                                                   placeholder="you@email.com" title="enter your email.">
                                        </div>
                                    </div>
                                    <div class="form-group">

                                        <div class="col-xs-6">
                                            <label for="password"><h4>Password</h4></label>
                                            <input type="password" class="form-control" name="password" id="password"
                                                   placeholder="password" title="enter your password.">
                                        </div>
                                    </div>
                                    <div class="form-group">

                                        <div class="col-xs-6">
                                            <label for="password2"><h4>Verify</h4></label>
                                            <input type="password" class="form-control" name="password2" id="password2"
                                                   placeholder="password2" title="enter your password2.">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-xs-12">
                                    <br>
                                    <button class="btn btn-lg btn-success" type="submit">
                                        <i class="glyphicon glyphicon-ok-sign"></i> Save</button>
                                    <button class="btn btn-lg btn-secondary" type="reset">
                                        <i class="glyphicon glyphicon-repeat"></i> Reset</button>
                                </div>
                            </div>
                        </form>
                        <hr>
                    </div><!--/tab-pane-->
                </div><!--/tab-pane-->
            </div><!--/tab-content-->

        </div><!--/col-9-->
    </div><!--/row-->
@endsection
@section('custom-scripts')
    <script>
        $(document).ready(function() {
            let readURL = function(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();

                    reader.onload = function (e) {
                        $('.avatar').attr('src', e.target.result);
                    }
                    reader.readAsDataURL(input.files[0]);
                }
            }
            $(".file-upload").on('change', function(){
                readURL(this);
            });
        });
    </script>
@endsection