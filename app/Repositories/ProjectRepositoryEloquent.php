<?php
/**
 * Created by PhpStorm.
 * User: james
 * Date: 05/09/15
 * Time: 18:42
 */

namespace CodeProject\Repositories;


use Prettus\Repository\Eloquent\BaseRepository;
use CodeProject\Repositories\ProjectRepository;
use CodeProject\Entities\Project;

class ProjectRepositoryEloquent extends BaseRepository implements ProjectRepository{

    public function model()
    {
        return Project::class;
    }

}