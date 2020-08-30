@extends('layouts.default')
<!--  Content -->
@section('custom-links')
    <link href="{{ asset('css/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/responsive.bootstrap4.min.css') }}" rel="stylesheet">
@endsection
@section('content')
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
            <li class="breadcrumb-item">
                <a href="{{ route('lawyer.litigation.show',['litigation'=>$file->id]) }}">{{ $file->number }}</a></li>
            <li class="breadcrumb-item"><a>Matrimony</a></li>
            <li class="offset-11 d-sm-block" style="height: 10px;margin-top: -30px;">
                <a href="{{ url()->previous() }}" title="Back">
                    <i class="fa fa-2x fa-chevron-circle-left"></i>
                </a>
            </li>
        </ol>
    </nav>
    <div class="container-fluid">
        <p  class="alert alert-primary show" role="alert">
            Client Seeking Divorce Form
            <span class="float-right">SA/LIT/SEE-DIV/03</span></p>
    </div>
    <form method="POST" action="{{  route('lawyer.matrimony-form.store') }}"
          enctype="multipart/form-data">
        @honeypot
        @csrf
        <div class="container-fluid">
            <div class="card shadow mb-4">
                <!-- Card Header - Accordion -->
                <a href="#clientsPersonalInformation" class="d-block card-header py-3" data-toggle="collapse"
                   role="button" aria-expanded="true" aria-controls="clientsPersonalInformation">
                    <h6 class="m-0 font-weight-bold text-primary">1. Client's Personal Details</h6>
                </a>
                <!-- Card Content - Collapse -->
                <div class="collapse hide" id="clientsPersonalInformation">
                    <div class="card-body">
                        <div class="container">
                            <div class="row-cols-1">
                                <div class="form-group ">
                                    <label for="inputName">Name (as appears in Omang)</label>
                                    <input type="text" class="form-control" name="omang_name">
                                </div>
                                <div class="form-group ">
                                    <label for="inputName">Name (as it appears in Marriage Certificate)</label>
                                    <input type="text" class="form-control" name="marriage_certificate_name">
                                </div>
                                <div class="form-group ">
                                    <label for="inputPhysicalAddress">Physical Address</label>
                                    <input type="text" class="form-control" name="physical_address">
                                </div>
                                <div class="form-group ">
                                    <label for="inputPostalAddress">Postal Address</label>
                                    <input type="text" class="form-control" name="postal_address">
                                </div>
                                <div class="form-group ">
                                    <label for="inputCell">Cell</label>
                                    <input type="tel" class="form-control" name="cell">
                                </div>
                                <div class="form-group">
                                    <label for="inputEmail">Email</label>
                                    <input type="text" class="form-control" name="email">
                                </div>
                                <div class="form-group">
                                    <label for="inputOccupation">Occupation</label>
                                    <input type="text" class="form-control" name="occupation">
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="card shadow mb-4">
                <!-- Card Header - Accordion -->
                <a href="#SpousePersonalInformation" class="d-block card-header py-3" data-toggle="collapse"
                   role="button" aria-expanded="true" aria-controls="SpousePersonalInformation">
                    <h6 class="m-0 font-weight-bold text-primary">2. Spouse's Personal Details</h6>
                </a>
                <!-- Card Content - Collapse -->
                <div class="collapse hide" id="SpousePersonalInformation">
                    <div class="card-body">
                        <div class="container">
                            <div class="row-cols-1">
                                <div class="form-group ">
                                    <label for="inputSpouseName">Name</label>
                                    <input type="text" class="form-control" name="spouse_name"/>
                                </div>
                                <div class="form-group ">
                                    <label for="inputSpousePhysicalAddress">Physical Address</label>
                                    <input type="text" class="form-control" name="spouse_physical_address">
                                </div>
                                <div class="form-group ">
                                    <label for="inputSpousePostalAddress">Postal Address</label>
                                    <input type="text" class="form-control" name="spouse_postal_address">
                                </div>
                                <div class="form-group">
                                    <label for="inputOccupation">Occupation</label>
                                    <input type="text" class="form-control" name="spouse_occupation">
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="card shadow mb-4">
                <!-- Card Header - Accordion -->
                <a href="#clientsMarriageInformation" class="d-block card-header py-3" data-toggle="collapse"
                   role="button" aria-expanded="true" aria-controls="clientsMarriageInformation">
                    <h6 class="m-0 font-weight-bold text-primary">3. Marriage</h6>
                </a>
                <!-- Card Content - Collapse -->
                <div class="collapse hide" id="clientsMarriageInformation">
                    <div class="card-body">
                        <div class="container">
                            <div class="row-cols-1">
                                <div class="form-group ">
                                    <label for="inputSpouseMarriageDate">Date of Marriage</label>
                                    <input type="text" class="form-control" name="spouse_name"/>
                                </div>
                                <div class="form-group ">
                                    <label for="inputSpouseMarriagePlace">Place of Marriage</label>
                                    <input type="text" class="form-control" name="spouse_physical_address">
                                </div>
                                <div class="form-group ">
                                    <label for="inputSpouseRegime">Regime(In out of Community of Property)</label>
                                    <input type="text" class="form-control" name="spouse_postal_address">
                                </div>
                                <div class="form-group">
                                    <label for="inputOccupation">
                                        Provide copy of marriage certificate and keep original- be sure to bring original
                                        on court date)
                                    </label>
                                    <div class="file-upload-wrapper">
                                        <input type="file" id="input-file-now" class="file-upload" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="card shadow mb-4">
                <!-- Card Header - Accordion -->
                <a href="#clientsResidenceInformation" class="d-block card-header py-3" data-toggle="collapse"
                   role="button" aria-expanded="true" aria-controls="clientsResidenceInformation">
                    <h6 class="m-0 font-weight-bold text-primary">4. Nationality and Residence</h6>
                </a>
                <!-- Card Content - Collapse -->
                <div class="collapse hide" id="clientsResidenceInformation">
                    <div class="card-body">
                        <div class="container">
                            <div class="row-cols-1">
                                <div class="form-group ">
                                    <label for="gender">Residence</label>
                                    <input type="text" class="form-control" name="nationality_residence">
                                </div>
                                <div class="form-group">
                                    <label for="gender">Are you a citizen of Botswana?</label>
                                    <div class="form-row">
                                        <div class="form-group col-md-1">
                                            <label class="radio-inline">
                                                <input type="radio" name="is_citizen" value="Yes">Yes
                                            </label>
                                        </div>
                                        <div class="form-group col-md-1">
                                            <label class="radio-inline">
                                                <input type="radio" name="is_citizen" value="No"> No
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="gender">Are you a resident of Botswana?</label>
                                    <div class="form-row">
                                        <div class="form-group col-md-1">
                                            <label class="radio-inline">
                                                <input type="radio" name="is_resident" value="Yes">Yes</label>
                                        </div>
                                        <div class="form-group col-md-1">
                                            <label class="radio-inline">
                                                <input type="radio" name="is_resident" value="No"> No
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="gender">Are you a resident of Botswana? Since when?</label>
                                    <input type="date" class="form-control" name="resident_since">
                                </div>
                                <div class="form-group">
                                    <label for="gender">Is your spouse a resident of Botswana? Since when?</label>
                                    <input type="date" class="form-control" name="is_spouse_resident_since">
                                </div>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="card shadow mb-4">
                <!-- Card Header - Accordion -->
                <a href="#residenceInformation" class="d-block card-header py-3" data-toggle="collapse"
                   role="button" aria-expanded="true" aria-controls="residenceInformation">
                    <h6 class="m-0 font-weight-bold text-primary">5. Where have you and your spouse resided since marriage
                        (give full information on all the places you have lived together or apart)</h6>
                </a>
                <!-- Card Content - Collapse -->
                <div class="collapse hide" id="residenceInformation">
                    <div class="card-body">
                        <div class="container">
                            <div class="form-group">
                                <label for="residence_from">From</label>
                                <input type="date" class="form-control" name="has_lived_together_to">
                            </div>
                            <div class="form-group">
                                <label for="residence_to">To</label>
                                <input type="date" class="form-control" name="has_lived_together_to">
                            </div>
                            <div class="form-group">
                                <label for="gender">Lived? (Lived together)</label>
                                <div class="form-row">
                                    <div class="form-group col-md-1">
                                        <label class="radio-inline">
                                            <input type="radio" name="has_lived_together" value="Yes" >Yes</label>
                                    </div>
                                    <div class="form-group col-md-1">
                                        <label class="radio-inline">
                                            <input type="radio" name="has_lived_together" value="No"> No</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="lived_to">From:</label>
                                <input type="date" class="form-control" name="has_lived_apart_from">
                            </div>
                            <div class="form-group">
                                <label for="lived_to">To:</label>
                                <input type="date" class="form-control" name="lived_apart_to">
                            </div>
                            <div class="form-group">
                                <label for="gender">Lived? (Lived apart)</label>
                               <div class="form-row">
                                   <div class="form-group col-md-1">
                                       <label class="radio-inline">
                                           <input type="radio" name="has_lived_part" value="Yes">Yes</label>
                                   </div>
                                   <div class="form-group col-md-1">
                                       <label class="radio-inline">
                                           <input type="radio" name="has_lived_part" value="No"> No</label>
                                   </div>
                               </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="card shadow mb-4">
                <!-- Card Header - Accordion -->
                <a href="#clientsChildrenInformation" class="d-block card-header py-3" data-toggle="collapse"
                   role="button" aria-expanded="true" aria-controls="clientsChildrenInformation">
                    <h6 class="m-0 font-weight-bold text-primary">6. Do you have children?</h6>
                </a>
                <!-- Card Content - Collapse -->
                <div class="collapse hide" id="clientsChildrenInformation">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="example" class="table hover table-borderless nowrap" style="width:100%">
                                <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>D.O.B</th>
                                    <th>School</th>
                                    <th>Standard</th>
                                    <th></th>
{{--                                    <th>Residence</th>--}}
{{--                                    <th>Residence</th>--}}
{{--                                    <th>Marital Child?</th>--}}
                                </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <input type="text" class="form-control"  name="child_name[]"/>
                                        </td>
                                        <td>
                                            <input type="date" class="form-control"  name="child_dob[]"/>
                                        </td>
                                        <td>
                                            <input type="text" class="form-control"  name="child_school[]" />
                                        </td>
                                        <td>
                                            <input type="text" class="form-control" name="child_standard[]"/>
                                        </td>
                                        <td>
                                            <button type="button" id="btn_add" class="btn btn-sm btn-outline-primary"
                                            onclick="addField()">
                                                Add More
                                            </button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card shadow mb-4">
                <!-- Card Header - Accordion -->
                <a href="#clientsPersonalInformation" class="d-block card-header py-3" data-toggle="collapse"
                   role="button" aria-expanded="true" aria-controls="clientsPersonalInformation">
                    <h6 class="m-0 font-weight-bold text-primary">7. Have you sued for divorce and /or maintenance and /or restraining order before? (State the casenumber/Parties/Court</h6>
                </a>
                <!-- Card Content - Collapse -->
                <div class="collapse hide" id="clientsPersonalInformation">
                    <div class="card-body">
                        <div class="container">
                            <p  class="alert alert-primary show" role="alert">
                                Client Seeking Divorce Form
                                <span class="float-right">SA/LIT/SEE-DIV/03</span></p>
                        </div>
                        <div class="container">
                            <div class="row-cols-1">
                                <form method="POST" action="{{  route('lawyer.matrimony-form.store') }}"
                                      enctype="multipart/form-data">
                                    @honeypot
                                    @csrf
                                    <div class="form-group ">
                                        <label for="inputCaseNumber">File No</label>
                                        <input type="text" class="form-control" disabled
                                               value="{{ \Illuminate\Support\Str::caseNumber()  }}">
                                    </div>
                                    <div class="form-group ">
                                        <label for="inputPlaintiffName">Client's Name</label>
                                        <input disabled type="text" class="form-control" id="client" name="client"
                                               value=" {{ $file->client->clientable->name }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="inputDefendantName">Attorney</label>
                                        <input  type="text" class="form-control" id="attorney" name="attorney">
                                    </div>
                                    <div class="form-group">
                                        <label for="inputMatter">Other Party(s)</label>
                                        <input type="text" class="form-control" id="other_party" name="other_party">
                                    </div>
                                    <div class="form-group">
                                        <label for="inputMatter">Other Attorneys</label>
                                        <input type="text" class="form-control" id="other_party" name="other_attorneys">
                                    </div>
                                    <div class="row">
                                        <div class="col col-6">
                                            <div class="form-group">
                                                <label for="inputDefendantName">Date</label>
                                                <input type="date" class="form-control" id="date" name="date">
                                            </div>
                                        </div>
                                        <div class="col col-6">
                                            <div class="form-group">
                                                <label for="inputDefendantName">Time from</label>
                                                <input type="time" class="form-control" id="time_from"
                                                       name="start_time">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col col-6">
                                            <div class="form-group">
                                                <label for="inputDefendantName">Venue</label>
                                                <input type="text" class="form-control" id="venue"
                                                       name="venue" >
                                            </div>
                                        </div>
                                        <div class="col col-6">
                                            <div class="form-group">
                                                <label for="inputDefendantName">Time To</label>
                                                <input type="time" class="form-control" id="time_to" name="end_time">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputDetails">Description of work or occurrence</label>
                                        <textarea class="form-control text-left" aria-label="With textarea"
                                                  name="description" rows="10" cols="50"  required></textarea>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-primary">Save</button>
                                    </div>
                                </form>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="card shadow mb-4">
                <!-- Card Header - Accordion -->
                <a href="#clientsPersonalInformation" class="d-block card-header py-3" data-toggle="collapse"
                   role="button" aria-expanded="true" aria-controls="clientsPersonalInformation">
                    <h6 class="m-0 font-weight-bold text-primary">8. Have you reached a written agreement or settlement with your spouse?</h6>
                </a>
                <!-- Card Content - Collapse -->
                <div class="collapse hide" id="clientsPersonalInformation">
                    <div class="card-body">
                        <div class="container">
                            <p  class="alert alert-primary show" role="alert">
                                Client Seeking Divorce Form
                                <span class="float-right">SA/LIT/SEE-DIV/03</span></p>
                        </div>
                        <div class="container">
                            <div class="row-cols-1">
                                <form method="POST" action="{{  route('lawyer.matrimony-form.store') }}"
                                      enctype="multipart/form-data">
                                    @honeypot
                                    @csrf
                                    <div class="form-group ">
                                        <label for="inputCaseNumber">File No</label>
                                        <input type="text" class="form-control" disabled
                                               value="{{ \Illuminate\Support\Str::caseNumber()  }}">
                                    </div>
                                    <div class="form-group ">
                                        <label for="inputPlaintiffName">Client's Name</label>
                                        <input disabled type="text" class="form-control" id="client" name="client"
                                               value=" {{ $file->client->clientable->name }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="inputDefendantName">Attorney</label>
                                        <input  type="text" class="form-control" id="attorney" name="attorney">
                                    </div>
                                    <div class="form-group">
                                        <label for="inputMatter">Other Party(s)</label>
                                        <input type="text" class="form-control" id="other_party" name="other_party">
                                    </div>
                                    <div class="form-group">
                                        <label for="inputMatter">Other Attorneys</label>
                                        <input type="text" class="form-control" id="other_party" name="other_attorneys">
                                    </div>
                                    <div class="row">
                                        <div class="col col-6">
                                            <div class="form-group">
                                                <label for="inputDefendantName">Date</label>
                                                <input type="date" class="form-control" id="date" name="date">
                                            </div>
                                        </div>
                                        <div class="col col-6">
                                            <div class="form-group">
                                                <label for="inputDefendantName">Time from</label>
                                                <input type="time" class="form-control" id="time_from"
                                                       name="start_time">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col col-6">
                                            <div class="form-group">
                                                <label for="inputDefendantName">Venue</label>
                                                <input type="text" class="form-control" id="venue"
                                                       name="venue" >
                                            </div>
                                        </div>
                                        <div class="col col-6">
                                            <div class="form-group">
                                                <label for="inputDefendantName">Time To</label>
                                                <input type="time" class="form-control" id="time_to" name="end_time">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputDetails">Description of work or occurrence</label>
                                        <textarea class="form-control text-left" aria-label="With textarea"
                                                  name="description" rows="10" cols="50"  required></textarea>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-primary">Save</button>
                                    </div>
                                </form>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="card shadow mb-4">
                <!-- Card Header - Accordion -->
                <a href="#clientsPersonalInformation" class="d-block card-header py-3" data-toggle="collapse"
                   role="button" aria-expanded="true" aria-controls="clientsPersonalInformation">
                    <h6 class="m-0 font-weight-bold text-primary">9. Why do you say your marriage has broken down? (Provide reasons) </h6>
                </a>
                <!-- Card Content - Collapse -->
                <div class="collapse hide" id="clientsPersonalInformation">
                    <div class="card-body">
                        <div class="container">
                            <p  class="alert alert-primary show" role="alert">
                                Client Seeking Divorce Form
                                <span class="float-right">SA/LIT/SEE-DIV/03</span></p>
                        </div>
                        <div class="container">
                            <div class="row-cols-1">
                                <form method="POST" action="{{  route('lawyer.matrimony-form.store') }}"
                                      enctype="multipart/form-data">
                                    @honeypot
                                    @csrf
                                    <div class="form-group ">
                                        <label for="inputCaseNumber">File No</label>
                                        <input type="text" class="form-control" disabled
                                               value="{{ \Illuminate\Support\Str::caseNumber()  }}">
                                    </div>
                                    <div class="form-group ">
                                        <label for="inputPlaintiffName">Client's Name</label>
                                        <input disabled type="text" class="form-control" id="client" name="client"
                                               value=" {{ $file->client->clientable->name }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="inputDefendantName">Attorney</label>
                                        <input  type="text" class="form-control" id="attorney" name="attorney">
                                    </div>
                                    <div class="form-group">
                                        <label for="inputMatter">Other Party(s)</label>
                                        <input type="text" class="form-control" id="other_party" name="other_party">
                                    </div>
                                    <div class="form-group">
                                        <label for="inputMatter">Other Attorneys</label>
                                        <input type="text" class="form-control" id="other_party" name="other_attorneys">
                                    </div>
                                    <div class="row">
                                        <div class="col col-6">
                                            <div class="form-group">
                                                <label for="inputDefendantName">Date</label>
                                                <input type="date" class="form-control" id="date" name="date">
                                            </div>
                                        </div>
                                        <div class="col col-6">
                                            <div class="form-group">
                                                <label for="inputDefendantName">Time from</label>
                                                <input type="time" class="form-control" id="time_from"
                                                       name="start_time">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col col-6">
                                            <div class="form-group">
                                                <label for="inputDefendantName">Venue</label>
                                                <input type="text" class="form-control" id="venue"
                                                       name="venue" >
                                            </div>
                                        </div>
                                        <div class="col col-6">
                                            <div class="form-group">
                                                <label for="inputDefendantName">Time To</label>
                                                <input type="time" class="form-control" id="time_to" name="end_time">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputDetails">Description of work or occurrence</label>
                                        <textarea class="form-control text-left" aria-label="With textarea"
                                                  name="description" rows="10" cols="50"  required></textarea>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-primary">Save</button>
                                    </div>
                                </form>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="card shadow mb-4">
                <!-- Card Header - Accordion -->
                <a href="#clientsPropertyInformation" class="d-block card-header py-3" data-toggle="collapse"
                   role="button" aria-expanded="true" aria-controls="clientsPropertyInformation">
                    <h6 class="m-0 font-weight-bold text-primary">10. Please provide a list of all your property: </h6>
                </a>
                <!-- Card Content - Collapse -->
                <div class="collapse hide" id="clientsPropertyInformation">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="movable_property" class="table hover table-borderless nowrap" style="width:100%">
                                <thead>
                                <tr>
                                    <th>Property Number</th>
                                    <th>Property Type</th>
                                    <th>Property Status</th>
                                    <th>Property Value</th>
                                    <th>Fully Paid for?</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>
                                        <input type="text" class="form-control"  name="plot_number[]"/>
                                    </td>
                                    <td>
                                        <select class="form-control form-control-md"  name="movable_property_type[]" required>
                                            <option>Developed</option>
                                            <option>Undeveloped</option>
                                        </select>
                                    </td>
                                    <td>
                                        <input type="text" class="form-control"  name="movable_property_status[]" />
                                    </td>
                                    <td>
                                        <input type="text" class="form-control" placeholder="(Approx)" name="movable_property_value[]"/>
                                    </td>
                                    <td>
                                        <input type="text" class="form-control" name="movable_property_title_holder[]"/>
                                    </td>
                                    <td>
                                        <button type="button" id="btn_add_movable" class="btn btn-sm btn-outline-primary"
                                                onclick="addMovablePropertyField()">
                                            Add More
                                        </button>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="table-responsive">
                            <table id="immovable_property" class="table hover table-borderless nowrap" style="width:100%">
                                <thead>
                                <tr>
                                    <th>Type</th>
                                    <th>Where is it?</th>
                                    <th>Ialue</th>
                                    <th>Fun whose possession?</th>
                                    <th>Vlly Paid for?</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>
                                        <input type="text" class="form-control"  name="child_name[]"/>
                                    </td>
                                    <td>
                                        <input type="text" class="form-control"  name="child_dob[]"/>
                                    </td>
                                    <td>
                                        <input type="text" class="form-control"  name="child_school[]" />
                                    </td>
                                    <td>
                                        <input type="text" class="form-control" name="child_standard[]"/>
                                    </td>
                                    <td>
                                        <input type="text" class="form-control" name="child_standard[]"/>
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-sm btn-outline-primary"
                                                onclick="addImmovablePropertyField()">
                                            Add More
                                        </button>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card shadow mb-4">
                <!-- Card Header - Accordion -->
                <a href="#clientsFinancialNeedsInformation" class="d-block card-header py-3" data-toggle="collapse"
                   role="button" aria-expanded="true" aria-controls="clientsFinancialNeedsInformation">
                    <h6 class="m-0 font-weight-bold text-primary">
                        11. Provide an Assessment of the Financial Needs to Maintain the Child</h6>
                </a>
                <!-- Card Content - Collapse -->
                <div class="collapse hide" id="clientsFinancialNeedsInformation">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="financial_needs" class="table hover table-borderless nowrap" style="width:100%">
                                <thead>
                                </thead>
                                <tbody>
                                <tr>
                                    <th>School Fees and School Related Expenses</th>
                                    <td>
                                        <div class="form-group">
                                            <textarea class="form-control text-left" aria-label="With textarea"
                                                      name="school_expenses" rows="2" cols="50"  required></textarea>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Transportation</th>
                                    <td>
                                        <div class="form-group">
                                            <textarea class="form-control text-left" aria-label="With textarea"
                                                      name="transportation" rows="2" cols="50"  required></textarea>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Clothes</th>
                                    <td>
                                        <div class="form-group">
                                            <textarea class="form-control text-left" aria-label="With textarea"
                                                      name="clothes" rows="2" cols="50"  required></textarea>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Groceries</th>
                                    <td>
                                        <div class="form-group">
                                            <textarea class="form-control text-left" aria-label="With textarea"
                                                      name="groceries" rows="2" cols="50"  required></textarea>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <th>House Keeper</th>
                                    <td>
                                        <div class="form-group">
                                            <textarea class="form-control text-left" aria-label="With textarea"
                                            name="house_keeper" rows="2" cols="50"  required></textarea>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Shelter</th>
                                    <td>
                                        <div class="form-group">
                                        <textarea class="form-control text-left" aria-label="With textarea"
                                          name="shelter" rows="2" cols="50"  required></textarea>
                                        </div>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card shadow mb-4">
                <!-- Card Header - Accordion -->
                <a href="#clientsPersonalInformation" class="d-block card-header py-3" data-toggle="collapse"
                   role="button" aria-expanded="true" aria-controls="clientsPersonalInformation">
                    <h6 class="m-0 font-weight-bold text-primary">12. Please provide a list of all your liabilities and
                        where relevant indicate if the liability is associated with any one piece of property
                        (e.g car loan and mortagage)
                    </h6>
                </a>
                <!-- Card Content - Collapse -->
                <div class="collapse hide" id="clientsPersonalInformation">
                    <div class="card-body">
                        <div class="container">
                            <div class="form-group">
                                <textarea class="form-control text-left" aria-label="With textarea"
                                          name="liabilities" rows="20" cols="50"  required></textarea>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="card shadow mb-4">
                <!-- Card Header - Accordion -->
                <a href="#clientsHealthInformation2" class="d-block card-header py-3" data-toggle="collapse"
                   role="button" aria-expanded="true" aria-controls="clientsHealthInformation2">
                    <h6 class="m-0 font-weight-bold text-primary">13. Please give your proposal on how the property is to
                        divide between the two of you. Remember- if you are married in community of property it matters
                        not that you were the primary contributor to the amassing of your joint wealth</h6>
                </a>
                <!-- Card Content - Collapse -->
                <div class="collapse hide" id="clientsHealthInformation2">
                    <div class="card-body">
                        <div class="container">
                            <div class="form-group">
                                <textarea class="form-control text-left" aria-label="With textarea"
                                          name="property_division" rows="20" cols="50"  required></textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row-cols-1">
                <div class="container-fluid">
                    <input type="submit" class="btn btn-outline-primary">
                </div>
            </div>
        </div>
    </form>
@endsection

@section('custom-scripts')
    <!-- Page level plugins -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>


    <!-- Custom scripts for all pages-->
    <script src="{{ asset('js/sb-admin-2.min.js') }}"></script>
    <script src="{{ asset('js/jquery-3.3.1.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('js/responsive.bootstrap4.min.js') }}"></script>
    <script type="application/javascript">
        let i = 1;
        let j= 1;

        function  addMovablePropertyField() {
            j++;
            $('#movable_property').append(
                ' <tr id="row'+j+'">' +
                ' <td>' +
                '<input type="text" class="form-control"  name="plot_number[]"/>' +
                '</td>' +
                '<td>' +
                '<select class="form-control form-control-md"  name="movable_property_type[]" required>' +
                '<option>Developed</option>' +
                '<option>Undeveloped</option>' +
                '</select>' +
                '</td>' +
                '<td>' +
                '<input type="text" class="form-control"  name="movable_property_status[]" />' +
                '</td>' +
                '<td>' +
                '<input type="text" class="form-control" placeholder="(Approx)" name="movable_property_value[]"/>' +
                '</td>' +
                '<td>' +
                '<input type="text" class="form-control" name="movable_property_title_holder[]"/>' +
                '</td>' +
                '<td>' +
                '<button type="button" class="btn btn_remove btn-sm btn-outline-danger">' +
                'Remove' +
                '</button>' +
                '</td>' +
                '</tr>');
        }
        function  addImmovablePropertyField() {

        }
        function addField(){
            i++;
            $('#example').append('<tr id="row'+i+'">' +
                '<td><input type="text" class="form-control" name="child_name[]"/></td>' +
                '<td><input type="date" class="form-control" name="child_dob[]"/></td>' +
                '<td><input type="text" class="form-control"  name="child_school[]" /></td>' +
                '<td><input type="text" class="form-control" name="child_standard[]"/></td>' +
                '<td>' +
                '<button type="button" id="'+i+'" class="btn_remove btn btn-sm btn-outline-danger">Remove</button>' +
                '</td>' +
                '</tr>');
        }
        $('#example').on('click', '.btn_remove', function (e) {
            var button_id = $(this).attr("id");
            $('#row'+button_id+'').remove();
        });
        $(document).ready(function() {
            $('#example').DataTable( {
                'searching':false,
                responsive: {
                    details: {
                        display: $.fn.dataTable.Responsive.display.modal( {
                            header: function ( row ) {
                                var data = row.data();
                                return 'Client Child Details';
                            }
                        } ),
                        renderer: $.fn.dataTable.Responsive.renderer.tableAll( {
                            tableClass: 'table'
                        } )
                    },
                },
            } );
            $('#movable_property').DataTable( {
                'searching':false,
                responsive: {
                    details: {
                        display: $.fn.dataTable.Responsive.display.modal( {
                            header: function ( row ) {
                                return 'Client Child Details';
                            }
                        } ),
                        renderer: $.fn.dataTable.Responsive.renderer.tableAll( {
                            tableClass: 'table'
                        } )
                    },
                },
            } );
            $('#immovable_property').DataTable( {
                'searching':false,
                responsive: {
                    details: {
                        display: $.fn.dataTable.Responsive.display.modal( {
                            header: function ( row ) {
                                var data = row.data();
                                return 'Client Child Details';
                            }
                        } ),
                        renderer: $.fn.dataTable.Responsive.renderer.tableAll( {
                            tableClass: 'table'
                        } )
                    },
                },
            } );
            $('#financial_needs').DataTable( {
                'searching':false,
                responsive: {
                    details: {
                        display: $.fn.dataTable.Responsive.display.modal( {
                            header: function ( row ) {
                                var data = row.data();
                                return 'Client Child Details';
                            }
                        } ),
                        renderer: $.fn.dataTable.Responsive.renderer.tableAll( {
                            tableClass: 'table'
                        } )
                    },
                },
            } );
        } );
    </script>
@endsection
