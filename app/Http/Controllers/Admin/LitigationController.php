<?php

namespace App\Http\Controllers\Admin;

use App\Facade\LitigationRepository;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;

class LitigationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        return view('admin.client.litigation.index');
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
     * @return RedirectResponse
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
     * @return RedirectResponse
     */
    public function update(Request $request, $id)
    {
        if ($request->ajax()){
            if (LitigationRepository::update($id,$request->all())){
                Session::flash('status', 'Successfully assigned lawyer a litigation');
                return true;
            }
            Session::flash('fail', 'Failed to assign a lawyer a litigation');
            return false;
        }else{
            if (LitigationRepository::update($id,$request->all()))
                Session::flash('status', 'Successfully updated client litigation');
            else
                Session::flash('fail', 'Failed to update client litigation');
        }
        return back();
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
