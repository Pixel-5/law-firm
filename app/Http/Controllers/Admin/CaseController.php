<?php

namespace App\Http\Controllers\Admin;

use App\Facade\CaseRepository;
use App\Facade\FileRepository;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCaseRequest;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

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
        return null;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
