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
                    <a href="{{ route('profile.show', ['profile'=>$user->id]) }}">Profile</a></li>
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
    <div class="container-fluid emp-profile">
        <div class="card shadow mb-4">
            <!-- Card Header - Accordion -->
            <a href="#collapseCardExample" class="d-block card-header py-3" data-toggle="collapse" role="button"
               aria-expanded="true" aria-controls="collapseCardExample">
                <h6 class="m-0 font-weight-bold text-primary">Basic Information</h6>
            </a>
            <!-- Card Content - Collapse -->
            <div class="collapse show" id="collapseCardExample">
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-3"><!--left col-->
                            <div class="row-cols-1">
                                <img src="{{ asset($user->profile->photo !== null?
                                            'storage/'.$user->profile->photo:'img/default-profile.jpg')
                                            }}"
                                     class="avatar img-circle img-thumbnail" alt="avatar">
                            </div>
                            <div class="row-cols-12">
                                <form action="{{ route('profile.update',
                                            ['profile'=> $user->profile->id]) }}"
                                      method="post" enctype="multipart/form-data" id="uploadPhoto">
                                    @method('PUT')
                                    @csrf
                                   <div class="form-group">
                                       <input type="file" name="photo"
                                              class="form-control-file text-center text-sm-left center-block file-upload">
                                   </div>
                                </form>
                            </div>
                            <hr>
                            <br>
                        </div><!--/col-3-->
                        <div class="col-sm-9">
                            <div class="tab-content">
                                <div class="tab-pane active" id="home">
                                    <form class="form" action="{{ route('user.update', ['user' => $user->id]) }}"
                                          method="post" id="registrationForm">
                                        @method('PUT')
                                        @csrf
                                        <div class="row">
                                            <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                                <div class="form-group">
                                                    <div class="col-xs-6">
                                                        <label for="first_name"><h4>First name</h4></label>
                                                        <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name"
                                                               value="{{ old('name', (string) $user->name) }}"
                                                               placeholder="first name" title="enter your first name if any.">
                                                        @error('name')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="col-xs-6">
                                                        <label for="last_name"><h4>Last name</h4></label>
                                                        <input type="text" class="form-control @error('surname') is-invalid @enderror" name="surname" id="surname"
                                                               value="{{ old('surname', (string)$user->surname) }}"
                                                               placeholder="last name" title="enter your last name if any.">
                                                        @error('surname')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="col-xs-12">
                                                        <label for="mobile"><h4>Mobile</h4></label>
                                                        <input type="text" class="form-control @error('contact') is-invalid @enderror" name="contact" id="contact"
                                                               value="{{ old('contact', (string) $user->contact) }}"
                                                               placeholder="enter mobile number" title="enter your mobile number if any.">
                                                        @error('contact')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                                <div class="form-group">
                                                    <div class="col-xs-6">
                                                        <label for="email"><h4>Email</h4></label>
                                                        <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" id="email"
                                                               value="{{ old('email', (string) $user->email) }}"
                                                               placeholder="you@email.com" title="enter your email.">
                                                        @error('email')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="form-group">

                                                    <div class="col-xs-6">
                                                        <label for="password"><h4>Password</h4></label>
                                                        <input type="password" class="form-control @error('password') is-invalid @enderror" name="password"
                                                               id="password"
                                                               placeholder="password" title="enter your password.">
                                                        @error('password')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="col-xs-6">
                                                        <label for="password2"><h4>Verify Password</h4></label>
                                                        <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror"
                                                               name="password_confirmation" id="password_confirmation"
                                                               placeholder="confirm password"
                                                               title="enter password confirmation.">
                                                        @error('password_password')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-sm-12">
                                                <button class="btn btn-lg btn-success" type="submit">
                                                    <i class="glyphicon glyphicon-ok-sign"></i> Save</button>
                                                <hr class="d-xl-none d-md-none d-lg-none d-sm-block">
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

                </div>
            </div>
        </div>
        <div class="card shadow mb-4">
            <!-- Card Header - Accordion -->
            <a href="#collapseCardExample" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardExample">
                <h6 class="m-0 font-weight-bold text-primary">Timeline Information</h6>
            </a>
            <!-- Card Content - Collapse -->
            <div class="collapse hide" id="collapseCardExample">
                <div class="card-body">
                    <form class="form" action="{{ route('profile.update', ['profile' => $user->id]) }}"
                          method="post" id="registrationForm">
                        @method('PUT')
                        @csrf
                        <div class="row">
                            <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                <div class="form-group">
                                    <div class="col-xs-6">
                                        <label for="first_name"><h4>Username</h4></label>
                                        <input type="text" class="form-control @error('username') is-invalid @enderror"
                                               name="username" id="username"
                                               value="{{ old('username', (string) $user->profile->username) }}"
                                               placeholder="username" title="enter your user name if any.">
                                        @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-xs-6">
                                        <label for="awards"><h4>Academic Awards</h4></label>
                                        @foreach(json_decode($user->profile->academic_awards)??[] as $award)
                                            @if ($award)
                                                <div>
                                                    <input type="text" name="academic_awards[]"
                                                           class="form-control alert-secondary"
                                                           value="{{ old('academic_award',$award) }}">
                                                    <a href="javascript:void(0);" class="remove_award_button">
                                                        <img src="{{ asset('img/minus-icon.png') }}" height="30px"/>
                                                    </a>
                                                </div>
                                                <br>
                                            @endif
                                        @endforeach
                                        <div class="academic_field_wrapper">
                                            <div>
                                                <input type="text" name="academic_awards[]"  class="form-control" value="">
                                                <a href="javascript:void(0);" class="add_academic_award_button" title="Add Award">
                                                    <img src="{{ asset('img/add-icon.png') }}" height="30px"></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                <div class="form-group">
                                    <div class="col-xs-6">
                                        <label for="experience"><h4>Experience</h4></label>
                                        <input type="text" class="form-control @error('experience') is-invalid @enderror"
                                               name="experience" id="experience"
                                               value="{{ old('experience', (string) $user->profile->experience) }}"
                                               placeholder="experience" title="enter your experience if any.">
                                        @error('surname')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-xs-5">
                                        <label for="skills"><h4>Skills</h4></label>
                                        @foreach(json_decode($user->profile->skills)??[] as $skill)
                                            @if ($skill)
                                                <div>
                                                    <input type="text" name="skills[]"  class="form-control alert-secondary"
                                                           value="{{ old('skill',$skill) }}">
                                                    <a href="javascript:void(0);" class="remove_skill_button">
                                                        <img src="{{ asset('img/minus-icon.png') }}" height="30px"/>
                                                    </a>
                                                </div>
                                                <br>
                                            @endif
                                        @endforeach
                                            <div class="field_wrapper">
                                                <div>
                                                    <input type="text" name="skills[]"  class="form-control" value="">
                                                    <a href="javascript:void(0);" class="add_skill_button" title="Add Skill">
                                                        <img src="{{ asset('img/add-icon.png') }}" height="30px"></a>
                                                </div>
                                            </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-12">
                                <button class="btn btn-lg btn-success" type="submit">
                                    <i class="glyphicon glyphicon-ok-sign"></i> Save</button>
                                <hr class="d-xl-none d-md-none d-lg-none d-sm-block">
                                <button class="btn btn-lg btn-secondary" type="reset">
                                    <i class="glyphicon glyphicon-repeat"></i> Reset</button>
                            </div>
                        </div>
                    </form>
                    <hr>
                </div>
            </div>
        </div>
    </div><!--/row-->
@endsection
@section('custom-scripts')
    <script>
        $(document).ready(function() {
            let readURL = function(input) {
                if (input.files && input.files[0]) {
                    let reader = new FileReader();

                    reader.onload = function (e) {
                        $('.avatar').attr('src', e.target.result);
                    }
                    reader.readAsDataURL(input.files[0]);
                }
            };
            $(".file-upload").on('change', function(){
                readURL(this);
                $('#uploadPhoto').submit();
            });

            var maxField = 10; //Input fields increment limitation
            var addSkillButton = $('.add_skill_button');
            var addAwardButton = $('.add_academic_award_button'); //Add button selector
            var wrapper = $('.field_wrapper'); //Input field wrapper
            var academic_wrapper = $('.academic_field_wrapper'); //Input field wrapper
            var skillsHTML = '<div><input type="text" name="skills[]" value="" class="form-control"/><a href="javascript:void(0);" class="remove_skill_button"><img src="{{ asset('img/minus-icon.png') }}" height="30px"/></a></div>';
            var awardsHTML = '<div><input type="text" name="academic_awards[]" value="" class="form-control"/><a href="javascript:void(0);" class="remove_award_button"><img src="{{ asset('img/minus-icon.png') }}" height="30px"/></a></div>';
            var x = parseInt('{{$user->profile->skills !== null ? count(json_decode($user->profile->skills)): 0 }}') + 1 ; //Initial field counter is 1
            var y =parseInt('{{$user->profile->academic_awards !== null ? count(json_decode($user->profile->academic_awards)): 0 }}') + 1;
            console.log(x);
            console.log(y);
            //Once add button is clicked
            $(addSkillButton).click(function(){
                //Check maximum number of input fields
                if(x < maxField){
                    x++; //Increment field counter
                    $(wrapper).append(skillsHTML); //Add field html
                }
            });

            //Once add button is clicked
            $(addAwardButton).click(function(){
                //Check maximum number of input fields
                if(y < maxField){
                    y++; //Increment field counter
                    $(academic_wrapper).append(awardsHTML); //Add field html
                }
            });

            //Once remove button is clicked
            $(wrapper).on('click', '.remove_skill_button', function(e){
                e.preventDefault();
                $(this).parent('div').remove(); //Remove field html
                x--; //Decrement field counter
            });

            //Once remove button is clicked
            $(academic_wrapper).on('click', '.remove_award_button', function(e){
                e.preventDefault();
                $(this).parent('div').remove(); //Remove field html
                y--; //Decrement field counter
            });
        });
    </script>
@endsection