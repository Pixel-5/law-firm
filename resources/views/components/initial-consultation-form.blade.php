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
                <form method="POST" action="{{ $file != null ?
                    route('lawyer.initial-consultation-form.update',['initial-consultation-form',$file->id]):
                    route( 'lawyer.initial-consultation-form.store') }}"
                      enctype="multipart/form-data">
                    @honeypot
                    @csrf
                    <div class="form-group ">
                        <label for="inputCaseNumber">File No</label>
                        <input type="text" class="form-control" disabled
                               value="{{ $file != null ? $file->number : \Illuminate\Support\Str::caseNumber() }}">
                        <input type="hidden" name="number" class="form-control"
                               id="number"  value="{{ $file != null ? $file->number : \Illuminate\Support\Str::caseNumber() }}">
                        <input type="hidden" name="file_id" class="form-control"
                               id="file_id"  value="{{ $file->id }}">
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
                        <label for="inputDefendantName">Matter</label>
                        <input type="text" class="form-control" id="defendant" name="defendant"
                               required>
                    </div>
                    <div class="row">
                        <div class="col col-6">
                            <div class="form-group">
                                <label for="inputDefendantName">Date</label>
                                <input type="date" class="form-control" id="attorney" name="date">
                            </div>
                        </div>
                        <div class="col col-6">
                            <div class="form-group">
                                <label for="inputDefendantName">Time from</label>
                                <input type="time" class="form-control" id="attorney" name="time_from">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col col-6">
                            <div class="form-group">
                                <label for="inputDefendantName">Venue</label>
                                <input type="text" class="form-control" id="venue" name="venue">
                            </div>
                        </div>
                        <div class="col col-6">
                            <div class="form-group">
                                <label for="inputDefendantName">Time To</label>
                                <input type="time" class="form-control" id="time_to" name="time_to">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputDetails">Description of case/matter</label>
                        <textarea class="form-control text-left" aria-label="With textarea" name="details"
                                  rows="10" cols="50"  required></textarea>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save case</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
