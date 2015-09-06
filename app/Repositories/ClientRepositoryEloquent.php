<?php
/**
 * Created by PhpStorm.
 * User: james
 * Date: 02/09/15
 * Time: 13:18
 */

namespace CodeProject\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use CodeProject\Entities\Client;

class ClientRepositoryEloquent extends BaseRepository implements ClientRepository{

    public function model()
    {
        return Client::class;
    }

}