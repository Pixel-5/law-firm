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
        <input type="hidden" name="litigation_id" value="{{ $file->id }}">
        <input type="hidden" name="client_id" value="{{ $file->client->id }}">
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
                                    <input type="text" id="omang_name" class="form-control" name="omang_name" required>
                                    <input type="checkbox" id="omang_name_id" class="btn btn-sm btn-primary">
                                    Same as registered name
                                </div>
                                <div class="form-group ">
                                    <label for="inputName">Name (as it appears in Marriage Certificate)</label>
                                    <input type="text" id="marriage_certificate_name" class="form-control"
                                           name="marriage_certificate_name" required>
                                    <input type="checkbox" id="certificate_name_id" class="btn btn-sm btn-primary">
                                    Same as registered name
                                </div>
                                <div class="form-group">
                                    <label for="inputName">Maiden Name: (If applicable)</label>
                                    <input type="text" class="form-control" id="maiden_name"
                                           name="maiden_name" required>
                                    <input type="checkbox" id="maiden_name_id" class="btn btn-sm btn-primary">
                                    Same as registered name
                                </div>
                                <div class="form-group ">
                                    <label for="inputPhysicalAddress">Physical Address</label>
                                    <input type="text" class="form-control" name="physical_address"
                                    value="{{ $file->client->clientable->physical_address }}" required>
                                </div>
                                <div class="form-group ">
                                    <label for="inputPostalAddress">Postal Address</label>
                                    <input type="text" class="form-control" name="postal_address" required
                                           value="{{ $file->client->clientable->postal_address }}">
                                </div>
                                <div class="form-group ">
                                    <label for="inputCell">Cell</label>
                                    <input type="tel" class="form-control" name="cell" required
                                           value="{{ $file->client->clientable->cell }}">
                                </div>
                                <div class="form-group">
                                    <label for="inputEmail">Email</label>
                                    <input type="text" class="form-control" name="email" required
                                           value="{{ $file->client->clientable->email }}">
                                </div>
                                <div class="form-group">
                                    <label for="inputOccupation">Occupation</label>
                                    <input type="text" class="form-control" name="occupation"
                                           value="{{ $file->client->clientable->occupation }}">
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
                                    <input type="date" class="form-control" name="date_marriage"/>
                                </div>
                                <div class="form-group ">
                                    <label for="inputSpouseMarriagePlace">Place of Marriage</label>
                                    <input type="text" class="form-control" name="place_of_marriage">
                                </div>
                                <div class="form-group ">
                                    <label for="inputSpouseRegime">Regime(In out of Community of Property)</label>
                                    <input type="text" class="form-control" name="regime">
                                </div>
                                <div class="form-group">
                                    <label for="inputOccupation">
                                        Provide copy of marriage certificate and keep original- be sure to bring original
                                        on court date)
                                    </label>
                                    <div class="file-upload-wrapper">
                                        <input type="file" id="marriage_certificate" name="marriage_certificate_copy" class="file-upload" />
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
                                            <label class="radio-inline"> Yes
                                                <input type="radio" name="is_citizen" value="Yes">
                                            </label>
                                        </div>
                                        <div class="form-group col-md-1">
                                            <label class="radio-inline"> No
                                                <input type="radio" name="is_citizen" value="No">
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="gender">Are you a resident of Botswana?</label>
                                    <div class="form-row">
                                        <div class="form-group col-md-1">
                                            <label class="radio-inline"> Yes
                                                <input type="radio" name="is_resident" value="Yes">
                                            </label>
                                        </div>
                                        <div class="form-group col-md-1">
                                            <label class="radio-inline"> No
                                                <input type="radio" name="is_resident" value="No">
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group hidden" id="is_resident_id">
                                    <label for="gender">Resident of Botswana since when?</label>
                                    <input type="date" class="form-control" id="resident_since" name="resident_since">
                                </div>
                                <div class="form-group">
                                    <label for="gender">Is your spouse resident of Botswana?</label>
                                    <div class="form-row">
                                        <div class="form-group col-md-1">
                                            <label class="radio-inline"> Yes
                                                <input type="radio" name="is_spouse_resident" value="Yes"></label>
                                        </div>
                                        <div class="form-group col-md-1">
                                            <label class="radio-inline"> No
                                                <input type="radio" name="is_spouse_resident" value="No">
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group hidden" id="is_spouse_resident_id">
                                    <label for="spouse_resident_since">Spouse resident of Botswana since when?</label>
                                    <input type="date" class="form-control" id="spouse_resident_since" name="spouse_resident_since">
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
                           <div id="has_lived_together_since" class="hidden">
                               <div class="form-group">
                                   <label for="has_lived_together_from">From</label>
                                   <input type="date" class="form-control" name="lived_together_from">
                               </div>
                               <div class="form-group">
                                   <label for="has_lived_together_to">To</label>
                                   <input type="date" class="form-control" name="lived_together_to">
                               </div>
                           </div>
                            <div class="form-group">
                                <label for="gender">Lived? (Lived apart)</label>
                                <div class="form-row">
                                    <div class="form-group col-md-1">
                                        <label class="radio-inline"> Yes
                                            <input type="radio" name="has_lived_part" value="Yes"></label>
                                    </div>
                                    <div class="form-group col-md-1">
                                        <label class="radio-inline"> No
                                            <input type="radio" name="has_lived_part" value="No"> </label>
                                    </div>
                                </div>
                            </div>
                            <div class="hidden" id="has_lived_apart_since">
                                <div class="form-group">
                                    <label for="lived_to">From:</label>
                                    <input type="date" class="form-control" name="lived_apart_from">
                                </div>
                                <div class="form-group">
                                    <label for="lived_to">To:</label>
                                    <input type="date" class="form-control" name="lived_apart_to">
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
                            <table id="children" class="table hover table-borderless nowrap" style="width:100%">
                                <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>D.O.B</th>
                                    <th>School</th>
                                    <th>Standard</th>
                                    <th></th>
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
                        <div class="table-responsive">
                            <table id="children_two" class="table hover table-borderless nowrap" style="width:100%">
                                <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Residence</th>
                                    <th>Marital Child</th>
                                    <th>Non-Marital Child</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>
                                        <input type="text" class="form-control"  name="child2_name[]"/>
                                    </td>
                                    <td>
                                        <input type="text" class="form-control"  name="residence[]"/>
                                    </td>
                                    <td>
                                        <select class="form-control form-control-md"  name="marital_child[]" required>
                                            <option value="None" selected>None</option>
                                            <option value="Biological">Biological</option>
                                            <option value="Adopted">Adopted</option>
                                        </select>
                                    </td>
                                    <td>
                                        <select class="form-control form-control-md"  name="non_marital_child[]" required>
                                            <option value="None" selected>None</option>
                                            <option value="Biological">Husbands</option>
                                            <option value="Adopted">Wife's</option>
                                        </select>
                                    </td>
                                    <td>
                                        <button type="button" id="btn_add" class="btn btn-sm btn-outline-primary"
                                                onclick="addChild2()">
                                            Add More
                                        </button>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="form-group">
                            <label for="lived_to">b) Do you wish to be granted custody of the
                                children/child?
                            </label>
                            <div class="form-row">
                                <div class="form-group col-md-1">
                                    <label class="radio-inline"> Yes
                                        <input type="radio" name="has_grant_custody" value="Yes">
                                    </label>
                                </div>
                                <div class="form-group col-md-1">
                                    <label class="radio-inline"> No
                                        <input type="radio" name="has_grant_custody" value="No">
                                    </label>
                                </div>
                            </div>
                            <div id="grant_custody_reasons_id">
                                <label>Why (provide reasons)</label>
                                <div class="form-group">
                                <textarea class="form-control text-left" aria-label="With textarea"
                                          id="grant_custody_reasons" name="grant_custody_reasons"
                                          rows="5" cols="50" ></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="marital_children">c) Do you have children who are not marital children
                                (a child can be a marital child biological or by adoption. Adoption can be customary or
                                in terms of the Adoption Act)
                            </label>
                            <div class="form-group">
                                <textarea class="form-control text-left" aria-label="With textarea"
                                          name="marital_children" rows="5" cols="50" ></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="major_children">d) Are there any children who are majors (over 21) but still depends
                                (a dependent child is a child still in school or a child with disability)
                            </label>
                            <div class="form-group">
                                <textarea class="form-control text-left" aria-label="With textarea"
                                          name="major_children" rows="5" cols="50" ></textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card shadow mb-4">
                <!-- Card Header - Accordion -->
                <a href="#clientsPersonalInformation7" class="d-block card-header py-3" data-toggle="collapse"
                   role="button" aria-expanded="true" aria-controls="clientsPersonalInformation7">
                    <h6 class="m-0 font-weight-bold text-primary">7. Have you sued for divorce and /or maintenance and /or restraining order before? (State the casenumber/Parties/Court</h6>
                </a>
                <!-- Card Content - Collapse -->
                <div class="collapse hide" id="clientsPersonalInformation7">
                    <div class="card-body">
                        <div class="container">
                            <div class="form-row">
                                <div class="form-group col-md-1">
                                    <label class="radio-inline"> Yes
                                        <input type="radio" name="has_sued_divorce" value="Yes" ></label>
                                </div>
                                <div class="form-group col-md-1">
                                    <label class="radio-inline"> No
                                        <input type="radio" name="has_sued_divorce" value="No"> </label>
                                </div>
                            </div>

                            <div id="sued_dates" class="hidden">
                                <div class="form-group">
                                    @inject('client','App\Repository\LitigationRepositoryInterface')
                                    <select class="form-control form-control-md"  id="case_number" name="case_number">
                                        <option value="" disabled selected>Select case number</option>
                                        @foreach($client->clientLitigations($file->client->id) as $litigation)
                                        <option>{{ $litigation->number }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group" >
                                    <label for="date_sued_divorce">Give the dates and the result of the suit/case-
                                        Provide copies of court documents
                                    </label>
                                    <input type="date" class="form-control" name="date_sued_divorce">
                                </div>
                                <div class="form-group">
                                    <label for="lived_to">Attach Copies of court documents</label>
                                    <div class="file-upload-wrapper">
                                        <input type="file" id="attach_court_copies"
                                               multiple name="attach_court_copies[]" class="file-upload" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="card shadow mb-4">
                <!-- Card Header - Accordion -->
                <a href="#clientsPersonalInformation8" class="d-block card-header py-3" data-toggle="collapse"
                   role="button" aria-expanded="true" aria-controls="clientsPersonalInformation8">
                    <h6 class="m-0 font-weight-bold text-primary">8. Have you reached a written agreement or settlement with your spouse?</h6>
                </a>
                <!-- Card Content - Collapse -->
                <div class="collapse hide" id="clientsPersonalInformation8">
                    <div class="card-body">
                        <div class="container">
                            <div class="form-row">
                                <div class="form-group col-md-1">
                                    <label class="radio-inline"> Yes
                                        <input type="radio" name="has_written_agreement" value="Yes" ></label>
                                </div>
                                <div class="form-group col-md-1">
                                    <label class="radio-inline"> No
                                        <input type="radio" name="has_written_agreement" value="No"> </label>
                                </div>
                            </div>
                            <div class="form-group hidden" id="attach_agreement_id">
                                <label for="attach_agreement_copies">Attach Copies of Agreement</label>
                                <div class="file-upload-wrapper">
                                    <input type="file" id="attach_agreement_copies" multiple
                                           name="written_agreement_copies[]" class="file-upload" />
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="card shadow mb-4">
                <!-- Card Header - Accordion -->
                <a href="#clientsPersonalInformation9" class="d-block card-header py-3" data-toggle="collapse"
                   role="button" aria-expanded="true" aria-controls="clientsPersonalInformation9">
                    <h6 class="m-0 font-weight-bold text-primary">9. Why do you say your marriage has broken down? (Provide reasons) </h6>
                </a>
                <!-- Card Content - Collapse -->
                <div class="collapse hide" id="clientsPersonalInformation9">
                    <div class="card-body">
                        <div class="container">
                            <div class="form-group">
                                <textarea class="form-control text-left" aria-label="With textarea"
                                          name="divorce_reasons" rows="10" cols="50"  required></textarea>
                            </div>

                            <div class="form-group">
                                <label>a)What has spouse done that you feel you cannot tolerate any more?</label>
                                <textarea class="form-control text-left" aria-label="With textarea"
                                          name="divorce_cause" rows="10" cols="50"  required></textarea>
                            </div>
                            <div class="form-group">
                                <label>b) Have you sort help from family and/or friends and / or counsellors?</label>
                                <div class="form-row">
                                    <div class="form-group col-md-1">
                                        <label class="radio-inline"> Yes
                                            <input type="radio" name="has_sort_help" value="Yes" ></label>
                                    </div>
                                    <div class="form-group col-md-1">
                                        <label class="radio-inline"> No
                                            <input type="radio" name="has_sort_help" value="No"> </label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>c)Are you still living with your spouse</label>
                                <div class="form-row">
                                    <div class="form-group col-md-1">
                                        <label class="radio-inline"> Yes
                                            <input type="radio" name="still_living_with_spouse" value="Yes" ></label>
                                    </div>
                                    <div class="form-group col-md-1">
                                        <label class="radio-inline"> No
                                            <input type="radio" name="still_living_with_spouse" value="No"> </label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group hidden" id="stop_living_with_spouse">
                                <label for="lived_to">d)When did you stop living together?</label>
                                <input type="date" class="form-control" name="date_stopped_living_together"
                                       id="date_stopped_living_together">
                            </div>
                            <div class="form-group">
                                <label for="lived_to">e)Who is currently staying at the matrimonial house?</label>
                                <input type="text" class="form-control" name="matrimonial_house_keeper">
                            </div>

                            <div class="form-group">
                                <label>f)If you are the only one left why did you leave?</label>
                                <textarea class="form-control text-left" aria-label="With textarea"
                                          name="reason_leaving" rows="10" cols="50"  required></textarea>
                            </div>
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
                                <caption style="caption-side:top; font-weight: bold;">Immovable Property</caption>
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
                                        <select class="form-control form-control-md"  name="immovable_property_type[]" required>
                                            <option>House</option>
                                            <option>Commercial</option>
                                        </select>
                                    </td>
                                    <td>
                                        <select class="form-control form-control-md"  name="immovable_property_status[]" required>
                                            <option>Developed</option>
                                            <option>Un/Developed</option>
                                        </select>
                                    </td>
                                    <td>
                                        <input type="text" class="form-control" placeholder="(Approx)" name="immovable_property_value[]"/>
                                    </td>
                                    <td>
                                        <input type="text" class="form-control" name="immovable_property_title_holder[]"/>
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
                                <caption style="caption-side:top;font-weight: bold;">Movable Property</caption>
                                <thead>
                                <tr>
                                    <th>Type</th>
                                    <th>Where is it?</th>
                                    <th>Value</th>
                                    <th>In whose possession?</th>
                                    <th>Fully Paid for?</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>
                                        <input type="text" class="form-control"  name="property_type[]"/>
                                    </td>
                                    <td>
                                        <input type="text" class="form-control"  name="property_location[]"/>
                                    </td>
                                    <td>
                                        <input type="text" class="form-control"  name="property_value[]" />
                                    </td>
                                    <td>
                                        <input type="text" class="form-control" name="property_possession[]"/>
                                    </td>
                                    <td>
                                        <input type="text" class="form-control" name="property_paid[]"/>
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
                                          name="liabilities" rows="10" cols="50"  required></textarea>
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
                                          name="property_division" rows="10" cols="50"  required></textarea>
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
    <script src="{{ asset('js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('js/responsive.bootstrap4.min.js') }}"></script>
    <script type="application/javascript">
        let i = 1;
        let j= 1;
        let k = 1;

        function  addMovablePropertyField() {
            j++;
            $('#movable_property').append(
                ' <tr id="row'+j+'">' +
                ' <td>' +
                '<input type="text" class="form-control"  name="plot_number[]"/>' +
                '</td>' +
                '<td>' +
                '<select class="form-control form-control-md"  name="immovable_property_type[]" required>' +
                '<option>House</option>' +
                '<option>Commercial</option>' +
                '</select>' +
                '</td>' +
                '<td>' +
                '<select class="form-control form-control-md"  name="immovable_property_status[]" required>' +
                '<option>Developed</option>' +
                '<option>Undeveloped</option>' +
                '</select>' +
                '</td>' +
                '<td>' +
                '<input type="text" class="form-control" placeholder="(Approx)" name="immovable_property_value[]"/>' +
                '</td>' +
                '<td>' +
                '<input type="text" class="form-control" name="immovable_property_title_holder[]"/>' +
                '</td>' +
                '<td>' +
                '<button type="button" id="'+j+'" class="btn btn_remove btn-sm btn-outline-danger">' +
                'Remove' +
                '</button>' +
                '</td>' +
                '</tr>');
        }
        function  addImmovablePropertyField() {
            k++;
            $('#immovable_property').append(
            ' <tr id="row'+k+'" >' +
            ' <td>' +
            '<input type="text" class="form-control"  name="property_type[]"/>' +
            '</td>' +
            '<td>' +
            '<input type="text" class="form-control"  name="property_location[]"/>'+
            '</td>' +
            '<td>' +
            '<input type="text" class="form-control" placeholder="(Approx)" name="property_value[]" />' +
            '</td>' +
            '<td>' +
            '<input type="text" class="form-control"  name="property_possession[]"/>' +
            '</td>' +
            '<td>' +
            '<input type="text" class="form-control" name="property_paid[]"/>' +
            '</td>' +
            '<td>' +
            '<button type="button" id="'+k+'" class="btn btn_remove btn-sm btn-outline-danger">' +
            'Remove' +
            '</button>' +
            '</td>' +
            '</tr>');
        }
        function addField(){
            i++;
            $('#children').append('<tr id="row'+i+'">' +
                '<td><input type="text" class="form-control" name="child_name[]"/></td>' +
                '<td><input type="date" class="form-control" name="child_dob[]"/></td>' +
                '<td><input type="text" class="form-control"  name="child_school[]" /></td>' +
                '<td><input type="text" class="form-control" name="child_standard[]"/></td>' +
                '<td>' +
                '<button type="button" id="'+i+'" class="btn_remove btn btn-sm btn-outline-danger">Remove</button>' +
                '</td>' +
                '</tr>');
        }
        function addChild2(){
            i++;
            $('#children_two').append('<tr id="row'+i+'">' +
                '<td><input type="text" class="form-control" name="child2_name[]"/></td>' +
                '<td><input type="text" class="form-control" name="residence[]"/></td>' +
                '<td>' +
                '<select class="form-control form-control-md"  name="marital_child[]" required>' +
                '<option>None</option>' +
                '<option>Biological</option>' +
                '<option>Adopted</option>' +
                '</select>' +
                '</td>' +
                '<td>' +
                '<select class="form-control form-control-md"  name="non_marital_child[]" required>' +
                '<option>None</option>' +
                '<option>Husbands</option>' +
                '<option>Wife\'s</option>' +
                '</select>' +
                '</td>'+
                '<td>' +
                '<button type="button" id="'+i+'" class="btn_remove btn btn-sm btn-outline-danger">Remove</button>' +
                '</td>' +
                '</tr>');
        }

        $('#children').on('click', '.btn_remove', function (e) {
            var button_id = $(this).attr("id");
            $('#row'+button_id+'').remove();
        });
        $('#children_two').on('click', '.btn_remove', function (e) {
            var button_id = $(this).attr("id");
            $('#row'+button_id+'').remove();
        });
        $('#movable_property').on('click', '.btn_remove', function (e) {
            var button_id = $(this).attr("id");
            $('#row'+button_id+'').remove();
            console.log(button_id.toString());
        });
        $('#immovable_property').on('click', '.btn_remove', function (e) {
            var button_id = $(this).attr("id");
            $('#row'+button_id+'').remove();
        });

        //checkbox fields on change
        $('#omang_name_id').change(function() {
            if(this.checked) {
                $('#omang_name').val('{{ $file->client->clientable->name }}');
                console.log('name is checked {{  $file->client->clientable->name }}');
            }else{
                $('#omang_name').val('');
            }
        });
        $('#maiden_name_id').change(function() {
            if(this.checked) {
                $('#maiden_name').val('{{ $file->client->clientable->name }}');
            }else{
                $('#maiden_name').val('');
            }
        });
        $('#certificate_name_id').change(function() {
            if(this.checked) {
                $('#marriage_certificate_name').val('{{ $file->client->clientable->name }}');
            }else{
                $('#marriage_certificate_name').val('');
            }
        });

        $('input[type=radio][name=is_resident]').change(function() {
            if (this.value == 'Yes') {
                $('#is_resident_id').removeClass('hidden');
                $('#resident_since').prop('required',true);
            }
            else  {
                $('#is_resident_id').addClass('hidden');
                $('#resident_since').prop('required',false);
            }
        });
        $('input[type=radio][name=is_spouse_resident]').change(function() {
            if (this.value == 'Yes') {
                $('#is_spouse_resident_id').removeClass('hidden');
                $('#is_spouse_resident').prop('required',true);
            }
            else  {
                $('#is_spouse_resident_id').addClass('hidden');
                $('#is_spouse_resident').prop('required',false);
            }
        });
        $('input[type=radio][name=has_lived_together]').change(function() {

            if (this.value == 'Yes') {
                $('#has_lived_together_since').removeClass('hidden');
                $('#has_lived_together_from').prop('required',true);
                $('#has_lived_together_to').prop('required',true);
            }
            else  {
                $('#has_lived_together_since').addClass('hidden');
                $('#has_lived_together_to').prop('required',false);
                $('#has_lived_together_from').prop('required',false);
            }
        });
        $('input[type=radio][name=has_lived_part]').change(function() {
            if (this.value == 'Yes') {
                $('#has_lived_apart_since').removeClass('hidden');
                $('#has_lived_apart_from').prop('required',true);
                $('#has_lived_apart_to').prop('required',true);
            }
            else  {
                $('#has_lived_apart_since').addClass('hidden');
                $('#has_lived_apart_to').prop('required',false);
                $('#has_lived_apart_from').prop('required',false);
            }
        });
        $('input[type=radio][name=has_sued_divorce]').change(function() {
            if (this.value == 'Yes') {
                $('#sued_dates').removeClass('hidden');
                $('#date_sued_divorce').prop('required',true);
                $('#has_lived_apart_to').prop('required',true);
            }
            else  {
                $('#sued_dates').addClass('hidden');
                $('#date_sued_divorce').prop('required',false);
                $('#has_lived_apart_from').prop('required',false);
            }
        });
        $('input[type=radio][name=has_written_agreement]').change(function() {
            if (this.value == 'Yes') {
                $('#attach_agreement_id').removeClass('hidden');
                $('#attach_agreement_copies').prop('required',true);
            }
            else  {
                $('#attach_agreement_id').addClass('hidden');
                $('#attach_agreement_copies').prop('required',false)
            }
        });
        $('input[type=radio][name=still_living_with_spouse]').change(function() {
            if (this.value == 'Yes') {
                $('#stop_living_with_spouse').addClass('hidden');
                $('#date_stopped_living_together').prop('required',false)
            }
            else  {
                $('#stop_living_with_spouse').removeClass('hidden');
                $('#date_stopped_living_together').prop('required',true)
            }
        });
        $('input[type=radio][name=has_grant_custody]').change(function() {
            if (this.value == 'Yes') {
                $('#grant_custody_reasons_id').removeClass('hidden');
                $('#grant_custody_reasons').prop('required',false)
            }
            else  {
                $('#grant_custody_reasons_id').addClass('hidden');
                $('#grant_custody_reasons').prop('required',true)
            }
        });


        $(document).ready(function() {
            $('#movable_property').DataTable( {
                'searching':false,
                "paging":   false,
                "info":     false,
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
                "paging":   false,
                "info":     false,
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
            $('#children').DataTable( {
                'searching':false,
                "paging":   false,
                "info":     false,
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
            $('#children_two').DataTable( {
                'searching':false,
                "paging":   false,
                "info":     false,
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
        } );
    </script>
@endsection
