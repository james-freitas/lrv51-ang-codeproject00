<?php
/**
 * Created by PhpStorm.
 * User: james
 * Date: 02/09/15
 * Time: 13:18
 */

namespace CodeProject\Repositories;

use CodeProject\Presenters\ClientPresenter;
use Prettus\Repository\Eloquent\BaseRepository;
use CodeProject\Entities\Client;

class ClientRepositoryEloquent extends BaseRepository implements ClientRepository{

    protected $fieldSearchable = [
        'name',
        'email'
    ];

    public function model()
    {
        return Client::class;
    }

    public function presenter(){
        return ClientPresenter::class;
    }


    public function boot() {
        $this->pushCriteria(app('Prettus\Repository\Criteria\RequestCriteria'));
    }


}