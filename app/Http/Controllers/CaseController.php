<?php

namespace App\Http\Controllers;

use App\Facade\CaseRepository;
use App\Facade\FileRepository;
use App\Http\Requests\StoreCaseRequest;
use App\Http\Requests\UpdateCaseRequest;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;

class CaseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param $id
     * @return Application|Factory|View
     */
    private $message = 'You do not have permission to';

    public function index($id)
    {
        //
        abort_if(Gate::denies('case_access'), Response::HTTP_FORBIDDEN,
            $this->message.' access cases');
        $file =  FileRepository::findById($id);
        return view('client.cases.index',compact('file'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
        abort_if(Gate::denies('case_create'), Response::HTTP_FORBIDDEN,
            $this->message.' create case');
        return null;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreCaseRequest $request
     * @return RedirectResponse
     */
    public function store(StoreCaseRequest $request)
    {
        //store case using a repository

        $results = CaseRepository::storeCase($request);
        if ($results) {
            return redirect()->back()->with('status', 'Successfully created a new client case');
        }

        return redirect()->back()->with('fail','Failed to open a new case');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Application|Factory|View
     */
    public function show($id)
    {
        abort_if(Gate::denies('case_show'), Response::HTTP_FORBIDDEN,
            $this->message.' view case');
        $case =  CaseRepository::showCase($id);
        return view('client.cases.edit',compact('case'));
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
        abort_if(Gate::denies('case_edit'), Response::HTTP_FORBIDDEN,
            $this->message.' edit case');
        return null;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateCaseRequest $request
     * @param int               $id
     *
     * @return RedirectResponse
     */
    public function update(UpdateCaseRequest $request, $id)
    {
        //
        if ($request->ajax()){
            if (CaseRepository::updateCase($id,$request->all())){
                Session::flash('status', 'Successfully assigned lawyer a case');
                return true;
            }
            Session::flash('fail', 'Failed to assign a lawyer a case');
           return false;
        }

        if (CaseRepository::updateCase($id,$request->all())){
            return redirect()->back()->with('status', 'Successfully updated client a case');
        }
        return redirect()->back()->with('fail', 'Failed to update client case');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $case
     * @return bool
     */
    public function destroy(int $case)
    {
        abort_if(Gate::denies('case_delete'), Response::HTTP_FORBIDDEN,
            $this->message.' delete case');
        if (CaseRepository::deleteCase($case)){
            Session::flash('status', 'Successfully deleted client case');
            return true;
        }
        Session::flash('fail', 'Failed to delete client case');
        return false;
    }
}
