<?php
/**
 * Created by PhpStorm.
 * User: james
 * Date: 05/09/15
 * Time: 18:59
 */

namespace CodeProject\Services;


use CodeProject\Repositories\ProjectFileRepository;
use CodeProject\Repositories\ProjectRepository;
use CodeProject\Validators\ProjectFileValidator;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use PhpSpec\Util\Filesystem;
use Prettus\Validator\Exceptions\ValidatorException;
use Illuminate\Support\Facades\Storage;

class ProjectFileService {

    /**
     * @var ProjectFilepository
     */
    protected $repository;

    /*
     * @var ProjectRepository
     */
    protected $projectRepository;

    protected $validator;

    private $fileSystem;

    private $storage;

    public function __construct(ProjectFileRepository $repository,
                                ProjectRepository $projectRepository,
                                ProjectFileValidator $validator,
                                Filesystem $filesystem,
                                Storage $storage)
    {
        $this->repository = $repository;
        $this->projectRepository = $projectRepository;
        $this->validator = $validator;
        $this->fileSystem = $filesystem;
        $this->storage = $storage;
    }

    public function create(array $data)
    {
        try {
            $this->validator->with($data)->passesOrFail();

            $project = $this->projectRepository->skipPresenter()->find($data['project_id']);
            $projectFile = $project->files()->create($data);

            $this->storage->put($projectFile->id . "." . $data['extension'], $this->fileSystem->get($data['file']));

            return $projectFile;

        } catch (ValidatorException $e) {
            return [
                'error' => true,
                'message' => $e->getMessageBag()
            ];
        }
    }

    public function update(array $data, $id)
    {

        try {
            $this->validator->with($data)->passesOrFail();

            return $this->repository->update($data, $id);

        } catch (ValidatorException $e) {
            return [
                'error' => true,
                'message' => $e->getMessageBag()
            ];
        }

    }


    public function delete($id)
    {
        $projectFile = $this->repository->skipPresenter()->find($id);
        if($this->storage->exists($projectFile->id.'.'.$projectFile->extension)){
            $this->storage->delete($projectFile->id.'.'.$projectFile->extension);
            return $projectFile->delete();
        }
    }

    public function getFilePath($id)
    {
        $projectFile = $this->repository->skipPresenter()->find($id);
        return $this->getBaseURL($projectFile);
    }

    public function getBaseURL($projectFile)
    {
        switch($this->storage->getDefaultDriver()){
            case 'local':
                return $this->storage->getDriver()->getAdapter()->getPathPrefix()
                    .'/'. $projectFile->id . '.' . $projectFile->extension;
        }
    }

    public function checkProjectOwner($projectFileId)
    {
        $userId = \Authorizer::getResourceOwnerId();
        $projectId = $this->repository->skipPresenter()->find($projectFileId)->project_id;

        return $this->projectRepository->isOwner($projectId, $userId);
    }

    public function checkProjectMember($projectFileId)
    {
        $userId = \Authorizer::getResourceOwnerId();
        $projectId = $this->repository->skipPresenter()->find($projectFileId)->project_id;

        return $this->projectRepository->hasMember($projectId, $userId);
    }

    public function checkProjectPermissions($projectFileId)
    {
        if($this->checkProjectOwner($projectFileId) or $this->checkProjectMember($projectFileId)) {
            return true;
        }
        return false;
    }

}