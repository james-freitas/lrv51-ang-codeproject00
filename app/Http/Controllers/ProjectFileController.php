<?php

namespace CodeProject\Http\Controllers;

use CodeProject\Repositories\ProjectFileRepository;
use CodeProject\Services\ProjectFileService;
use Illuminate\Contracts\Filesystem\Factory;
use Illuminate\Http\Request;

class ProjectFileController extends Controller
{
    /*
     * @var ProjectFileRepository
     */
    private $repository;

    /*
     * @var ProjectFileService
     */
    private $service;

    /**
     * @var \Illuminate\Contracts\Filesystem\Factory
     */
    private $storage;


    public function __construct(ProjectFileRepository $repository, ProjectFileService $service,
Factory $storage)
    {
        $this->repository = $repository;
        $this->service = $service;
        $this->storage = $storage;
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
    public function store(Request $request)
    {
        $file = $request->file('file');
        $extension = $file->getClientOriginalExtension();

        $data['file'] = $file;
        $data['extension'] = $extension;
        $data['name'] = $request->name;
        $data['project_id'] = $request->project_id;
        $data['description'] = $request->description;

        return $this->service->create($data);
    }


    public function showFile($id, $idFile)
    {
        $model = $this->repository->skipPresenter()->find($idFile);
        $filePath = $this->service->getFilePath($idFile);
        $fileContent = file_get_contents($filePath);
        $file64 = base64_encode($fileContent);

        return [
            'file' => $file64,
            'size' => filesize($filePath),
            'name' => $this->service->getFileName($idFile),
            'mime_type' => $this->storage->mimeType($model->getFileName())
        ];
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        if($this->service->checkProjectPermissions($id) == false){
            return ['error' => 'Access Forbidden'];
        }

        return $this->repository->find($id);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        if($this->service->checkProjectOwner($id) == false){
            return ['error' => 'Access Forbidden'];
        }
        return $this->service->update($request->all(), $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        if($this->service->checkProjectOwner($id)==false){
            return ['error' => 'Access Forbidden'];
        }
        $this->service->delete($id);
    }
}
