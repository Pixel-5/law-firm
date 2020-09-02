@extends('layouts.default')
@section('custom-links')
    <link href="{{ asset('css/bootstrap.css') }}" rel="stylesheet">
    <link href="{{ asset('css/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/responsive.bootstrap4.min.css') }}" rel="stylesheet">
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
                <li class="breadcrumb-item active" aria-current="page"><a href="{{ route('lawyer.schedule') }}">
                        Schedule</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">{{ $schedule->scheduleable->number }}</li>
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
        <div class="modal-content">
            <div class="modal-header">
                <h5><b>{{ class_basename($schedule->scheduleable) }} Schedule details</b></h5>
                <div class="align-items-end">

                    @can('case_access')
                        <a  class="btn btn-xs btn-outline-secondary" title="View Case"
                            href="{{ class_basename($schedule->scheduleable) == 'Litigation'?
                                    route('lawyer.litigation.show',$schedule->scheduleable->id):
                                    route('lawyer.conveyancing.show',$schedule->scheduleable->id) }}">
                            <i class="fa fa-eye"></i>
                        </a>
                    @endcan
                    @can('schedule_edit')
                        <a  class="btn btn-xs btn-outline-warning" title="Edit Schedule"
                            href="{{ route('lawyer.schedule.edit', $schedule->id) }}">
                            <i class="fa fa-pen"></i>
                        </a>
                    @endcan
                    @can('schedule_delete')
                        <form action="{{ route('lawyer.schedule.destroy', $schedule->id) }}"
                              method="POST"
                              onsubmit="return confirm('{{  trans('global.areYouSure') }}');" style="display: inline-block;"
                        >
                            <input type="hidden" name="_method" value="DELETE">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <button type="submit" class="btn btn-xs btn-outline-danger" title="Delete Schedule">
                                <i class="fa fa-trash"></i>
                            </button>
                        </form>
                    @endcan
                </div>
            </div>
{{--            @dd($schedule->scheduleable->id)--}}

            <div class="modal-body">
                <div class="mb-2">
                    <table id="example" class="table hover table-striped table-bordered nowrap" style="width:100%">
                        <tbody>
                        <tr>
                            <th>
                               {{ class_basename($schedule->scheduleable) }} Number
                            </th>
                            <td>
                                {{ $schedule->scheduleable->number }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                Client Name
                            </th>
                            <td>
                                {{  $schedule->scheduleable->client->clientable->name }} {{  $schedule->scheduleable->client->clientable->surname }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                Schedule Reason
                            </th>
                            <td>
                                {{  ucfirst($schedule->schedule_appointment) . ' Appointment' }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                Venue
                            </th>
                            <td>
                                {{  $schedule->venue ?? '' }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.event.fields.start_time') }}
                            </th>
                            <td>
                                {{  $schedule->start_time }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.event.fields.end_time') }}
                            </th>
                            <td>
                                {{  $schedule->end_time }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                Notes
                            </th>
                            <td>
                                {{  $schedule->notes }}
                            </td>
                        </tr>
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
@endsection

