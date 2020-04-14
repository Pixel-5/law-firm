<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreFileRequest;
use App\Facade\FileRepository;
use App\Http\Requests\UpdateFileRequest;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\Response;
use Gate;

class FileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Factory|View
     */

    public function index()
    {
        //
        abort_if(Gate::denies('file_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return view("admin.client.file.index");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Factory|View
     */
    public function create()
    {
        abort_if(Gate::denies('file_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return view('admin.client.file.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreFileRequest $request
     * @return RedirectResponse
     */
    public function store(StoreFileRequest $request)
    {
        return redirect()->back()->with(
            empty(FileRepository::storeFile($request)) ?
                ["fail"=>"Failed to add a client file"] :
                ["status" => "Successfully added new client file"]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Factory|View
     */
    public function show($id)
    {
        abort_if(Gate::denies('file_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return view("admin.client.file.index");
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        abort_if(Gate::denies('file_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return  null;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateFileRequest $request
     * @param int $file
     * @return RedirectResponse
     */
    public function update(UpdateFileRequest $request, int $file)
    {
            return back()->with(empty(FileRepository::updateFile($file,$request))?
                ["fail" => "Failed to update client file"]:
                ["status" => "Successfully edited client file"]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $file
     * @return bool
     */
    public function destroy(int $file)
    {
        abort_if(Gate::denies('file_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        if (FileRepository::deleteFile($file)){
            Session::flash("status", "Successfully deleted client file");
            return true;
        }

        Session::flash("fail", "Failed to delete client file");
        return false;

    }
}
