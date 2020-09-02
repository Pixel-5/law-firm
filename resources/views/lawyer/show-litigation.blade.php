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
                    <a href="{{ $isLawyer? route('lawyer.litigation.index'): route('files.index') }}">
                        {{ $isLawyer? 'Litigation': 'Files' }}
                    </a>
                </li>
                <li class="breadcrumb-item"><a>{{ $file->number }}</a></li>
                <li class="offset-11 d-sm-block" style="height: 10px;margin-top: -30px;">
                    <a href="{{ url()->previous() }}" title="Back">
                        <i class="fa fa-2x fa-chevron-circle-left"></i>
                    </a>
                </li>
            </ol>
        </nav>
        <!-- Modal -->
        <div class="modal fade" id="openInitialConsultationFormModal" tabindex="-1" role="dialog"
             aria-labelledby="openClientCaseModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="openInitialConsultationFormModal">Initial Consultation Form</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="alert alert-primary" role="alert">
                            Document Number SA/LIT/IN-COS-FRM/02
                        </div>
                        <form method="POST" action="{{ $file->consultation != null ?
                            route('lawyer.initial-consultation-form.update',['initial_consultation_form'=>$file->consultation->id]):
                            route('lawyer.initial-consultation-form.store') }}"
                              enctype="multipart/form-data">
                            @if($file->consultation != null )
                                @method('PUT')
                                @endif
                            @honeypot
                            @csrf
                            <div class="form-group ">
                                <label for="inputCaseNumber">File No</label>
                                <input type="text" class="form-control" disabled
                                       value="{{ $file->consultation != null ? $file->consultation->number : \Illuminate\Support\Str::caseNumber() }}">
                                <input type="hidden" name="number" class="form-control"
                                       id="number"  value="{{ $file->consultation != null ? $file->consultation->number : \Illuminate\Support\Str::caseNumber() }}">
                                <input type="hidden" name="litigation_id" class="form-control"
                                       id="litigation_id"  value="{{ $file->id }}">
                            </div>
                            <div class="form-group ">
                                <label for="inputPlaintiffName">Client's Name</label>
                                <input disabled type="text" class="form-control" id="client" name="client"
                                      value=" {{ $file->client->clientable->name }}">
                            </div>
                            <div class="form-group">
                                <label for="inputDefendantName">Attorney</label>
                                <input disabled type="text" class="form-control" id="attorney" name="attorney"
                                value="{{ $file->user->name }}">
                            </div>
                            <div class="form-group">
                                <label for="inputMatter">Matter</label>
                                <input type="text" class="form-control" id="defendant" name="matter"
                                      @if($file->consultation != null) value="{{ $file->consultation->matter }}" @endif
                                       required>
                            </div>
                            <div class="row">
                                <div class="col col-6">
                                    <div class="form-group">
                                        <label for="inputDefendantName">Date</label>
                                        <input type="date" class="form-control" id="date" name="date"
                                               @if($file->consultation != null) value="{{ $file->consultation->date }}"
                                               @else
                                               value="{{ date('Y-m-d') }}"
                                               @endif>
                                    </div>
                                </div>
                                <div class="col col-6">
                                    <div class="form-group">
                                        <label for="inputDefendantName">Time from</label>
                                        <input type="time" class="form-control" id="time_from"
                                               name="start_time"
                                               @if($file->consultation != null) value="{{ $file->consultation->start_time }}"
                                               @else
                                               value="{{ date('H:i') }}"
                                               @endif
                                             >
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col col-6">
                                    <div class="form-group">
                                        <label for="inputDefendantName">Venue</label>
                                        <input type="text" class="form-control" id="venue"
                                               name="venue" required
                                               @if($file->consultation != null) value="{{ $file->consultation->venue }}"
                                            @endif>
                                    </div>
                                </div>
                                <div class="col col-6">
                                    <div class="form-group">
                                        <label for="inputDefendantName">Time To</label>
                                        <input type="time" class="form-control" id="time_to" name="end_time"
                                               @if($file->consultation != null) value="{{ $file->consultation->end_time }}"
                                            @endif>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputDetails">Description of case/matter</label>
                                <textarea class="form-control text-left" aria-label="With textarea"
                                          name="description" rows="10" cols="50"  required>@if($file->consultation != null){{ $file->consultation->description }}@endif
                                </textarea>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit"
                                        class="btn {{ $file->consultation != null? 'btn-info':'btn-primary' }}">
                                    Save case</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="openFileNoteFormModal" tabindex="-1" role="dialog"
             aria-labelledby="openClientCaseModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="openClientCaseModalLabel">File Note Form </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="alert alert-primary" role="alert">
                            Document Number SA/LIT/FLNOT-FRM/04
                        </div>
                        <form method="POST" action="{{ route('lawyer.note-form.store') }}"
                              enctype="multipart/form-data">
                            @honeypot
                            @csrf
                            <div class="form-group ">
                                <label for="inputCaseNumber">File No</label>
                                <input type="text" class="form-control" disabled
                                       value="{{ \Illuminate\Support\Str::caseNumber() }}">
                                <input type="hidden" name="number" class="form-control"
                                       id="number"  value="{{ \Illuminate\Support\Str::caseNumber() }}">
                                <input type="hidden" name="litigation_id" class="form-control"
                                       id="litigation_id"  value="{{ $file->id }}">
                            </div>
                            <div class="form-group ">
                                <label for="inputPlaintiffName">Client's Name</label>
                                <input disabled type="text" class="form-control" id="client" name="client"
                                       value=" {{ $file->client->clientable->name }}">
                            </div>
                            <div class="form-group">
                                <label for="inputDefendantName">Attorney</label>
                                <input disabled type="text" class="form-control" id="attorney" name="attorney"
                                       value="{{ $file->user->name }}">
                            </div>
                            <div class="form-group">
                                <label for="inputMatter">Other Party(s)</label>
                                <input type="text" class="form-control" id="other_party" name="other_party"
                                       required>
                            </div>
                            <div class="form-group">
                                <label for="inputMatter">Other Attorneys</label>
                                <input type="text" class="form-control" id="other_party" name="other_attorneys"
                                       required>
                            </div>
                            <div class="form-group">
                                <label for="inputMatter">Name of Judge</label>
                                <input type="text" class="form-control" id="other_party" name="judge_name"
                                       required>
                            </div>
                            <div class="row">
                                <div class="col col-6">
                                    <div class="form-group">
                                        <label for="inputDefendantName">Date</label>
                                        <input type="date" class="form-control" id="date" name="date"
                                               value="{{ date('Y-m-d') }}">
                                    </div>
                                </div>
                                <div class="col col-6">
                                    <div class="form-group">
                                        <label for="inputDefendantName">Time from</label>
                                        <input type="time" class="form-control" id="time_from"
                                               name="start_time" value="{{ date('H:i') }}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col col-6">
                                    <div class="form-group">
                                        <label for="inputDefendantName">Venue</label>
                                        <input type="text" class="form-control" id="venue"
                                               name="venue" required>
                                    </div>
                                </div>
                                <div class="col col-6">
                                    <div class="form-group">
                                        <label for="inputDefendantName">Time To</label>
                                        <input type="time" class="form-control" id="time_to" name="end_time" required>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputDetails">Description of work or occurrence</label>
                                <textarea class="form-control text-left" aria-label="With textarea"
                                          name="description" rows="10" cols="50"  required></textarea>
                            </div>
                                <div class="row">
                                    <div class="col col-6">
                                        <div class="form-group">
                                            <label for="inputDefendantName">Time Taken</label>
                                            <input type="time" class="form-control" id="time_taken"
                                                   name="time_taken" required>
                                        </div>
                                    </div>
                                    <div class="col col-6">
                                        <div class="form-group">
                                            <label for="inputDefendantName">Hourly rate</label>
                                            <input type="number" class="form-control" id="hourly_rate"
                                                   name="hourly_rate" required>
                                        </div>
                                    </div>
                                </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit"
                                        class="btn {{ $file->consultation != null? 'btn-info':'btn-primary' }}">
                                    Save case</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="alert alert-primary fade show" role="alert">
            <strong> {{ $file->consultation == null ? 'Client has no Initial consultation form recorded!':'' }}</strong>
            Click the button to {{ $file->consultation == null ? 'add new ': 'edit' }} Initial consultation form and
            other note forms.
            <div class="container-fluid mt-2">
                <div class="row-cols-md-3 m-auto p-3">
                    @can('case_create')
                        <a href="#" class="btn btn-md btn-outline-primary shadow-sm" data-toggle="modal"
                           data-target="#openInitialConsultationFormModal">
                            <i class="fa fa-file-contract fa-sm text-dark-100"></i> Initial Consultation Form
                        </a>
                    @endcan
                        @if($file->category =='matrimony' && $file->consultation != null)
                            @can('case_create')
                                <a href="{{ route('lawyer.matrimony-form.show',['matrimony_form'=>$file]) }}"
                                   class="btn btn-md btn-outline-secondary shadow-sm">
                                    <i class="fa fa-file-alt fa-sm text-dark-100"></i> Matrimony Form
                                </a>
                            @endcan
                        @endif
                        @if(($file->consultation != null &&
                            ($file->category !='matrimony' || ($file->category =='matrimony' && $file->matrimony != null))))
                            @can('case_create')
                                <a href="#" class="btn btn-md btn-outline-info shadow-sm" data-toggle="modal"
                                   data-target="#openFileNoteFormModal">
                                    <i class="fa fa-file-alt fa-sm text-dark-100"></i> File Note Form
                                </a>
                            @endcan
                        @endif
                </div>
            </div>
        </div>
        <div class="row-cols-1">
            <div class="alert alert-warning alert-heading " role="alert">
                <h6 class="text-dark">Litigation Category: <span>{{ $file->category }}</span></h6>
            </div>
        </div>
        <div class="alert alert-primary fade show" role="alert">
            <input type="hidden" name="_token" value="{{ @csrf_token() }}">
            @foreach($file->notes as $note)
                <div class="card shadow mb-4">
                    <!-- Card Header - Accordion -->
                    <a href="#{{ $note->number }}" class="d-block card-header py-3" data-toggle="collapse"
                       role="button" aria-expanded="true" aria-controls="{{ $note->number }}">
                        <h6 class="m-0 font-weight-bold text-primary">File Note {{ $note->number }}
{{--                            <span class="badge badge-info ">{{ $file->status }}</span>--}}
                        </h6>
                    </a>
                    <!-- Card Content - Collapse -->
                    <div class="collapse hide" id="{{ $note->number }}">
                        <div class="card-body">
                            <div class="container">
                                <p  class="alert alert-primary show" role="alert">Edit File Note Information Document Number <span class="float-right">SA/LIT/FLNOT-FRM/04</span></p>
                            </div>
                            <div class="container">
                                <div class="row-cols-1">
                                    <form method="POST" action="{{  route('lawyer.note-form.update',['note_form'=>$note->id]) }}"
                                          enctype="multipart/form-data">
                                        @method('PUT')
                                        @honeypot
                                        @csrf
                                        <div class="form-group ">
                                            <label for="inputCaseNumber">File No</label>
                                            <input type="text" class="form-control" disabled
                                                   value="{{$note->number }}">
                                        </div>
                                        <div class="form-group ">
                                            <label for="inputPlaintiffName">Client's Name</label>
                                            <input disabled type="text" class="form-control" id="client" name="client"
                                                   value=" {{ $file->client->clientable->name }}">
                                        </div>
                                        <div class="form-group">
                                            <label for="inputDefendantName">Attorney</label>
                                            <input disabled type="text" class="form-control" id="attorney" name="attorney"
                                                   value="{{ $file->user->name }}">
                                        </div>
                                        <div class="form-group">
                                            <label for="inputMatter">Other Party(s)</label>
                                            <input type="text" class="form-control" id="other_party" name="other_party"
                                                   value="{{ $note->other_party }}">
                                        </div>
                                        <div class="form-group">
                                            <label for="inputMatter">Other Attorneys</label>
                                            <input type="text" class="form-control" id="other_party" name="other_attorneys"
                                                   value="{{ $note->other_attorneys }}">
                                        </div>
                                        <div class="row">
                                            <div class="col col-6">
                                                <div class="form-group">
                                                    <label for="inputDefendantName">Date</label>
                                                    <input type="date" class="form-control" id="date" name="date"
                                                           value="{{ $note->date }}">
                                                </div>
                                            </div>
                                            <div class="col col-6">
                                                <div class="form-group">
                                                    <label for="inputDefendantName">Time from</label>
                                                    <input type="time" class="form-control" id="time_from"
                                                           name="start_time"
                                                           value="{{ $file->consultation->start_time }}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col col-6">
                                                <div class="form-group">
                                                    <label for="inputDefendantName">Venue</label>
                                                    <input type="text" class="form-control" id="venue"
                                                           name="venue" value="{{ $note->venue }}">
                                                </div>
                                            </div>
                                            <div class="col col-6">
                                                <div class="form-group">
                                                    <label for="inputDefendantName">Time To</label>
                                                    <input type="time" class="form-control" id="time_to" name="end_time"
                                                           value="{{ $note->end_time }}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputDetails">Description of work or occurrence</label>
                                            <textarea class="form-control text-left" aria-label="With textarea"
                                                      name="description" rows="10" cols="50"  required>{{ $note->description }}</textarea>
                                        </div>
                                        <div class="row">
                                            <div class="col col-6">
                                                <div class="form-group">
                                                    <label for="inputDefendantName">Time Taken</label>
                                                    <input type="time" class="form-control" id="time_taken"
                                                           name="time_taken" value="{{ $note->time_taken }}">
                                                </div>
                                            </div>
                                            <div class="col col-6">
                                                <div class="form-group">
                                                    <label for="inputDefendantName">Time To</label>
                                                    <input type="number" class="form-control" id="hourly_rate" name="hourly_rate"
                                                           value="{{ $note->hourly_rate }}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button id="{{ $note->id }}" type="button"
                                               class="btn deleteLitigationNote btn-outline-danger ">Delete
                                            </button>
                                            <button type="submit" class="btn btn-outline-primary">Save</button>
                                        </div>
                                    </form>
                                </div>
                                <div class="clearfix"></div>
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
