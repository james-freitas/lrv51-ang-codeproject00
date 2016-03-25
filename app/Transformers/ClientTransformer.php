<?php
/**
 * Created by PhpStorm.
 * User: james
 * Date: 24/12/15
 * Time: 20:26
 */

namespace CodeProject\Transformers;

use CodeProject\Entities\Client;
use League\Fractal\TransformerAbstract;

class ClientTransformer extends TransformerAbstract
{

    protected $defaultIncludes = ['projects'];

    public function transform(Client $o)
    {
        return [
            'id' => (int)$o->id,
            'name' => $o->name,
            'responsible' => $o->responsible,
            'email'=> $o->email,
            'phone'=> $o->phone,
            'address'=> $o->adress,
            'obs'=> $o->obs
        ];
    }

    public function includeProjects(Client $client)
    {
        $transformer = new ProjectTransformer();
        $transformer->setDefaultIncludes([]);
        return $this->collection($client->projects, $transformer);
    }

}