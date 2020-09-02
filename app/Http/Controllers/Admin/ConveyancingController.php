<?php

namespace App\Http\Controllers\Admin;

use App\Facade\ConveyancingRepository;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;

class ConveyancingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        return view('admin.client.conveyancing.index');
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
        return redirect()->back()->with(
            empty(ConveyancingRepository::createConveyance($request)) ?
                ['fail' => 'Failed to add a client conveyance'] :
                ['status' => 'Successfully added client conveyance']);
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
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        //
        if ($request->ajax()){
            if (ConveyancingRepository::update($id,$request->all())){
                Session::flash('status', 'Successfully assigned lawyer a conveyance');
                return true;
            }
            Session::flash('fail', 'Failed to assign a lawyer a conveyance');
            return false;
        }else{
            if (ConveyancingRepository::update($id,$request->all()))
                Session::flash('status', 'Successfully updated client conveyance');
            else
                Session::flash('fail', 'Failed to update client conveyance');
        }
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return bool
     */
    public function destroy($id)
    {
        abort_if(Gate::denies('file_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        if (ConveyancingRepository::deleteConveyance($id)){
            Session::flash('status', 'Successfully deleted client conveyance');
            return true;
        }
        Session::flash('fail', 'Failed to delete client conveyance');
        return false;
    }
}
