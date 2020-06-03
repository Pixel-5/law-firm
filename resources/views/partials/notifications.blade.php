@extends('layouts.default')
@section('breadcrumb')
    <div class="container-fluid">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Notifications</li>
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
    <div class="col-xl-12 col-md-12 mb-12">
        <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
                @forelse($notifications as $notification)
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-2">
                                {{ $notification->data['case_no'] }}</div>
                            <div class="alert {{ $notification->read_at !== null? 'alert-secondary': 'alert-success'}}"
                                 role="alert">
                                 Case {{ $notification->data['case_no'] }}
                                {{ \Carbon\CarbonImmutable::parse($notification->data['start_time'])->isPast() ?
                                'was':'has been' }} scheduled
{{--                                {{ \Carbon\CarbonImmutable::parse($notification->data['start_time'])->isPast() ?--}}
{{--                                    'last ':'on ' }}--}}
{{--                                {{ \Carbon\Carbon::parse($notification->data['start_time'])->dayName }}--}}
{{--                                {{ \Carbon\CarbonImmutable::parse($notification->data['start_time'])->--}}
{{--                                     isoFormat('MMMM Do YYYY h:mm A') }}--}}
                                {{ \Carbon\CarbonImmutable::parse($notification->data['start_time'])->calendar()}}
                                {{ $notification->data['venue'] }}.
                                <a href="#" class="badge badge-pill badge-counter">
                                    <i class="fa fa-calendar-day">
                                        {{ \Carbon\CarbonImmutable::parse($notification->data['start_time'])->
                                   isoFormat('MMMM Do YYYY h:mm A') }}
                                    </i>
                                </a>
                                @if ( $notification->read_at === null)
                                    <a href="#" class="badge badge-pill badge-primary float-right mark-as-read" data-id="{{ $notification->id }}">
                                        Mark as read
                                    </a>
                                @endif
                                <hr>
                            </div>
                        </div>
                    </div>
                    @if($loop->last)
                        <a href="#"  class="badge badge-light float-left" id="mark-all">
                            Mark all as read
                        </a>
                    @endif
                @empty
                    There are no new notifications
                @endforelse

            </div>
        </div>
    </div>

@endsection
