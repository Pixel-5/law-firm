<?php

namespace App\Http\Controllers\Admin;

use App\Facade\LitigationRepository;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Session;

class LitigationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return void
     */
    public function index()
    {
        //
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
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        return redirect()->back()
            ->with(empty(LitigationRepository::createLitigation($request)) ?
                ['fail' => 'Failed to add a client litigation'] :
                ['status' => 'Successfully added client litigation']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
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
        return back()->with(LitigationRepository::update($id,$request->all())?
            ['status' => 'Successfully updated client litigation']:
            ['fail'  => 'Failed to update client litigation']
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        abort_if(Gate::denies('file_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        if (LitigationRepository::deleteLitigation($id)){
            Session::flash('status', 'Successfully deleted client litigation');
            return true;
        }

        Session::flash('fail', 'Failed to delete client litigation');
        return false;
    }
}
