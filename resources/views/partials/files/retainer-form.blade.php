<div class="modal-header">
    <h5 class="modal-title" id="clientModalLabel">
        <b>Client's Information - Retainer</b>
    </h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<div class="container-fluid mt-3">
    <div class="form-row">
        <div class="input-group">
            <div class="input-group-prepend">
                <label class="input-group-text" for="inputGroupSelect01">Retainer Options</label>
            </div>
            <select class="custom-select" id="retainerType" name="type">
                <option selected>Choose Retainer...</option>
                <option value="individual">Individual</option>
                <option value="company">Company</option>
                <option value="both">Both</option>
            </select>
        </div>
    </div>
    <br>
</div>

<form action="{{ route('admin.retainer.store') }}" enctype="multipart/form-data" method="POST" id="individual">
    @csrf
    @honeypot
    <br>
    <input type="hidden" name="type" class="type">
    <div id="retainerIndividualForm" class="card shadow mb-4">
        <a href="#collapseCardIndividual" class="d-block card-header py-3"
           data-toggle="collapse" role="button" aria-expanded="true"
           aria-controls="collapseCardIndividual">
            <h6 class="m-0 font-weight-bold text-primary">Individual Information</h6>
        </a>
        <div class="collapse hide" id="collapseCardIndividual">
            <div class="card-body">
                <input type="hidden" name="type" value="individual">
                @include('partials.files.individual-form')
            </div>
        </div>
    </div>
    <div id="submit_div">
        @include('partials.agreement-service')
        @include('partials.modal-footer-submit-btn')
    </div>
</form>

<form action="{{ route('admin.retainer.store') }}" enctype="multipart/form-data" method="POST" id="company">
    @csrf
    @honeypot
    <br>
    <input type="hidden" name="type" value="company">
    <div id="retainerCompanyForm" class="card shadow mb-4">
        <a href="#collapseCardCompany" class="d-block card-header py-3"
           data-toggle="collapse" role="button" aria-expanded="true"
           aria-controls="collapseCardCompany">
            <h6 class="m-0 font-weight-bold text-primary">Company Information</h6>
        </a>
        <div class="collapse hide" id="collapseCardCompany">
            <div class="card-body">
                @include('partials.files.company-form')
            </div>
        </div>
    </div>
    <div id="submit_div">
        @include('partials.agreement-service')
        @include('partials.modal-footer-submit-btn')
    </div>
</form>

<form action="{{ route('admin.retainer.store') }}" enctype="multipart/form-data" method="POST" id="both">
    @csrf
    @honeypot
    <br>
    <input type="hidden" name="type" value="both">
    <div id="retainerIndividualForm" class="card shadow mb-4">
        <a href="#collapseCardIndividual" class="d-block card-header py-3"
           data-toggle="collapse" role="button" aria-expanded="true"
           aria-controls="collapseCardIndividual">
            <h6 class="m-0 font-weight-bold text-primary">Individual Information</h6>
        </a>
        <div class="collapse hide" id="collapseCardIndividual">
            <div class="card-body">
                @include('partials.files.individual-form')
            </div>
        </div>
    </div>
    <div id="retainerCompanyForm" class="card shadow mb-4">
        <a href="#collapseCardCompany" class="d-block card-header py-3"
           data-toggle="collapse" role="button" aria-expanded="true"
           aria-controls="collapseCardCompany">
            <h6 class="m-0 font-weight-bold text-primary">Company Information</h6>
        </a>
        <div class="collapse hide" id="collapseCardCompany">
            <div class="card-body">
                @include('partials.files.company-form')
            </div>
        </div>
    </div>
    <div id="submit_div">
        @include('partials.agreement-service')
        @include('partials.modal-footer-submit-btn')
    </div>
</form>
