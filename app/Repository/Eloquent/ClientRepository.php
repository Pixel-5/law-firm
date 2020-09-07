<?php


namespace App\Repository\Eloquent;


use App\Client;
use App\Conveyancing;
use App\Litigation;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

class ClientRepository extends AbstractBaseRepository
{

    public function __construct(Client $model)
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
        // TODO: Implement update() method.
    }

    public function findById(int $id)
    {
        $client = $this->find($id);
        $client->load([
            'conveyancing',
            'conveyancing.transaction',
            'conveyancing.transaction.plot',
            'litigation',
        ]);
        return $client;
    }

    public function clients()
    {
        return $this->model->all();
    }

    public function deleteClient(int $id)
    {
        $client = $this->findById($id);
//        if ($client->conveyancing != null)
//        {
//            $conveyancing = Conveyancing::find($client->conveyancing->id);
//            $conveyancing->delete();
//        }
//        else if ($client->litigation != null)
//        {
//            $litigation = Litigation::delete($client->litigation->id);
//            $litigation->delete();
//        }
        return $this->delete($id);
    }

    public function unscheduledCases()
    {
        $myUnscheduledClients = array();
        $lawyer = Auth::user();
        $myLitigation = Litigation::where('user_id', $lawyer->id)->get();
        $myLitigation = $myLitigation->load(['schedule']);
        foreach ($myLitigation as $myCase) {
            if($myCase->schedule === null){
                $myUnscheduledClients[] = $myCase;
            }
        }
        $myConveyancing = Conveyancing::where('user_id', $lawyer->id)->get();
        $myConveyancing = $myConveyancing->load(['schedule']);
        foreach ($myConveyancing as $myConveyance) {
            if($myConveyance->schedule === null){
                $myUnscheduledClients[] = $myConveyance;
            }
        }
        return $myUnscheduledClients;
    }

    public function myClients()
    {
        return $this->model->whereHas('conveyancing', function (Builder $query) {
            $query->where('user_id',Auth::user()->id);
        })->whereHas('litigation',function (Builder $query){
            $query->where('user_id',Auth::user()->id);
        })->get();
    }

    public function myAssignedClients()
    {
        return $this->model->whereHas('conveyancing', function (Builder $query) {
            $query->where('user_id',Auth::user()->id);
        })->whereHas('litigation',function (Builder $query){
            $query->where('user_id',Auth::user()->id);
        })->with(['conveyancing','conveyancing.schedule','litigation','litigation.schedule',])->get();
    }

    public function unAssignedClients()
    {
        return $this->model->whereHas('conveyancing', function (Builder $query) {
            $query->doesntHave('user');
        })->whereHas('litigation',function (Builder $query){
            $query->doesntHave('user');
        })->with(['conveyancing','litigation',])->get();
    }
    public function getMyChartData()
    {

        $litigation_data = [];
        $conveyancing_data = [];
        $litigation = Litigation::where('user_id', auth()->user()->id)
            ->get()
            ->groupBy(function($date) {
                return Carbon::parse($date->created_at)->format('Y'); // grouping by years
            })->map(function($case){
                return $case->groupBy(function($date){
                    return Carbon::parse($date->created_at)->format('m'); // grouping by years
                });
            });
        $conveyancing = Conveyancing::where('user_id', auth()->user()->id)
            ->get()
            ->groupBy(function($date) {
                return Carbon::parse($date->created_at)->format('Y'); // grouping by years
            })->map(function($case){
                return $case->groupBy(function($date){
                    return Carbon::parse($date->created_at)->format('m'); // grouping by years
                });
            });
        foreach ($litigation as $year => $months) {
            $months_data = [
                [
                    'name' => 'Jan',
                    'value' => 0
                ],
                [
                    'name' => 'Feb',
                    'value' => 0
                ],
                [
                    'name' => 'Mar',
                    'value' => 0
                ],
                [
                    'name' => 'Apr',
                    'value' => 0
                ],
                [
                    'name' => 'May',
                    'value' => 0
                ],
                [
                    'name' => 'Jun',
                    'value' => 0
                ],
                [
                    'name' => 'Jul',
                    'value' => 0
                ],
                [
                    'name' => 'Aug',
                    'value' => 0
                ],
                [
                    'name' => 'Sep',
                    'value' => 0
                ],
                [
                    'name' => 'Oct',
                    'value' => 0
                ],
                [
                    'name' => 'Nov',
                    'value' => 0
                ],
                [
                    'name' => 'Dec',
                    'value' => 0
                ],
            ];
            $total = 0;
            foreach ($months as $key =>$value) {
                $key = Carbon::create()->startOfMonth()->month((int)$key)->startOfMonth()->shortMonthName;
                foreach ($months_data as &$data){
                    if ($data['name'] == $key)
                        $data['value'] = $value->count();
                }
                $total = $total + $value->count();
            }

            $litigation_data[(string)$year] = [
                'months'=> $months_data,
                'total_cases' => $total
            ];
        }

        foreach ($conveyancing as $year => $months) {
            $months_data = [
                [
                    'name' => 'Jan',
                    'value' => 0
                ],
                [
                    'name' => 'Feb',
                    'value' => 0
                ],
                [
                    'name' => 'Mar',
                    'value' => 0
                ],
                [
                    'name' => 'Apr',
                    'value' => 0
                ],
                [
                    'name' => 'May',
                    'value' => 0
                ],
                [
                    'name' => 'Jun',
                    'value' => 0
                ],
                [
                    'name' => 'Jul',
                    'value' => 0
                ],
                [
                    'name' => 'Aug',
                    'value' => 0
                ],
                [
                    'name' => 'Sep',
                    'value' => 0
                ],
                [
                    'name' => 'Oct',
                    'value' => 0
                ],
                [
                    'name' => 'Nov',
                    'value' => 0
                ],
                [
                    'name' => 'Dec',
                    'value' => 0
                ],
            ];
            $total = 0;
            foreach ($months as $key =>$value) {
                $key = Carbon::create()->startOfMonth()->month((int)$key)->startOfMonth()->shortMonthName;
                foreach ($months_data as &$data){
                    if ($data['name'] == $key)
                        $data['value'] = $value->count();
                }
                $total = $total + $value->count();
            }


            $conveyancing_data[(string)$year] = [
                'months'=> $months_data,
                'total_cases' => $total
            ];
        }
        return [
            'litigation' => $litigation_data,
            'conveyancing' => $conveyancing_data
        ];
    }

    public function getChartData()
    {

        $litigation_data = [];
        $conveyancing_data = [];
        $litigation = Litigation::
            all()
            ->groupBy(function($date) {
                return Carbon::parse($date->created_at)->format('Y'); // grouping by years
            })->map(function($case){
                return $case->groupBy(function($date){
                    return Carbon::parse($date->created_at)->format('m'); // grouping by years
                });
            });
        $conveyancing = Conveyancing::all()
            ->groupBy(function($date) {
                return Carbon::parse($date->created_at)->format('Y'); // grouping by years
            })->map(function($case){
                return $case->groupBy(function($date){
                    return Carbon::parse($date->created_at)->format('m'); // grouping by years
                });
            });
        foreach ($litigation as $year => $months) {
            $months_data = [
                [
                    'name' => 'Jan',
                    'value' => 0
                ],
                [
                    'name' => 'Feb',
                    'value' => 0
                ],
                [
                    'name' => 'Mar',
                    'value' => 0
                ],
                [
                    'name' => 'Apr',
                    'value' => 0
                ],
                [
                    'name' => 'May',
                    'value' => 0
                ],
                [
                    'name' => 'Jun',
                    'value' => 0
                ],
                [
                    'name' => 'Jul',
                    'value' => 0
                ],
                [
                    'name' => 'Aug',
                    'value' => 0
                ],
                [
                    'name' => 'Sep',
                    'value' => 0
                ],
                [
                    'name' => 'Oct',
                    'value' => 0
                ],
                [
                    'name' => 'Nov',
                    'value' => 0
                ],
                [
                    'name' => 'Dec',
                    'value' => 0
                ],
            ];
            $total = 0;
            foreach ($months as $key =>$value) {
                $key = Carbon::create()->startOfMonth()->month((int)$key)->startOfMonth()->shortMonthName;
                foreach ($months_data as &$data){
                    if ($data['name'] == $key)
                        $data['value'] = $value->count();
                }
                $total = $total + $value->count();
            }

            $litigation_data[(string)$year] = [
                'months'=> $months_data,
                'total_cases' => $total
            ];
        }

        foreach ($conveyancing as $year => $months) {
            $months_data = [
                [
                    'name' => 'Jan',
                    'value' => 0
                ],
                [
                    'name' => 'Feb',
                    'value' => 0
                ],
                [
                    'name' => 'Mar',
                    'value' => 0
                ],
                [
                    'name' => 'Apr',
                    'value' => 0
                ],
                [
                    'name' => 'May',
                    'value' => 0
                ],
                [
                    'name' => 'Jun',
                    'value' => 0
                ],
                [
                    'name' => 'Jul',
                    'value' => 0
                ],
                [
                    'name' => 'Aug',
                    'value' => 0
                ],
                [
                    'name' => 'Sep',
                    'value' => 0
                ],
                [
                    'name' => 'Oct',
                    'value' => 0
                ],
                [
                    'name' => 'Nov',
                    'value' => 0
                ],
                [
                    'name' => 'Dec',
                    'value' => 0
                ],
            ];
            $total = 0;
            foreach ($months as $key =>$value) {
                $key = Carbon::create()->startOfMonth()->month((int)$key)->startOfMonth()->shortMonthName;
                foreach ($months_data as &$data){
                    if ($data['name'] == $key)
                        $data['value'] = $value->count();
                }
                $total = $total + $value->count();
            }


            $conveyancing_data[(string)$year] = [
                'months'=> $months_data,
                'total_cases' => $total
            ];
        }

        return [
            'litigation' => $litigation_data,
            'conveyancing' => $conveyancing_data
        ];
    }

    public function pendingClients()
    {
        $pendingClients = $this->model->all();
        $pendingClients = $pendingClients->load(['conveyancing','litigation']);
        return $pendingClients;
    }
}
