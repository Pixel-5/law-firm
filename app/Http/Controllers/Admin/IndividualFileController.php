<?php

namespace App\Http\Controllers\Admin;

use App\Facade\ConveyancingRepository;
use App\Facade\IndividualFileRepository;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\StoreIndividualFileRequest;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Session;
use function GuzzleHttp\Promise\all;

class IndividualFileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return void
     */
    public function index()
    {
        abort_if(Gate::denies('file_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return void
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreIndividualFileRequest $request
     * @return RedirectResponse
     */
    public function store(StoreIndividualFileRequest $request)
    {

        return redirect()->back()->with(
            empty(IndividualFileRepository::storeFile($request)) ?
                ['fail' => 'Failed to add a client file'] :
                ['status' => 'Successfully added new Individual client file']);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return void
     */
    public function show($id)
    {
        abort_if(Gate::denies('file_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $file =  IndividualFileRepository::findById($id);
        return view('client.cases.index',compact('file'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return void
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        abort_if(Gate::denies('file_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return back()->with(IndividualFileRepository::updateFile($id,$request)?
            ['status' => 'Successfully updated Individual file']:
            ['fail' => 'Failed to update client Individual file']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return void
     */
    public function destroy($id)
    {
        abort_if(Gate::denies('file_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        if (IndividualFileRepository::deleteFile($id)){
            Session::flash('status', 'Successfully deleted client file');
            return true;
        }
        Session::flash('fail', 'Failed to delete client file');
        return false;
    }
}
