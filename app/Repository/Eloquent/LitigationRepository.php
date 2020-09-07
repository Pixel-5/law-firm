<?php


namespace App\Repository\Eloquent;


use App\ClientChildren;
use App\ClientProperty;
use App\ClientSpouse;
use App\FileNoteForm;
use App\FinancialNeeds;
use App\ImmovableProperty;
use App\InitialConsultationForm;
use App\Litigation;
use App\Matrimony;
use App\MovableProperty;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class LitigationRepository extends AbstractBaseRepository
{

    public function __construct(Litigation $model)
    {
        parent::__construct($model);
    }

    /**
     * @param int $id
     * @param array $attributes
     * @return bool|Model
     */
    public function update(int $id, array $attributes): bool
    {
        return $this->find($id)->update($attributes);
    }

    public function createLitigation(Request $request)
    {
        return $this->create([
            'number'    => Str::caseNumber(),
            'client_id' =>$request->client_id,
            'category'  =>$request->category,
        ]);
    }

    public function allLitigation()
    {
        $litigation = $this->model->all();
        $litigation = $litigation->load(['client','schedule','user']);
        return $litigation;
    }

    public function deleteLitigation(int $id)
    {
        return $this->delete($id);
    }

    public function assignedLitigation()
    {
        return $this->model->whereHas('user')->with(['client', 'user'])->cursor();
    }

    public function getMyLitigation()
    {
        $myLitigation = $this->model->where('user_id', Auth::user()->id)->get();
        $myLitigation = $myLitigation->load(['client','schedule']);
        return $myLitigation;
    }

    public function clientLitigations($id)
    {
        $myLitigation = $this->model->where('client_id',$id)->get();
        $myLitigation = $myLitigation->load([
            'client',
            'client.clientable',
            'client.spouse',
            'schedule',
            'notes',
            'consultation',
            'user']);
        return $myLitigation;
    }

    public function getLitigation($id)
    {
        $myLitigation = $this->find($id);
        $myLitigation = $myLitigation->load([
            'client',
            'client.clientable',
            'client.spouse',
            'schedule',
            'notes',
            'consultation',
            'user']);
        return $myLitigation;
    }

    public function storeFormNote(Request $request)
    {
        return FileNoteForm::create($request->all());
    }

    public function storeInitialConsultation(Request $request)
    {
        return InitialConsultationForm::create($request->all());
    }

    public function storeFileNote(Request $request)
    {
        return FileNoteForm::create($request->all());
    }

    public function updateLitigation($id,$request)
    {
        return $this->update($id, $request);
    }

    public function updateInitialConsultation($id,$request)
    {
        $consultation = InitialConsultationForm::find($id);
        return $consultation->update($request);
    }

    public function updateFileNote($id,$request)
    {
        $note = FileNoteForm::find($id);
        return $note->update($request);
    }

    public function deleteFileNote($id)
    {
        $note = FileNoteForm::find($id);
        return $note->delete();
    }

    public function createMatrimony(Request  $request)
    {
        //dd($request->immovable_property_type);

        $doc = $request->file('marriage_certificate_copy');
        $marriage_certificate_copy = $doc->getClientOriginalName();
        Storage::putFile('client/files/matrimony/'.$marriage_certificate_copy, $doc);

        $written_agreement_copies = $request->file('written_agreement_copies');
        $written_agreement_docs = array();
        if (!empty($written_agreement_copies)){
            foreach ($written_agreement_copies as $doc){
                $file_name = $doc->getClientOriginalName();
                Storage::putFile('client/files/matrimony/'.$file_name, $doc);
                $written_agreement_docs[] = $file_name;
            }
        }
        $attach_court_copies = array();
        $attach_court_docs = $request->file('attach_court_copies');
        if (!empty($attach_court_docs)){
            foreach ($attach_court_docs as $doc){
                $file_name = $doc->getClientOriginalName();
                Storage::putFile('client/files/matrimony/'.$file_name, $doc);
                $attach_court_copies[] = $file_name;
            }
        }
        $matrimony = Matrimony::create([
            'litigation_id'                 =>$request->litigation_id,
            'omang_name'                    =>$request->omang_name,
            'marriage_name'                 =>$request->marriage_certificate_name,
            'maiden_name'                   =>$request->maiden_name,

            'is_citizen'                    =>$request->is_citizen == 'Yes',
            'is_resident'                   =>$request->is_resident == 'Yes',
            'resident_since'                 =>$request->resident_since,

            'date_marriage'                 =>$request->date_marriage,
            'place_of_marriage'             =>$request->place_of_marriage,
            'marriage_certificate_copy'     =>$marriage_certificate_copy,
            'regime'                        =>$request->regime,

            'has_lived_together'            =>$request->has_lived_together == 'Yes',
            'lived_together_to'             =>$request->lived_together_to,
            'lived_together_from'           =>$request->lived_together_from,

            'has_lived_part'                =>$request->has_lived_part == 'Yes',
            'lived_apart_from'              =>$request->lived_apart_from,
            'lived_apart_to'                =>$request->lived_apart_to,

            'has_grant_custody'             =>$request->has_grant_custody == 'Yes',
            'grant_custody_reasons'         =>$request->grant_custody_reasons,
            'marital_children'              =>$request->marital_children,
            'major_children'                =>$request->major_children,
            'has_sued_divorce'              =>$request->has_sued_divorce == 'Yes',
            'date_sued_divorce'             =>$request->date_sued_divorce,
            'case_number'                   =>$request->case_number,

            'has_written_agreement'         =>$request->has_written_agreement == 'Yes',
            'written_agreement_copies'      =>is_null($written_agreement_docs) ? "" : implode(",",$written_agreement_docs),


            'divorce_reasons'               =>$request->divorce_reasons,
            'divorce_cause'                 =>$request->divorce_cause,
            'attach_court_copies'           =>is_null($attach_court_copies) ? "" : implode(",",$attach_court_copies),

            'has_sort_help'                 =>$request->has_sort_help == 'Yes',

            'still_living_with_spouse'      =>$request->still_living_with_spouse == 'Yes',
            'date_stopped_living_together'  =>$request->date_stopped_living_together,
            'matrimonial_house_keeper'      =>$request->matrimonial_house_keeper,
            'reason_leaving'                =>$request->reason_leaving,

            'liabilities'                   =>$request->liabilities,
            'property_division'             =>$request->property_division,
        ]);

        $immovable_property_types = $request->immovable_property_type;
        $immovable_property_status = $request->immovable_property_status;
        $immovable_property_value = $request->immovable_property_value;
        $immovable_property_title_holder = $request->immovable_property_title_holder;
        $plot_number = $request->plot_number;
        $immovable_properties = [];
        if ($immovable_property_types != null){
            for($i = 0; $i <count($immovable_property_types); $i++){
                $immovable_property = ImmovableProperty::create([
                    'plot_number'       => $plot_number[$i],
                    'type'              =>$immovable_property_types[$i],
                    'development'       =>$immovable_property_status[$i],
                    'value'             =>$immovable_property_value[$i],
                    'fully_paid_for'    =>$immovable_property_title_holder[$i],
                ]);
                $immovable_properties[] = $immovable_property->id;
            }
        }

        $property_type = $request->property_type;
        $property_location = $request->property_location;
        $property_value = $request->property_value;
        $property_possession = $request->property_possession;
        $property_paid = $request->property_paid;
        $movable_properties = [];
        for($i = 0; $i < count($property_type); $i++){
            $movable_property = MovableProperty::create([
                'type'              =>$property_type[$i],
                'location'          =>$property_location[$i],
                'possession'        =>$property_possession[$i],
                'value'             =>$property_value[$i],
                'fully_paid_for'    =>$property_paid[$i]
            ]);
            $movable_properties[] = $movable_property->id;
        }

        foreach ($immovable_properties as $movable_property){
            ClientProperty::create([
                'matrimony_id' =>$matrimony->id,
                'propertiable_id' => $movable_property,
                'propertiable_type' => 'App\MovableProperty',
            ]);
        }

        foreach ($movable_properties as $immovable_property){
            ClientProperty::create([
                'matrimony_id' =>$matrimony->id,
                'propertiable_id' => $immovable_property,
                'propertiable_type' => 'App\ImmovableProperty',
            ]);
        }


        $marriage_certificate_docs= $request->file('marriage_certificate_copy');
        $file_name = $marriage_certificate_docs->getClientOriginalName();
        Storage::putFile('client/files/matrimony/'.$file_name, $marriage_certificate_docs);

        ClientSpouse::create([
            'client_id' =>$request->client_id,
            'name'      =>$request->spouse_name,
            'physical_address'  =>$request->spouse_physical_address,
            'postal_address'    =>$request->spouse_postal_address,
            'marriage_date'     =>$request->date_marriage,
            'marriage_place'    =>$request->place_of_marriage,
            'nationality'       =>$request->nationality_residence,
            'occupation'        =>$request->spouse_occupation,
            'is_resident'       =>$request->is_spouse_resident === 'Yes',
            'resident_since'    =>$request->spouse_resident_since,
            'marriage_certificate_copy' =>$file_name,
        ]);


        $child_name = $request->child_name;
        $child_dob = $request->child_dob;
        $child_school = $request->child_school;
        $child_standard = $request->child_standard;
        $child2_name = $request->child2_name;
        $residence = $request->residence;
        $marital_child = $request->marital_child;
        $non_marital_child = $request->non_marital_child;

        for($i = 0; $i < count($child_name); $i++){
            ClientChildren::create([
                'matrimony_id'      =>$matrimony->id,
                'name'              =>$child_name[$i],
                'dob'               =>$child_dob[$i],
                'school'            =>$child_school[$i],
                'standard'          =>$child_standard[$i],
                'residence_place'   =>$residence[$i],
                'marital'           =>$marital_child[$i],
                'non_marital'       =>$non_marital_child[$i],
            ]);
        }
        FinancialNeeds::create([
            'matrimony_id' =>$matrimony->id,
            'school_expenses' =>$request->school_expenses,
            'transportation'    =>$request->transportation,
            'clothes'           =>$request->clothes,
            'groceries'         =>$request->groceries,
            'house_keeper'      =>$request->house_keeper,
            'shelter'           =>$request->shelter
        ]);

        return $matrimony;
    }
}
