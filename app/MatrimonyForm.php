<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MatrimonyForm extends Model
{
    protected $fillable = [
        'litigation_id',
        'client_id',
        'spouse_id',
        'regime',
        'resident_when',
        'spouse_resident_when',
        'marriage_reside_from',
        'marriage_reside_to',
        'lived_together_to',
        'lived_together_from',
        'lived_apart_from',
        'lived_apart_to',
        'children_id',
        'grant_custody',
        'grant_custody_reasons',
        'marital_children',
        'major_children',
        'sued_divorce',
        'sued_divorce_date',
        'written_agreement',
        'copy_written_agreement',
        'divorce_reasons',
        'divorce_cause',
        'sort_help',
        'living_together',
        'date_stopped_living_together',
        'matrimonial_home',
        'reason_leaving',
        'property_id',
        'financial_id',
        'liabilities',
        'division_proposal',
    ];
}
