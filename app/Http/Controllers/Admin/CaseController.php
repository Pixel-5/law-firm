<?php

namespace App\Http\Controllers\Admin;

use App\Facade\CaseRepository;
use App\Facade\FileRepository;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCaseRequest;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Session;

class CaseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return void
     */
    public function index()
    {
        //
        //return view('admin.index')
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
        return null;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreCaseRequest $request
     * @return void
     */
    public function store(StoreCaseRequest $request)
    {
        //store case using a repository

        $results = CaseRepository::storeCase($request);
        if ($results)
        return redirect()->back()->with('status','Successfully created a new client case');

        return redirect()->back()->with('fail','Failed to open a new case');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $file =  FileRepository::findById($id);
        return view('admin.client.cases.index',compact('file'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        //
        return null;
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
        //

        if (!empty(CaseRepository::updateCase($id,$request->all()))){
            Session::flash("status", "Successfully assigned lawyer a case");
            return true;
        }

        Session::flash("fail", "Failed to assign a lawyer a case");
        return false;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $case
     * @return bool
     */
    public function destroy(int $case)
    {
        abort_if(Gate::denies('user_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if (CaseRepository::deleteCase($case)){
            Session::flash("status", "Successfully deleted client case");
            return true;
        }

        Session::flash("fail", "Failed to delete client case");
        return false;

    }
}
