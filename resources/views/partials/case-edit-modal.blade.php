<div class="modal fade" id="editClientCaseModal" tabindex="-1" role="dialog"
     aria-labelledby="openClientCaseModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="openClientCaseModalLabel">Court Case Information</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="alert alert-primary" role="alert">
                    In the High Court of the Republic of Botswana
                </div>
                <form method="POST" action="{{ route('admin.cases.update', ['case' => $case->id]) }}"
                      enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group ">
                        <label for="inputCaseNumber">Case Number</label>
                        <input type="text" class="form-control" disabled
                               value="{{ $case->number }}">
                    </div>
                    <div class="form-group ">
                        <label for="inputPlaintiffName">Plaintiff Name</label>
                        <input type="text" class="form-control" id="plaintiff" name="plaintiff"
                               value="{{ $case->plaintiff }}">
                    </div>
                    <div class="form-group">
                        <label for="inputDefendantName">Defendant Name</label>
                        <input type="text" class="form-control" id="defendant" name="defendant"
                               value="{{ $case->defendant }}">
                    </div>
                    <div class="form-group">
                        <label for="inputDetails">Case Details</label>
                        <textarea class="form-control" aria-label="With textarea" name="details"
                                  rows="5" cols="20" style="text-align: justify; align-content: flex-start">
                            {{ $case->details }}
                                </textarea>
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
