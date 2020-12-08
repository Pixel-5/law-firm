<?php


namespace App\Repository\Eloquent;


use App\Company;
use App\Conveyancing;
use App\Individual;
use App\Plot;
use App\PlotTransaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ConveyancingRepository extends AbstractBaseRepository
{

    /**
     * CaseRepository constructor.
     * @param Conveyancing $model
     */
    public function __construct(Conveyancing $model)
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

    public function createConveyance(Request $request)
    {

        $other_type =  $request->other_type;
        $other = $request->other;
        $otherParty = null;
        switch ($other_type){
            case 'Individual':
                if ($other == 'Transferor'){
                    $otherParty = Individual::create([
                        'name'              =>$request->transferor_name,
                        'number'            => Str::fileNumber(),
                        'surname'           =>$request->transferor_surname,
                        'dob'               =>$request->transferor_dob,
                        'identifier'        =>$request->transferor_identifier,
                        'marital_status'    =>$request->transferor_marital_status,
                        'email'             =>$request->transferor_email,
                        'physical_address'  =>$request->transferor_physical_address,
                        'postal_address'    =>$request->transferor_postal_address,
                        'tel'               =>$request->transferor_tel,
                        'cell'               =>$request->transferor_cell . ' / '. $request->transferor_alt,
                        'spouse_name'       =>$request->transferor_spouse
                ]);
                }else{
                    $otherParty = Individual::create([
                        'number'            => Str::fileNumber(),
                        'name'              =>$request->transferee_name,
                        'surname'           =>$request->transferee_surname,
                        'dob'               =>$request->transferee_dob,
                        'identifier'        =>$request->transferee_identifier,
                        'marital_status'    =>$request->transferee_marital_status,
                        'email'             =>$request->transferee_email,
                        'physical_address'  =>$request->transferee_physical_address,
                        'postal_address'    =>$request->transferee_postal_address,
                        'tel'               =>$request->transferee_tel,
                        'cell'               =>$request->transferee_cell,
                        'spouse_name'       =>$request->transferee_spouse
                    ]);
                }
                break;
            case 'Company';
               if ($other == 'Transferor'){
                   $otherParty = Company::create([
                       'name'               => $request->transferor_name,
                       'number'             => $request->transferor_no,
                       'doi'                => $request->transferor_doi,
                       'shareholders'       => $request->transferor_shareholders,
                       'physical_address'   => $request->transferor_physical_address,
                       'postal_address'     => $request->transferor_postal_address,
                       'tel'                => $request->transferor_tel,
                       'cell'               => $request->transferor_cell . '/ '. $request->transferor_alt_contact,
                       'email'              => $request->transferor_email
                   ]);
               }else{
                   $otherParty = Company::create([
                       'name'               => $request->transferee_name,
                       'number'             => $request->transferee_no,
                       'doi'                => $request->transferee_doi,
                       'shareholders'       => $request->transferee_shareholders,
                       'physical_address'   => $request->transferee_physical_address,
                       'postal_address'     => $request->transferee_postal_address,
                       'tel'                => $request->transferee_tel,
                       'cell'               => $request->transferee_cell . ' / '. $request->transferee_alt_contact,
                       'email'              => $request->transferee_email
                   ]);
               }
                break;
        }
        $conveyancing =  $this->create([
            'number'            => Str::caseNumber(),
            'client_id'         => $request->client_id,
            'other_id'          => $otherParty->id,
            'other_type'        => $request->other_type,
        ]);

        $transaction = PlotTransaction::create([
            'transaction_type' => $request->transfer_type,
            'client_transaction_type' =>$request->client,
            'other_transaction_type' =>$request->other,
            'conveyancing_id' => $conveyancing->id
        ]);

         Plot::create([
            'plot_no' => $request->plot_no,
            'situated_at' => $request->situated_at,
            'title_deed' => $request->certificate,
            'property_bounded' => $request->property_bounded == 'Yes',
            'purchase_price' => $request->price,
            'initial_payment' => $request->initial_payment,
            'notes' => $request->notes,
            'plot_transaction_id'  => $transaction->id
        ]);

        return $conveyancing;
    }

    public function deleteConveyance(int $id)
    {
        return $this->delete($id);
    }

    public function getConveyancing($id)
    {
        $conveyancing =  $this->find($id);
        $conveyancing = $conveyancing->load(['transaction','client','schedule','user']);
        return $conveyancing;
    }

    public function getAssignedConveyancing()
    {
        return $this->model->whereHas('user')->with(['client', 'user'])->cursor();
    }

    public function getMyConveyancing()
    {
        $myConveyancing = $this->model->where('user_id', Auth::user()->id)->get();
        $myConveyancing = $myConveyancing->load(['client','schedule','transaction']);
        return $myConveyancing;
    }

    public function all()
    {
        $conveyancing = $this->model->all();
        $conveyancing = $conveyancing->load(['client','schedule','transaction']);
        return $conveyancing;
    }
}
