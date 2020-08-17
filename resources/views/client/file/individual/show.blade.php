@extends('layouts.default')
@section('content')
    <form action="{{ route('admin.files.update',[$file->id]) }}"
          enctype="multipart/form-data" method="POST">
        @csrf
        @honeypot

        @method('PUT')
        <div class="modal-header">
            <h5 class="modal-title" id="clientModalLabel">
                Edit Client File
                Information</h5>
            <button type="button" class="close" data-dismiss="modal"
                    aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <x-individualForm
                :surname="{{ $file->surname }}"
                :name="{{ $file->name }}"
                :dob="{{ $file->dob }}"
                :gender="{{ $file->gender }}"
                :email="{{ $file->email }}"
                :occupation="{{ $file->occupation }}"
                :tel="{{ $file->tel }}"
                :cell="{{ $file->cell }}"
                :fax="{{ $file->fax }}"
                :marital_status="{{ $file->marital_status }}"
                :physical_address="{{ $file->physical_address }}"
                :postal_address="{{ $file->postal_address }}"
                :preferred_invoice="{{ $file->preferred_invoice }}"
                :contact_next_kin="{{ $file->contact_next_kin }}"
                :name_next_kin="{{ $file->name_next_kin }}"
                :name_spouse="{{ $file->name_spouse }}"
                :preferred_email="{{ $file->preferred_email }}"
                :is_citizen="{{ $file->is_citizen }}"
                :identifier="{{ $file->identifier }}"
            />
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Save file</button>
        </div>
    </form>
@stop
