<?php
/**
 * Created by PhpStorm.
 * User: james
 * Date: 05/09/15
 * Time: 18:59
 */

namespace CodeProject\Services;


use CodeProject\Repositories\ProjectRepository;
use CodeProject\Validators\ProjectValidator;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Prettus\Validator\Exceptions\ValidatorException;

use Illuminate\Contracts\Filesystem\Factory as Storage;
use Illuminate\Filesystem\Filesystem;


class ProjectService {

    /**
     * @var ProjectRepository
     */
    protected $repository;

    /*
     * @var ProjectValidator
     */
    private $validator;
    private $fileSystem;
    private $storage;
    private $projectTaskService;

    public function __construct(ProjectRepository $repository, ProjectValidator $validator, Filesystem $filesystem, Storage $storage, ProjectTaskService $projectTaskService)
    {
        $this->repository = $repository;
        $this->validator = $validator;
        $this->fileSystem = $filesystem;
        $this->storage = $storage;
        $this->projectTaskService = $projectTaskService;
    }


    public function all()
    {
        return $this->repository->with(['owner','client'])->all();
    }

    public function create(array $data)
    {
        try {
            $this->validator->with($data)->passesOrFail();
            return $this->repository->create($data);
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
        } catch (ModelNotFoundException $e) {
            return [
                'error' => true,
                'message' => 'Projeto não encontrado.'
            ];
        }


    }


    public function show($id)
    {
        try {
            return $this->repository->with(['owner','client'])->find($id);
        } catch (ModelNotFoundException $e) {
            return [
                'error' => true,
                'message' => 'Projeto não encontrado.'
            ];
        }

    }

    public function destroy($id)
    {
        try {
            $this->repository->find($id);
        } catch (ModelNotFoundException $e) {
            return [
                'error' => true,
                'message' => 'Projeto não encontrado.'
            ];
        }
        return $this->repository->delete($id);
    }

    public function createFile(array $data)
    {
        $project = $this->repository->skipPresenter()->find($data['project_id']);
        $projectFile = $project->files()->create($data);

        $this->storage->put($projectFile->id . "." . $data['extension'], $this->fileSystem->get($data['file']));
    }

    public function addMember(array $data)
    {
        $this->projectTaskService->create($data);
    }

    public function removeMember($id)
    {
        $this->projectTaskService->destroy($id);
    }

    public function isMember(array $data)
    {
        if($this->repository->hasMember($data['id'], $data['member_id'])) {
            return true;
        }
        return false;
    }

}