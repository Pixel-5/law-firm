<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Matrimony extends Model
{
    protected $table = 'matrimony';

    protected $fillable = [
        'litigation_id',
        'omang_name',
        'marriage_name',
        'maiden_name',

        'is_citizen',
        'is_resident',
        'resident_since',

        'date_marriage',
        'place_of_marriage',
        'regime',
        'marriage_certificate_copy',

        'has_lived_together',
        'lived_together_to',
        'lived_together_from',

        'has_lived_part',
        'lived_apart_from',
        'lived_apart_to',

        'has_sued_divorce',
        'date_sued_divorce',
        'case_number',
        'attach_court_copies',

        'has_written_agreement',
        'written_agreement_copies',

        'divorce_reasons',
        'divorce_cause',

        'has_sort_help',

        'still_living_with_spouse',
        'date_stopped_living_together',
        'matrimonial_house_keeper',
        'reason_leaving',

        'liabilities',
        'property_division',

        'has_grant_custody',
        'grant_custody_reasons',
        'marital_children',
        'major_children',
    ];

    public function children()
    {
        return $this->hasMany(ClientChildren::class);
    }

    public function property()
    {
        return $this->hasMany(ClientProperty::class);
    }

    public function financialNeeds()
    {
        return $this->hasOne(FinancialNeeds::class);
    }
}
