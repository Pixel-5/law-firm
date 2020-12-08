<?php

namespace App\Http\Controllers;

use App\Facade\ClientRepository;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;

class ClientController extends Controller
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
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {

//        return redirect()->back()->with(
//            empty(IndividualFileRepository::storeFile($request)) ?
//                ['fail' => 'Failed to add a client file'] :
//                ['status' => 'Successfully added new Individual client file']);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Application|Factory|View
     */
    public function show($id)
    {

        abort_if(Gate::denies('file_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $file =  ClientRepository::findById($id);
        return view('client.cases.index')->with('file',$file);
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
     * @param int $id
     * @return void
     */
    public function update(Request $request, $id)
    {

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return void
     */
    public function destroy($id)
    {
        //abort_if(Gate::denies('file_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        if (ClientRepository::deleteClient($id)){
            Session::flash('status', 'Successfully deleted client file');
            return true;
        }
        Session::flash('fail', 'Failed to delete client file');
        return false;
    }
}
