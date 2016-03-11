<?php

namespace CodeProject\Http\Controllers;

use CodeProject\Repositories\ProjectNoteRepository;
use CodeProject\Services\ProjectNoteService;
use Illuminate\Http\Request;

use CodeProject\Http\Requests;
use CodeProject\Http\Controllers\Controller;

class ProjectNoteController extends Controller
{
    /*
     *
     */
    private $service;

    public function __construct(ProjectNoteRepository $repository, ProjectNoteService $service)
    {
        $this->repository = $repository;
        $this->service = $service;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index($id)
    {
        return $this->repository->findWhere(['project_id' => $id]);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request, $id)
    {
        $data = $request->all();
        $data['project_id'] = $id;
        return $this->service->create($data);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id, $idNote)
    {
        $result = $this->repository->findWhere(['project_id'=>$id, 'id'=>$idNote]);
        if(isset($result['data']) && count($result['data'])==1){
            $result = [
                'data' => $result['data'][0]
            ];
        }
        return $result[0];
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id, $idNote)
    {
        $data = $request->all();
        $data['project_id'] = $id;
        return $this->service->update($data, $idNote);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
     public function destroy($id, $idNote)
     {
        $this->repository->delete($idNote);
     }
/*    public function destroy($id, $noteId)
    {
        return $this->service->destroy($id, $noteId);
    }*/


/*    public function edit($id, $noteId){
        return $this->service->
    }*/
}
