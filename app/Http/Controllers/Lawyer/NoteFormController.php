<?php

namespace App\Http\Controllers\Lawyer;

use App\Facade\LitigationRepository;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Session;

class NoteFormController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */

    private $message = 'You do not have permission to';

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
     * @param  \Illuminate\Http\Request  $request
     * @return RedirectResponse
     */
    public function store(Request $request)
    {
        $results = LitigationRepository::storeFileNote($request);
        if ($results) {
            return redirect()->back()->with('status', 'Successfully added a file note form');
        }
        return redirect()->back()->with('fail','Failed to add a file note form');
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
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return RedirectResponse
     */
    public function update(Request $request, $id)
    {
        if (LitigationRepository::updateFileNote($id,$request->all())){
            return redirect()->back()->with('status', 'Successfully updated client\'s file note form');
        }
        return redirect()->back()->with('fail', 'Failed to update client\'s file note form');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        abort_if(Gate::denies('case_delete'), Response::HTTP_FORBIDDEN,
            $this->message.' delete case');

        if (LitigationRepository::deleteFileNote($id)){
            Session::flash('status', 'Successfully deleted client file note form');
            return response()->json(['status'=>'Successfully deleted client file note form']);
        }
        Session::flash('status', 'Failed to delete client\'s file note form');
        return response()->json(['status'=>'Failed to delete client file note form']);
    }
}
